<div
    class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden transition duration-300 transform hover:scale-105 hover:shadow-xl">
    <div class="relative">
        <img src="{{ $pet->image ? $pet->image->url : 'https://picsum.photos/seed/' . $pet->id . '/400/300' }}"
            alt="{{ $pet->name }}" class="w-full h-48 object-cover transition duration-300 group-hover:scale-105">
        <div
            class="absolute top-2 right-2 bg-btn-primary dark:bg-btn-primary-dark text-btn-primary-text dark:text-btn-primary-text-dark px-2 py-1 rounded-full text-xs font-medium animate-pulse">
            {{ $pet->species->name }} / {{ $pet->breed->name }}
        </div>
    </div>
    <div class="p-4">
        <h2 class="text-2xl font-semibold text-primary-text dark:text-primary-text-dark mb-2">{{ $pet->name }}</h2>
        <p class="text-sm text-gray-700 dark:text-gray-400 mb-4">{{ Str::limit($pet->description, 100) }}</p>
        <p class="text-sm font-semibold text-primary-text dark:text-primary-text-dark">{{ $pet->ageString }} yaşında</p>
        <p class="text-sm text-gray-700 dark:text-gray-400">{{ $pet->gender }}</p>
        <p class="text-sm text-gray-700 dark:text-gray-400 mb-4">
            {{ $pet->desexed ? 'Kısırlaştırılmış' : 'Kısırlaştırılmamış' }}</p>
        <div class="flex justify-center">
            @if ($pet->is_adopted)
                <span class="px-4 py-2 bg-green-500 text-white rounded-md text-sm font-medium">Sahiplenildi</span>
            @else
                <a href="{{ route('pet', $pet->id) }}"
                    class="px-4 py-2 bg-btn-primary dark:bg-btn-primary-dark text-btn-primary-text dark:text-btn-primary-text-dark rounded-md hover:bg-btn-primary-hover dark:hover:bg-btn-primary-hover-dark focus:outline-none focus:ring-2 focus:ring-btn-primary-focus dark:focus:ring-btn-primary-focus-dark focus:ring-offset-2 transition duration-300 text-sm font-medium transform hover:scale-105">
                    Sahiplen
                </a>
            @endif
            <button wire:click="share({{ $pet->id }})"
                class="px-4 py-2 bg-btn-secondary dark:bg-btn-secondary-dark text-btn-secondary-text dark:text-btn-secondary-text-dark rounded-md hover:bg-btn-secondary-hover dark:hover:bg-btn-secondary-hover-dark focus:outline-none focus:ring-2 focus:ring-btn-secondary-focus dark:focus:ring-btn-secondary-focus-dark focus:ring-offset-2 transition duration-300 text-sm font-medium ml-2 transform hover:scale-105">
                Paylaş
            </button>
        </div>
    </div>
</div>
