<?php

namespace App\Livewire;

use App\Models\Animal;
use Livewire\Component;

class Pet extends Component
{
    public Animal $pet;
    public bool $showForm = false;
    public string $name = '';
    public string $email = '';
    public string $phone = '';
    public string $message = '';
    public $relatedPets;

    public function mount(Animal $pet)
    {
        $this->pet = $pet;
        $this->relatedPets = Animal::where('species_id', $pet->species_id)->where('id', '!=', $pet->id)->get();
    }

    public function toggleForm()
    {
        $this->showForm = !$this->showForm;
    }

    public function render()
    {
        return view('livewire.pet', ['pet' => $this->pet, 'showForm' => $this->showForm, 'relatedPets' => $this->relatedPets]);
    }

    public function submitAdoptionForm()
    {
        // Burada sahiplenme formu gönderme işlemleri yapılabilir.
        // Örneğin, bir email gönderme servisi çağrılabilir.
        // Bu örnekte, bu işlemler gösterilmemektedir.
    }
}
