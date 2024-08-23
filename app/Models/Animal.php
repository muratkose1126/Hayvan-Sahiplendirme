<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;

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
}
