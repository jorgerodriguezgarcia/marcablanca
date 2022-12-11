<?php


namespace App\Application\SearchMemberByUrlAndAllWebcams;


use App\Domain\Repository\MemberRepository;
use App\Domain\Repository\WebcamRepository;
use App\Shared\Domain\Bus\Query\QueryHandler;
use App\Shared\Domain\Bus\Query\Response;


class SearchMemberByUrlAndAllWebcamsQueryHandler implements QueryHandler
{
    public function __construct(
        private MemberRepository $memberRepository,
        private WebcamRepository $webcamRepository,
    )
    {}

    public function __invoke(SearchMemberByUrlAndAllWebcamsQuery $query): ?Response
    {
        if (!($member = $this->memberRepository->findByUrl($query->getUrlMember()))) {
            throw new UrlNotValidException("URL not valid {$query->getUrlMember()}");
        }

        if(!($webcams = $this->webcamRepository->searchAll())) {
            throw new \Exception("No webcams cached");
        };

        return (new SearchMemberByUrlAndAllWebcamsResponse($member, $webcams));
    }
}//class