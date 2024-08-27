<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    public function adopter()
    {
        return $this->belongsTo(Adopter::class);
    }

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }
}
