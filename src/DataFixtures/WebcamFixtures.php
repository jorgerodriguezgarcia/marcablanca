<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Domain\Entity\Webcam;

class WebcamFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        if ($_ENV["APP_ENV"]!=="test") return;

        $lastUpdate = new \DateTime();

        $webcam = (new Webcam())
            ->setId(999999)
            ->setNick("Girl 1")
            ->setPermalink("girl_1")
            ->setWebcamPosition("0")
            ->setLastUpdate($lastUpdate)
        ;
        $manager->persist($webcam);

        $webcam = (new Webcam)
            ->setId(999998)
            ->setNick("Girl 2")
            ->setPermalink("girl_2")
            ->setWebcamPosition("1")
            ->setLastUpdate($lastUpdate)
        ;
        $manager->persist($webcam);

        $manager->flush();
    }
}
