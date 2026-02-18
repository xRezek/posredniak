<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TypeOfContract extends Model
{

    use HasFactory;

    public $timestamps = false;

    protected $table = 'types_of_contract';

    protected $fillable = [
        'name'
    ];

    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class);
    }
}
