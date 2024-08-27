<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vaccination extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'animal_id',
        'vaccine_id',
        'date',
        'expiration_date',
    ];

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }

    public function vaccine()
    {
        return $this->belongsTo(Vaccine::class);
    }
}
