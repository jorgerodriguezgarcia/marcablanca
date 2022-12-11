<?php


namespace App\Application\SearchMemberByUrlAndAllWebcams;

use App\Shared\Domain\Bus\Query\Query;

class SearchMemberByUrlAndAllWebcamsQuery implements Query
{
    public function __construct(private string $urlMember) {}


    public function getUrlMember(): string
    {
        return $this->urlMember;
    }

}//class