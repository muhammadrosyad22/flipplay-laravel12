<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Media extends Model
{
    use HasFactory;

    protected $table = 'media';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'title',
        'creator',
        'release_year',
        'description',
        'type',
        'episode_count',
        'studio',
        'volume_count',
        'publisher',
    ];

    protected function casts(): array
    {
        return [
            'release_year' => 'integer',
            'episode_count' => 'integer',
            'volume_count' => 'integer',
        ];
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'media_user')->withTimestamps();
    }
}
