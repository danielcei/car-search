<?php
namespace App\Domain\Cars\Repositories;

use Illuminate\Support\Collection;

interface BrandRepositoryInterface
{
    public function getAllCached(): Collection;
}
