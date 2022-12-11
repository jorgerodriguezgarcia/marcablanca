<?php

declare(strict_types = 1);

namespace App\Domain\Repository;

use App\Domain\Entity\Member;
use App\Shared\Domain\Criteria\Criteria;

interface MemberRepository
{
    public function save(Member $member): void;

    public function searchAll(): array;

    public function findByUrl(string $url):?Member;
}