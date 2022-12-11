<?php


namespace App\Infraestructure\Persistence;


use App\Domain\Entity\Member;
use App\Domain\Entity\Webcam;
use App\Domain\Repository\WebcamRepository;
use App\Shared\Domain\Criteria\Criteria;
use App\Shared\Infrastructure\Persistence\Doctrine\DoctrineCriteriaConverter;
use App\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;


class MysqlWebcamRepository extends DoctrineRepository implements WebcamRepository
{
    public function save(Webcam $webcam): void
    {
        $this->persist($webcam);
    }

    public function searchAll(): array
    {
        $qb = $this->repository(Webcam::class)->createQueryBuilder("w");
        $qb -> orderBy("w.webcamPosition","asc");

        return $qb->getQuery()->getResult();
    }

    public function findById(int $id): ?Webcam
    {
        return $this->repository(Webcam::class)->findOneById($id);
    }

    public function delete(Webcam $webcam): void
    {
       $this->remove($webcam);
    }

    public function removeUnusedWebcams(\DateTimeInterface $lastUpdate):void
    {
        $qb = $this->repository(Webcam::class)->createQueryBuilder("w");
        $qb ->delete()
            ->where($qb->expr()->orX(
                $qb->expr()->neq("w.lastUpdate", ":lastUpdate"),
                $qb->expr()->isNull("w.lastUpdate")
            ))
            ->setParameter("lastUpdate", $lastUpdate)
        ;
        $qb->getQuery()->execute();
    }
}

