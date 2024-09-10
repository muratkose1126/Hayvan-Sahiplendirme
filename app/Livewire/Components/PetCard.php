<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Animal;

class PetCard extends Component
{
    public Animal $pet;

    public function mount(Animal $pet)
    {
        $this->pet = $pet;
    }

    public function adoptPet($petId)
    {
        $pet = Animal::findOrFail($petId);
        $pet->is_adopted = true;
        $pet->save();

        $this->emit('petAdopted');
    }

    public function render()
    {
        return view('livewire.components.pet-card');
    }
}
