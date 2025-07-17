<?php

namespace App\Models;

use App\Observers\CarObserver;
use Database\Factories\CarFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Car extends Model
{
    /** @use HasFactory<CarFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'brand_id',
        'description',
        'price'
    ];

    #[ObservedBy([CarObserver::class])]

    /**
     * @return BelongsTo
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
