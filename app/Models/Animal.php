<?php

namespace App\Models;

use App\Enums\AnimalStatus;
use App\Enums\GenderType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Animal extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "name",
        "species_id",
        "breed_id",
        "color",
        "age",
        "gender",
        "status",
        "desexed",
        "microchip_number",
        "ear_tag_number",
        "description",
    ];

    protected $casts = [
        'age' => 'array',
        'gender'=> GenderType::class,
        'status'=> AnimalStatus::class,
    ];

    public function species()
    {
        return $this->belongsTo(Species::class);
    }

    public function breed()
    {
        return $this->belongsTo(Breed::class);
    }

    public function vaccinations()
    {
        return $this->hasMany(Vaccination::class);
    }

    public function adoptables()
    {
        return $this->hasMany(Adoptable::class);
    }

    public function adoptionRequests()
    {
        return $this->hasMany(AdoptionRequest::class);
    }

    public function adopted()
    {
        return $this->hasMany(Adopted::class);
    }
}
