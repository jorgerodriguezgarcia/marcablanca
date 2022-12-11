<?php


namespace App\Infraestructure\Persistence;


use App\Domain\Entity\Member;
use App\Domain\Repository\MemberRepository;
use App\Shared\Domain\Criteria\Criteria;
use App\Shared\Infrastructure\Persistence\Doctrine\DoctrineCriteriaConverter;
use App\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;


class MysqlMemberRepository extends DoctrineRepository implements MemberRepository
{
    public function save(Member $member): void
    {
        $this->persist($member);
    }

    public function searchAll(): array
    {
        return $this->repository(Member::class)->findAll();
    }

    public function findByUrl(string $url): ?Member
    {
        return $this->repository(Member::class)->findOneByWebsiteUrl($url);
    }
}

