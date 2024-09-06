<?php

namespace App\Models;

use App\Enums\AnimalStatus;
use App\Enums\GenderType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Animal extends Model implements HasMedia
{
    use InteractsWithMedia;
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
        'gender' => GenderType::class,
        'status' => AnimalStatus::class,
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

    /**
     * Get the ageString attribute.
     *
     * @param  string  $value
     * @return string
     */
    public function getAgeStringAttribute()
    {
        $min = $this->age['min'];
        $max = $this->age['max'] ?? $min;
        $unit = __(ucfirst($this->age['unit']));
        return $min === $max ? "{$min} {$unit}" : "{$min}-{$max} {$unit}";
    }

    /**
     * Tüm resimleri almak için özel bir metod.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getImagesAttribute()
    {
        return $this->getMedia('animals')->map(function ($media) {
            return [
                'id' => $media->id,
                'url' => $media->getUrl(),
                // 'thumbnail' => $media->getUrl('thumbnail'),
            ];
        });
    }

    /**
     * Sadece ilk resmi getiren özel bir metod.
     *
     * @return array|null
     */
    public function getFirstImageAttribute()
    {
        $firstMedia = $this->getFirstMedia('animals');

        if ($firstMedia) {
            return [
                'id' => $firstMedia->id,
                'url' => $firstMedia->getUrl(),
                // 'thumbnail' => $firstMedia->getUrl('thumbnail'),
            ];
        }

        return null;
    }
}
