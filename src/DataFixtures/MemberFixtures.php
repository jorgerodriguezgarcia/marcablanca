<?php

namespace App\DataFixtures;

use App\Domain\Entity\Member;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MemberFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $member = (new Member())
            ->setName("Babosas")
            ->setWebsiteName("Babosas.com")
            ->setWebsiteUrl("www.babosas.com")
            ->setGoogleAnalyticsIdentifier("UA-babosas-1")
            ->setNatsTrackingCodeForMainPage(md5(uniqid()))
            ->setNatsTrackingCodeForWebcams(md5(uniqid()))
            ->setPathToCssDirectory("upload/babosas/css")
        ;
        $manager->persist($member);

        $member = (new Member())
            ->setName("Cerdas")
            ->setWebsiteName("Cerdas.com")
            ->setWebsiteUrl("www.cerdas.com")
            ->setGoogleAnalyticsIdentifier("UA-cerdas-1")
            ->setNatsTrackingCodeForMainPage(md5(uniqid()))
            ->setNatsTrackingCodeForWebcams(md5(uniqid()))
            ->setPathToCssDirectory("upload/cerdas.com/css")
        ;
        $manager->persist($member);

        $member = (new Member())
            ->setName("Conejo X")
            ->setWebsiteName("ConejoX.com")
            ->setWebsiteUrl("www.conejox.com")
            ->setGoogleAnalyticsIdentifier("UA-conejox-1")
            ->setNatsTrackingCodeForMainPage(sha1(uniqid()))
            ->setNatsTrackingCodeForWebcams(sha1(uniqid()))
            ->setPathToCssDirectory("upload/conejox.com/css")
        ;
        $manager->persist($member);

        $manager->flush();
    }
}
