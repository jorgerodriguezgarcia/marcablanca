<?php


namespace App\Application\SearchMemberByUrlAndAllWebcams;


use App\Domain\Entity\Member;
use App\Shared\Domain\Bus\Query\Response;

class SearchMemberByUrlAndAllWebcamsResponse implements Response
{
    public function __construct(private Member $member, private array $webcam) { }

    public function getMember(): Member
    {
        return $this->member;
    }

    public function getWebcam(): array
    {
        return $this->webcam;
    }


}//class