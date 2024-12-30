<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Music extends Model
{
    /** @use HasFactory<\Database\Factories\AnimeFactory> */
    use HasApiTokens, HasFactory;


    // Nom de la table
    protected $table = 'musics';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'file',
        'duration',
        'animes_id'
    ];

    // Relation avec Anime
    public function anime()
    {
        return $this->belongsTo(Anime::class, 'animes_id'); // Un music appartient à un anime
    }
}
