<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 *
 */
class Support extends Model
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
        'title',
        'lesson_id',
        'status',
        'description',
        'user_id'
    ];

    /**
     * @var string[]
     */
    public array $statusOptions = [
        'P' => 'Pendente, aguardando professor',
        'O' => 'Aberto, aguardando aluno',
        'C' => 'Finalizado'
    ];

    /**
     * @return BelongsTo
     */
    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany
     */
    public function replies(): HasMany
    {
        return $this->hasMany(ReplySupport::class);
    }
}
