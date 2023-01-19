<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lesson extends Model
{
    use HasFactory, UuidTrait;

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var string
     */
    protected $keyType = 'uuid';

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description',
        'video'
    ];

    /**
     * @return HasMany
     */
    public function supports(): HasMany
    {
        return $this->hasMany(Support::class, 'lesson_id', 'id');
    }

    public function views(): HasMany
    {
        return $this->hasMany(View::class, 'lesson_id', 'id')
            ->where(function ($query) {
                if (auth()->check()) {
                    $query->where('user_id', auth()->user()->id);
                }
            });
    }
}
