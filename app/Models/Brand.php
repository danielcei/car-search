<?php

namespace App\Models;

use App\Observers\BrandObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = ['name', 'slug'];


    #[ObservedBy([BrandObserver::class])]


    /**
     * @return HasMany
     */
    public function cars(): HasMany
    {
        return $this->hasMany(Car::class);
    }
}
