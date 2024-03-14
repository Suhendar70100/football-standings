<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Club extends Model
{
    use HasFactory;
    protected $table = 'clubs';
    protected $fillable = ['name', 'city'];

    public function matchesAsHome(): HasMany
    {
        return $this->hasMany(Matchs::class, 'club1_id');
    }
    
    public function matchesAsAway(): HasMany
    {
        return $this->hasMany(Matchs::class, 'club2_id');
    }

    public function standing()
    {
        return $this->hasOne(Standing::class);
    }
    
}
