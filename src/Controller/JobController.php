<?php

namespace App\Controller;

use App\Entity\CV;
use App\Entity\Job;
use App\Form\SearchType;
use App\Repository\CVRepository;
use App\Repository\JobRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class JobController extends AbstractController
{
    /**
     * @param  EntityManagerInterface $em
     * @return Response
     */
    public function index(EntityManagerInterface $em): Response
    {
        $form = $this->createForm(SearchType::class);

        return $this->render(
            'index.html.twig',
            [
                'list' => $em->getRepository(Job::class)->findAll(),
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @param EntityManagerInterface $em
     * @param Request $request
     * @return Response
     */
    public function search(EntityManagerInterface $em, Request $request): Response
    {
        /** @var JobRepository $jobsRepo */
        $jobsRepo = $em->getRepository(Job::class);
        $form = $this->createForm(SearchType::class);
        $form->handleRequest($request);
        $searchData = [];
        if ($form->isSubmitted() && $form->isValid()) {
            $searchData = $form->getData();
        }
        $jobList = $jobsRepo->getFiltered($searchData);

        $html = $this->renderView('_job_list.html.twig', ['list' => $jobList]);

        return new Response($html);
    }

    /**
     * @param  EntityManagerInterface $em
     * @param  Job $job
     * @return Response
     */
    public function detail(EntityManagerInterface $em, Job $job): Response
    {
        /** @var CVRepository $cvRepo */
        $cvRepo = $em->getRepository(CV::class);
        $relevantCvs = $cvRepo->findRelevant($job->getTitle());

        return $this->render(
            'job_detail.html.twig',
            [
                'list' => $relevantCvs,
                'job' => $job,
            ]
        );
    }
}
