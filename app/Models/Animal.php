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
        "desexed",
        "microchip_number",
        "ear_tag_number",
        "description",
    ];

    protected $casts = [
        'age' => 'array',
        'gender' => GenderType::class,
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

    public function adoptable()
    {
        return $this->hasOne(Adoptable::class);
    }

    public function adoptionRequests()
    {
        return $this->hasMany(AdoptionRequest::class);
    }

    public function adopted()
    {
        return $this->hasOne(Adopted::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }


    /**
     * Get status
     *
     * @return AnimalStatus
     */
    public function getStatusAttribute():AnimalStatus
    {
        $adoptable = $this->adoptable;
        $adoptionRequests = $this->adoptionRequests;
        $adopted = $this->adopted;

        if ($adopted) {
            return AnimalStatus::Adopted;
        }

        if ($adoptable && $adoptable->publish_date <= now() && ($adoptable->expiration_date >= now() || $adoptable->expiration_date === null)) {
            if ($adoptionRequests->isNotEmpty()) {
                $latestRequest = $adoptionRequests->last();
                if ($latestRequest->status == 'new') {
                    return AnimalStatus::Pending;
                } elseif ($latestRequest->status == 'pending') {
                    return AnimalStatus::Pending;
                } elseif ($latestRequest->status == 'completed') {
                    return AnimalStatus::Adopted;
                } elseif ($latestRequest->status == 'rejected') {
                    return AnimalStatus::Published;
                }
            }
            return AnimalStatus::Published;
        }

        if ($adoptable && ($adoptable->publish_date > now() || $adoptable->expiration_date < now())) {
            if ($adoptable->expiration_date < now()) {
                return AnimalStatus::Expired;
            }
            return AnimalStatus::New;
        }

        if ($adoptable && $adoptable->publish_date < now() && $adoptable->expiration_date < now()) {
            return AnimalStatus::Expired;
        }

        return AnimalStatus::New;
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
        return $this->getMedia('animal_image')->sortBy('order_column')->map(function ($media) {
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
        $firstMedia = $this->getFirstMedia('animal_image');

        if ($firstMedia) {
            return [
                'id' => $firstMedia->id,
                'url' => $firstMedia->getUrl(),
                // 'thumbnail' => $firstMedia->getUrl('thumbnail'),
            ];
        }

        return null;
    }
    /**
     * Tüm videoları almak için özel bir metod.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getVideosAttribute()
    {
        return $this->getMedia('animal_video')->map(function ($media) {
            return [
                'id' => $media->id,
                'url' => $media->getUrl(),
            ];
        });
    }
}
