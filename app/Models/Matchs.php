<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matchs extends Model
{
    use HasFactory;
    protected $fillable = ['club1_id', 'club2_id', 'score1', 'score2', 'match_date'];

    public function club1()
    {
        return $this->belongsTo(Club::class, 'club1_id');
    }

    public function club2()
    {
        return $this->belongsTo(Club::class, 'club2_id');
    }
}
