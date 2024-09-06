<div class="min-h-screen bg-gradient-background dark:bg-gradient-background-dark py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-5xl font-black text-center text-primary-text dark:text-primary-text-dark mb-12 tracking-tight leading-tight">
            {{ $pet->name }}
        </h1>

        <div class="bg-surface dark:bg-surface-dark shadow-lg rounded-lg p-6 mb-12 transition duration-300 hover:shadow-xl backdrop-filter backdrop-blur-lg bg-opacity-90 dark:bg-opacity-80">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-surface dark:bg-surface-dark rounded-lg shadow-lg overflow-hidden transition duration-300 hover:shadow-xl group flex flex-col">
                    <div class="relative">
                        <img src="{{ $pet->image ? $pet->image->url : 'https://picsum.photos/seed/' . $pet->id . '/400/300' }}" alt="{{ $pet->name }}" class="w-full h-48 object-cover transition duration-300 group-hover:scale-105">
                        <div class="absolute top-2 right-2 bg-btn-primary dark:bg-btn-primary-dark text-btn-primary-text dark:text-btn-primary-text-dark px-2 py-1 rounded-full text-xs font-medium">
                            {{ $pet->species->name }} / {{ $pet->breed->name }}
                        </div>
                    </div>
                    <div class="p-6">
                        <h2 class="text-3xl font-semibold text-primary-text dark:text-primary-text-dark mb-4">{{ $pet->name }}</h2>
                        <p class="text-lg text-gray-700 dark:text-gray-400 mb-6">{{ $pet->description }}</p>
                        <p class="text-lg font-semibold text-primary-text dark:text-primary-text-dark">{{ $pet->age }} yaşında</p>
                        <p class="text-lg text-gray-700 dark:text-gray-400">{{ $pet->gender }}</p>
                        <p class="text-lg text-gray-700 dark:text-gray-400">{{ $pet->desexed ? 'Kısırlaştırılmış' : 'Kısırlaştırılmamış' }}</p>
                        <div class="flex justify-center mt-6">
                            <button wire:click="adopt" class="px-6 py-2 bg-btn-primary dark:bg-btn-primary-dark text-btn-primary-text dark:text-btn-primary-text-dark rounded-md hover:bg-btn-primary-hover dark:hover:bg-btn-primary-hover-dark focus:outline-none focus:ring-2 focus:ring-btn-primary-focus dark:focus:ring-btn-primary-focus-dark focus:ring-offset-2 transition duration-300 text-sm font-medium">
                                Sahiplen
                            </button>
                            <button wire:click="share" class="px-6 py-2 bg-btn-secondary dark:bg-btn-secondary-dark text-btn-secondary-text dark:text-btn-secondary-text-dark rounded-md hover:bg-btn-secondary-hover dark:hover:bg-btn-secondary-hover-dark focus:outline-none focus:ring-2 focus:ring-btn-secondary-focus dark:focus:ring-btn-secondary-focus-dark focus:ring-offset-2 transition duration-300 text-sm font-medium ml-4">
                                Paylaş
                            </button>
                        </div>
                    </div>
                </div>
                <div class="bg-surface dark:bg-surface-dark rounded-lg shadow-lg p-6 transition duration-300 hover:shadow-xl backdrop-filter backdrop-blur-lg bg-opacity-90 dark:bg-opacity-80">
                    <h2 class="text-3xl font-semibold text-primary-text dark:text-primary-text-dark mb-4">Hayvanın Özellikleri</h2>
                    <ul>
                        <li class="text-lg text-gray-700 dark:text-gray-400 mb-2">Tür: {{ $pet->species->name }}</li>
                        <li class="text-lg text-gray-700 dark:text-gray-400 mb-2">Irk: {{ $pet->breed->name }}</li>
                        <li class="text-lg text-gray-700 dark:text-gray-400 mb-2">Yaş: {{ $pet->age }} yaşında</li>
                        <li class="text-lg text-gray-700 dark:text-gray-400 mb-2">Cinsiyet: {{ $pet->gender }}</li>
                        <li class="text-lg text-gray-700 dark:text-gray-400 mb-2">Kısırlaştırma: {{ $pet->desexed ? 'Kısırlaştırılmış' : 'Kısırlaştırılmamış' }}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="bg-surface dark:bg-surface-dark shadow-lg rounded-lg p-6 mb-12 transition duration-300 hover:shadow-xl backdrop-filter backdrop-blur-lg bg-opacity-90 dark:bg-opacity-80">
            <h2 class="text-3xl font-semibold text-primary-text dark:text-primary-text-dark mb-4">Sahiplenme Formu</h2>
            <form wire:submit="submitAdoptionForm" class="space-y-4">
                <div class="flex flex-col space-y-2">
                    <label for="name" class="text-lg text-gray-700 dark:text-gray-400">Adınız:</label>
                    <input type="text" wire:model="name" id="name" class="w-full px-3 py-2 rounded-xl bg-input dark:bg-input-dark text-input-text dark:text-input-text-dark focus:ring-4 focus:ring-primary focus:border-primary dark:focus:ring-primary-dark dark:focus:border-primary-dark transition duration-300 placeholder-input-placeholder dark:placeholder-input-placeholder-dark text-base font-semibold shadow-md">
                </div>
                <div class="flex flex-col space-y-2">
                    <label for="email" class="text-lg text-gray-700 dark:text-gray-400">Email:</label>
                    <input type="email" wire:model="email" id="email" class="w-full px-3 py-2 rounded-xl bg-input dark:bg-input-dark text-input-text dark:text-input-text-dark focus:ring-4 focus:ring-primary focus:border-primary dark:focus:ring-primary-dark dark:focus:border-primary-dark transition duration-300 placeholder-input-placeholder dark:placeholder-input-placeholder-dark text-base font-semibold shadow-md">
                </div>
                <div class="flex flex-col space-y-2">
                    <label for="phone" class="text-lg text-gray-700 dark:text-gray-400">Telefon:</label>
                    <input type="text" wire:model="phone" id="phone" class="w-full px-3 py-2 rounded-xl bg-input dark:bg-input-dark text-input-text dark:text-input-text-dark focus:ring-4 focus:ring-primary focus:border-primary dark:focus:ring-primary-dark dark:focus:border-primary-dark transition duration-300 placeholder-input-placeholder dark:placeholder-input-placeholder-dark text-base font-semibold shadow-md">
                </div>
                <div class="flex flex-col space-y-2">
                    <label for="message" class="text-lg text-gray-700 dark:text-gray-400">Mesaj:</label>
                    <textarea wire:model="message" id="message" class="w-full px-3 py-2 rounded-xl bg-input dark:bg-input-dark text-input-text dark:text-input-text-dark focus:ring-4 focus:ring-primary focus:border-primary dark:focus:ring-primary-dark dark:focus:border-primary-dark transition duration-300 placeholder-input-placeholder dark:placeholder-input-placeholder-dark text-base font-semibold shadow-md"></textarea>
                </div>
                <button type="submit" class="px-6 py-2 bg-btn-primary dark:bg-btn-primary-dark text-btn-primary-text dark:text-btn-primary-text-dark rounded-md hover:bg-btn-primary-hover dark:hover:bg-btn-primary-hover-dark focus:outline-none focus:ring-2 focus:ring-btn-primary-focus dark:focus:ring-btn-primary-focus-dark focus:ring-offset-2 transition duration-300 text-sm font-medium">
                    Sahiplenme Talebi Gönder
                </button>
            </form>
        </div>
        <div class="bg-surface dark:bg-surface-dark shadow-lg rounded-lg p-6 mb-12 transition duration-300 hover:shadow-xl backdrop-filter backdrop-blur-lg bg-opacity-90 dark:bg-opacity-80">
            <h2 class="text-3xl font-semibold text-primary-text dark:text-primary-text-dark mb-4">İlgili Hayvanlar</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($relatedPets as $relatedPet)
                    <div class="bg-surface dark:bg-surface-dark rounded-lg shadow-lg overflow-hidden transition duration-300 hover:shadow-xl group flex flex-col">
                        <div class="relative">
                            <img src="{{ $relatedPet->image ? $relatedPet->image->url : 'https://picsum.photos/seed/' . $relatedPet->id . '/400/300' }}" alt="{{ $relatedPet->name }}" class="w-full h-48 object-cover transition duration-300 group-hover:scale-105">
                            <div class="absolute top-2 right-2 bg-btn-primary dark:bg-btn-primary-dark text-btn-primary-text dark:text-btn-primary-text-dark px-2 py-1 rounded-full text-xs font-medium">
                                {{ $relatedPet->species->name }} / {{ $relatedPet->breed->name }}
                            </div>
                        </div>
                        <div class="p-6">
                            <h2 class="text-3xl font-semibold text-primary-text dark:text-primary-text-dark mb-4">{{ $relatedPet->name }}</h2>
                            <p class="text-lg text-gray-700 dark:text-gray-400 mb-6">{{ $relatedPet->description }}</p>
                            <p class="text-lg font-semibold text-primary-text dark:text-primary-text-dark">{{ $relatedPet->age }} yaşında</p>
                            <p class="text-lg text-gray-700 dark:text-gray-400">{{ $relatedPet->gender }}</p>
                            <p class="text-lg text-gray-700 dark:text-gray-400">{{ $relatedPet->desexed ? 'Kısırlaştırılmış' : 'Kısırlaştırılmamış' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

