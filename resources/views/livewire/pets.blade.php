<div class="min-h-screen bg-gradient-background dark:bg-gradient-background-dark py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-black text-center text-primary-text dark:text-primary-text-dark mb-12 tracking-tight leading-tight">
            Sevgi Dolu Dostlar
        </h1>

        <div class="bg-surface dark:bg-surface-dark shadow-lg rounded-lg p-6 mb-12 transition duration-300 hover:shadow-xl backdrop-filter backdrop-blur-lg bg-opacity-90 dark:bg-opacity-80">
            <h2 class="text-2xl font-semibold text-primary-text dark:text-primary-text-dark mb-6">Filtrele</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6">
                <select wire:model="species" class="w-full px-3 py-2 rounded-xl bg-input dark:bg-input-dark text-input-text dark:text-input-text-dark focus:ring-4 focus:ring-primary focus:border-primary dark:focus:ring-primary-dark dark:focus:border-primary-dark transition duration-300 appearance-none text-base font-semibold shadow-md">
                    <option value="" class="font-bold">Tür</option>
                    @foreach($speciesList as $species)
                        <option value="{{ $species->id }}" class="font-semibold">{{ $species->name }}</option>
                    @endforeach
                </select>
                <select wire:model="breed" class="w-full px-3 py-2 rounded-xl bg-input dark:bg-input-dark text-input-text dark:text-input-text-dark focus:ring-4 focus:ring-primary focus:border-primary dark:focus:ring-primary-dark dark:focus:border-primary-dark transition duration-300 appearance-none text-base font-semibold shadow-md">
                    <option value="" class="font-bold">Irk</option>
                    @foreach($breedList as $breed)
                        <option value="{{ $breed->id }}" class="font-semibold">{{ $breed->name }}</option>
                    @endforeach
                </select>
                <input type="number" wire:model="minAge" placeholder="Min Yaş" class="w-full px-3 py-2 rounded-xl bg-input dark:bg-input-dark text-input-text dark:text-input-text-dark focus:ring-4 focus:ring-primary focus:border-primary dark:focus:ring-primary-dark dark:focus:border-primary-dark transition duration-300 placeholder-input-placeholder dark:placeholder-input-placeholder-dark text-base font-semibold shadow-md">
                <input type="number" wire:model="maxAge" placeholder="Max Yaş" class="w-full px-3 py-2 rounded-xl bg-input dark:bg-input-dark text-input-text dark:text-input-text-dark focus:ring-4 focus:ring-primary focus:border-primary dark:focus:ring-primary-dark dark:focus:border-primary-dark transition duration-300 placeholder-input-placeholder dark:placeholder-input-placeholder-dark text-base font-semibold shadow-md">
                <select wire:model="gender" class="w-full px-3 py-2 rounded-xl bg-input dark:bg-input-dark text-input-text dark:text-input-text-dark focus:ring-4 focus:ring-primary focus:border-primary dark:focus:ring-primary-dark dark:focus:border-primary-dark transition duration-300 appearance-none text-base font-semibold shadow-md">
                    <option value="" class="font-bold">Cinsiyet</option>
                    <option value="male" class="font-semibold">Erkek</option>
                    <option value="female" class="font-semibold">Dişi</option>
                </select>
            </div>
            <div class="mt-4 flex justify-end space-x-4">
                <button wire:click="resetFilters" class="px-6 py-2 bg-btn-secondary dark:bg-btn-secondary-dark text-btn-secondary-text dark:text-btn-secondary-text-dark rounded-md hover:bg-btn-secondary-hover dark:hover:bg-btn-secondary-hover-dark focus:outline-none focus:ring-2 focus:ring-btn-secondary-focus dark:focus:ring-btn-secondary-focus-dark focus:ring-offset-2 transition duration-300 text-sm font-medium">
                    Sıfırla
                </button>
                <button wire:click="filter" class="px-6 py-2 bg-btn-primary dark:bg-btn-primary-dark text-btn-primary-text dark:text-btn-primary-text-dark rounded-md hover:bg-btn-primary-hover dark:hover:bg-btn-primary-hover-dark focus:outline-none focus:ring-2 focus:ring-btn-primary-focus dark:focus:ring-btn-primary-focus-dark focus:ring-offset-2 transition duration-300 text-sm font-medium">
                    Filtrele
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($pets as $pet)
                <livewire:components.pet-card :pet="$pet" :key="$pet->id" />
            @empty
                <div class="col-span-full text-center text-xl text-primary-text dark:text-primary-text-dark">
                    Üzgünüz, aradığınız kriterlere uygun hayvan bulunamadı.
                </div>
            @endforelse
        </div>

        @if($pets->isNotEmpty())
            <div class="mt-8 mb-8">
                {{ $pets->links(data: ['scrollTo' => false, "theme" => "simple-tailwind"]) }}
            </div>
        @endif
    </div>
</div>
