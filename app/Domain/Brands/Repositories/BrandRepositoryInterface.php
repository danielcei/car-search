<?php
namespace App\Domain\Brands\Repositories;

use Illuminate\Support\Collection;

interface BrandRepositoryInterface
{
    public function getAllCached(): Collection;
}
