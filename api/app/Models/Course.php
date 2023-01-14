<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 *
 */
class Course extends Model
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
        'image'
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'published' => 'boolean'
    ];

    /**
     * @return HasMany
     */
    public function modules(): HasMany
    {
        return $this->hasMany(Module::class, 'course_id', 'id');
    }
}
