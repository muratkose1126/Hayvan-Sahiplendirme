<div class="min-h-screen bg-gradient-background dark:bg-gradient-background-dark py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-5xl font-black text-center text-primary-text dark:text-primary-text-dark mb-12 tracking-tight leading-tight">
            {{ $pet->name }}
        </h1>

        <div class="bg-surface dark:bg-surface-dark shadow-lg rounded-lg p-6 mb-12 transition duration-300 hover:shadow-xl backdrop-filter backdrop-blur-lg bg-opacity-90 dark:bg-opacity-80">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div x-data="{ currentIndex: 0, images: ['https://picsum.photos/seed/1/400/300', 'https://picsum.photos/seed/2/400/300', 'https://picsum.photos/seed/3/400/300'] }">
                    <div class="relative mb-4 overflow-hidden rounded-lg">
                        <img x-bind:src="images[currentIndex]" alt="{{ $pet->name }}" class="w-full h-48 object-cover transition duration-300 transform hover:scale-110">
                        <div class="absolute top-2 right-2 bg-btn-primary dark:bg-btn-primary-dark text-btn-primary-text dark:text-btn-primary-text-dark px-2 py-1 rounded-full text-xs font-medium">
                            {{ $pet->species->name }} / {{ $pet->breed->name }}
                        </div>
                        <button @click="currentIndex = (currentIndex - 1 + images.length) % images.length" class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <button @click="currentIndex = (currentIndex + 1) % images.length" class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                    <div class="flex justify-center space-x-2">
                        <template x-for="(image, index) in images" :key="index">
                            <button @click="currentIndex = index" class="w-3 h-3 rounded-full" :class="{ 'bg-primary': currentIndex === index, 'bg-gray-300': currentIndex !== index }"></button>
                        </template>
                    </div>
                    <h2 class="text-3xl font-semibold text-primary-text dark:text-primary-text-dark mb-4 mt-4">{{ $pet->name }}</h2>
                    <p class="text-lg text-gray-700 dark:text-gray-400 mb-6">{{ $pet->description }}</p>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    @foreach(['Yaş' => $pet->ageString . ' yaşında', 'Cinsiyet' => $pet->gender, 'Tür' => $pet->species->name, 'Irk' => $pet->breed->name, 'Kısırlaştırma' => $pet->desexed ? 'Kısırlaştırılmış' : 'Kısırlaştırılmamış'] as $title => $value)
                        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow transition duration-300 transform hover:scale-105 hover:shadow-lg">
                            <h3 class="text-xl font-semibold text-primary-text dark:text-primary-text-dark mb-2">{{ $title }}</h3>
                            <p class="text-lg text-gray-700 dark:text-gray-400">{{ $value }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="bg-surface dark:bg-surface-dark shadow-lg rounded-lg p-6 mb-12 transition duration-300 hover:shadow-xl backdrop-filter backdrop-blur-lg bg-opacity-90 dark:bg-opacity-80">
            <h2 class="text-3xl font-semibold text-primary-text dark:text-primary-text-dark mb-4">Sahiplenme Formu</h2>
            <form wire:submit.prevent="submitAdoptionForm" class="space-y-4">
                @foreach(['name' => 'Adınız:', 'email' => 'Email:', 'phone' => 'Telefon:'] as $field => $label)
                    <div class="flex flex-col space-y-2">
                        <label for="{{ $field }}" class="text-lg text-gray-700 dark:text-gray-400">{{ $label }}</label>
                        <input type="{{ $field === 'email' ? 'email' : 'text' }}" wire:model.defer="{{ $field }}" id="{{ $field }}" class="w-full px-3 py-2 rounded-xl bg-input dark:bg-input-dark text-input-text dark:text-input-text-dark focus:ring-4 focus:ring-primary focus:border-primary dark:focus:ring-primary-dark dark:focus:border-primary-dark transition duration-300 placeholder-input-placeholder dark:placeholder-input-placeholder-dark text-base font-semibold shadow-md">
                        @error($field) <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                @endforeach
                <div class="flex flex-col space-y-2">
                    <label for="message" class="text-lg text-gray-700 dark:text-gray-400">Mesaj:</label>
                    <textarea wire:model.defer="message" id="message" class="w-full px-3 py-2 rounded-xl bg-input dark:bg-input-dark text-input-text dark:text-input-text-dark focus:ring-4 focus:ring-primary focus:border-primary dark:focus:ring-primary-dark dark:focus:border-primary-dark transition duration-300 placeholder-input-placeholder dark:placeholder-input-placeholder-dark text-base font-semibold shadow-md"></textarea>
                    @error('message') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <button type="submit" class="px-6 py-2 bg-btn-primary dark:bg-btn-primary-dark text-btn-primary-text dark:text-btn-primary-text-dark rounded-md hover:bg-btn-primary-hover dark:hover:bg-btn-primary-hover-dark focus:outline-none focus:ring-2 focus:ring-btn-primary-focus dark:focus:ring-btn-primary-focus-dark focus:ring-offset-2 transition duration-300 text-sm font-medium">
                    Sahiplenme Talebi Gönder
                </button>
            </form>
        </div>
        <div class="mb-12">
            <h2 class="text-3xl font-semibold text-primary-text dark:text-primary-text-dark mb-4">İlgili Hayvanlar</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($relatedPets as $relatedPet)
                <livewire:components.pet-card :pet="$relatedPet" :key="$relatedPet->id" />
                @endforeach
            </div>
        </div>
    </div>
</div>
