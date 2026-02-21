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
        'created_at',
    ];

    protected $hidden = [
        'updated_at',
        'deleted_at'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function placeOfWork(): BelongsTo
    {
        return $this->belongsTo(PlaceOfWork::class, 'place_of_work_id');
    }

    public function typeOfWork(): BelongsTo
    {
        return $this->belongsTo(TypeOfContract::class, 'type_of_contract_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
