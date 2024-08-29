<?php

namespace App\Models;

use App\Enums\AdoptionStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdoptionRequest extends Model
{
    use HasFactory,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'adopter_id',
        'animal_id',
        'status',
    ];
    protected $casts = [
        'status' => AdoptionStatus::class,
    ];

    public function adopter()
    {
        return $this->belongsTo(Adopter::class);
    }

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }
}
