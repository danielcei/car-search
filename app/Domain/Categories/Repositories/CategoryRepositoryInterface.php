<?php
namespace App\Domain\Categories\Repositories;

use Illuminate\Support\Collection;

interface CategoryRepositoryInterface
{
    public function getAllCached(): Collection;
}
