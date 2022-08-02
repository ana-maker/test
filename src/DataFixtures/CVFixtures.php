<?php

namespace App\DataFixtures;

use App\Entity\CV;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CVFixtures extends Fixture
{
    protected const CV_COUNT = 20;

    protected const JOBS = [
        'PHP Symfony Developer',
        'Symfony Developer',
        'Backend PHP Developer',
        'PHP Laravel Developer',
        'Java Developer',
        'Backend PHP Developer',
        'PHP Web Developer',
    ];

    /** {@inheritDoc} */
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < self::CV_COUNT; ++$i) {
            $cv = new CV();
            $cv->setAddress($faker->address);
            $cv->setName($faker->name);
            $cv->setEducation('University');
            $cv->setWork($faker->randomElement(self::JOBS));
            $experience = rand(1,10) . ' years';
            $cv->setExperience($experience);

            $manager->persist($cv);
        }

        $manager->flush();
    }
}
