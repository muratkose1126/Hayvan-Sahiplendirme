<?php

namespace App\Livewire;

use App\Enums\AnimalStatus;
use App\Http\Resources\AnimalResource;
use Livewire\Component;
use App\Models\Animal;
use App\Models\Species;
use App\Models\Breed;
use Livewire\WithPagination;

class Pets extends Component
{
    use WithPagination;

    public $name;
    public $species;
    public $breed;
    public $minAge;
    public $maxAge;
    public $color;
    public $desexed;
    public $gender;

    public $speciesList;
    public $breedList;

    public function mount()
    {
        $this->speciesList = Species::all();
        $this->breedList = Breed::all();
    }

    public function updatedSpecies()
    {
        $this->breedList = Breed::where('species_id', $this->species)->get();
        $this->breed = null;
    }

    public function filter()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset(['name', 'species', 'breed', 'minAge', 'maxAge', 'color', 'desexed', 'gender']);
        $this->breedList = Breed::all();
        $this->resetPage();
    }

    public function render()
    {
        $query = Animal::with(['media'])->where('status', AnimalStatus::Published);

        if ($this->name) {
            $query->where('name', 'like', '%' . $this->name . '%');
        }

        if ($this->species) {
            $query->where('species_id', $this->species);
        }

        if ($this->breed) {
            $query->where('breed_id', $this->breed);
        }

        if ($this->minAge) {
            $query->where('age->min', '>=', $this->minAge);
        }

        if ($this->maxAge) {
            $query->where('age->max', '<=', $this->maxAge);
        }

        if ($this->color) {
            $query->where('color', 'like', '%' . $this->color . '%');
        }

        if ($this->desexed !== null) {
            $query->where('desexed', $this->desexed);
        }

        if ($this->gender) {
            $query->where('gender', $this->gender);
        }

        $pets = $query->paginate(12);


        return view('livewire.pets', [
            'pets' => $pets,
            'speciesList' => $this->speciesList,
            'breedList' => $this->breedList,
        ]);
    }
}
