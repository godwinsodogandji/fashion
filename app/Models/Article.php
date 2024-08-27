<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Article extends Model
{
    use HasFactory;
    protected $fillable = [
        "title",
        "body",
        "image",
        "user_id",
    ];
    // un article peut avoir plusieurs commentaires
    
    public function article(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    /**
     * Relation avec l'utilisateur.
     *
     * Un commentaire appartient à un utilisateur.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
