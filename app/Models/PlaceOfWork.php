<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PlaceOfWork extends Model
{

    use HasFactory;

    public $timestamps = false;

    protected $table = 'places_of_work';

    protected $fillable = [
        'name'
    ];

    public function offers(): HasMany 
    {
        return $this->hasMany(Offer::class);
    }
}
