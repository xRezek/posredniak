<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Offer extends Model
{

    use SoftDeletes, HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'pay',
        'experience_required',
        'localization',
        'place_of_work_id',
        'type_of_contract_id',
        'company_name',
        'contact',
    ];

    protected $hidden = [
        'updated_at',
        'deleted_at'
    ];

    public function categories(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function placesOfWork(): BelongsTo
    {
        return $this->belongsTo(PlaceOfWork::class);
    }

    public function typesOfWork(): BelongsTo
    {
        return $this->belongsTo(TypeOfContract::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function favoredUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favorite_offers', 'offer_id', 'user_id');
    }
}
