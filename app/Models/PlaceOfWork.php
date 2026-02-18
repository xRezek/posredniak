<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PlaceOfWork extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    public function offers(): HasMany 
    {
        return $this->hasMany(Offer::class);
    }
}
