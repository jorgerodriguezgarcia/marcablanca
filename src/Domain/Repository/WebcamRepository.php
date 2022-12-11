<?php

declare(strict_types = 1);

namespace App\Domain\Repository;

use App\Domain\Entity\Webcam;
use App\Shared\Domain\Criteria\Criteria;

interface WebcamRepository
{
    public function save(Webcam $webcam): void;

    public function delete(Webcam $webcam): void;

    public function searchAll(): array;

    public function findById(int $id):?Webcam;

    public function removeUnusedWebcams(\DateTimeInterface $lastUpdate):void;
}