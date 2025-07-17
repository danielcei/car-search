<?php
namespace App\Domain\Cars\Repositories;

use App\Domain\Cars\DTOs\CarSearchFilter;
use Illuminate\Contracts\Pagination\Paginator;

interface CarRepositoryInterface
{
    public function search(CarSearchFilter $filter): Paginator;
}

