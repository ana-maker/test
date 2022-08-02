<?php

namespace App\Command;

use App\Entity\Job;
use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\Client;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DomCrawler\Crawler;

class CrawlJobsCommand extends Command
{
    protected const JOBS_URL = 'https://www.bestjobs.eu/ro/locuri-de-munca-in-bucuresti/symfony';

    protected static $defaultName = 'app:crawl:jobs';

    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $em;

    /**
     * @param EntityManagerInterface $em
     * @param string|null $name
     */
    public function __construct(EntityManagerInterface $em, string $name = null)
    {
        parent::__construct($name);
        $this->em = $em;
    }

    /** {@inheritDoc} */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $client = new Client();
        $response = $client->request('GET', self::JOBS_URL);
        $jobsPageHtml = $response->getBody()->getContents();
        $crawler = new Crawler($jobsPageHtml);
        $jobCards = $crawler->filter('.job-card');

        /** @var Crawler $node */
        $cardData = $jobCards->each(function ($card) {
            return [
                'uri' => $card->filter('.stretched-link')->attr('href'),
                'title' => $card->attr('data-title'),
                'company' => $card->attr('data-employer-name'),
                'location' => $card->filter('.card-footer > div > div > .min-width-3')->text(),
            ];
        });
        foreach ($cardData as $jobCard) {
            $jobPageResponse = $client->request('GET', $jobCard['uri']);
            $jobPageHtml = $jobPageResponse->getBody()->getContents();
            $jobPageCrawler = new Crawler($jobPageHtml);
            $description = $jobPageCrawler->filter('.job-description')->text();

            $job = new Job();
            $job->setTitle($jobCard['title']);
            $job->setCompany($jobCard['company']);
            $job->setLocation($jobCard['location']);
            $job->setDescription($description);

            $this->em->persist($job);
        }

        $this->em->flush();

        return self::SUCCESS;
    }
}
