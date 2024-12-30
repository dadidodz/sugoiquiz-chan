<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Anime extends Model
{
    /** @use HasFactory<\Database\Factories\AnimeFactory> */
    use HasApiTokens, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'image',
        'release_date',
        'details',
    ];

    // Relation avec Music
    public function musics()
    {
        return $this->hasMany(Music::class, 'animes_id'); // Un anime peut avoir plusieurs musiques
    }
}
