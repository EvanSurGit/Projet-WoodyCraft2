<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puzzle extends Model
{
    protected $fillable = ['nom', 'prix', 'categorie_id', 'description', 'note', 'image'];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
}