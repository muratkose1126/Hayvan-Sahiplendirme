<div class="bg-gradient-background dark:bg-gradient-background-dark min-h-screen py-16 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-4xl font-bold text-primary-text dark:text-primary-text-dark text-center mb-12">
            Sincan'da Yeni Bir Dost Edinin
        </h1>

        <div x-data="{ currentSlide: 0 }" x-init="setInterval(() => { currentSlide = (currentSlide + 1) % 3 }, 5000)" class="relative mb-16">
            <div class="overflow-hidden rounded-3xl">
                <div class="flex transition-transform duration-500 ease-in-out" :style="{ transform: `translateX(-${currentSlide * 100}%)` }">
                    <div class="w-full flex-shrink-0">
                        <div class="relative h-96">
                            <img src="https://images.unsplash.com/photo-1587300003388-59208cc962cb?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Sevimli Köpek" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-70"></div>
                            <h2 class="absolute bottom-6 left-6 text-4xl font-bold text-white mb-2">Sadık Dostlar</h2>
                        </div>
                    </div>
                    <div class="w-full flex-shrink-0">
                        <div class="relative h-96">
                            <img src="https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1443&q=80" alt="Tatlı Kedi" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-70"></div>
                            <h2 class="absolute bottom-6 left-6 text-4xl font-bold text-white mb-2">Sevimli Minnoşlar</h2>
                        </div>
                    </div>
                    <div class="w-full flex-shrink-0">
                        <div class="relative h-96">
                            <img src="https://images.unsplash.com/photo-1585110396000-c9ffd4e4b308?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1374&q=80" alt="Sevimli Tavşan" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-70"></div>
                            <h2 class="absolute bottom-6 left-6 text-4xl font-bold text-white mb-2">Minik Sürprizler</h2>
                        </div>
                    </div>
                </div>
            </div>
            <button @click="currentSlide = (currentSlide - 1 + 3) % 3" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-50 hover:bg-opacity-75 rounded-full p-2 transition duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </button>
            <button @click="currentSlide = (currentSlide + 1) % 3" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-50 hover:bg-opacity-75 rounded-full p-2 transition duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </button>
            <div class="absolute bottom-4 left-0 right-0">
                <div class="flex items-center justify-center gap-2">
                    <template x-for="(_, index) in [0, 1, 2]" :key="index">
                        <button @click="currentSlide = index" :class="{'bg-white': currentSlide === index, 'bg-gray-300': currentSlide !== index}" class="transition duration-300 w-3 h-3 rounded-full focus:outline-none"></button>
                    </template>
                </div>
            </div>
        </div>

        <div class="mt-32 text-center">
            <h2 class="text-5xl font-bold text-primary-text dark:text-primary-text-dark mb-16">Neden Sahiplenmeliyim?</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mt-10">
                <div class="bg-surface dark:bg-surface-dark rounded-3xl p-10">
                    <i class="fas fa-heart text-6xl text-accent dark:text-accent-dark mb-8"></i>
                    <h3 class="text-3xl font-semibold text-primary-text dark:text-primary-text-dark mb-6">Sonsuz Sevgi</h3>
                    <p class="text-secondary-text dark:text-secondary-text-dark text-lg">Koşulsuz sevgi ve bağlılık ile hayatınız değişecek.</p>
                </div>
                <div class="bg-surface dark:bg-surface-dark rounded-3xl p-10">
                    <i class="fas fa-smile-beam text-6xl text-accent dark:text-accent-dark mb-8"></i>
                    <h3 class="text-3xl font-semibold text-primary-text dark:text-primary-text-dark mb-6">Mutluluk Kaynağı</h3>
                    <p class="text-secondary-text dark:text-secondary-text-dark text-lg">Her gün yüzünüzde bir gülümseme oluşturacak dostlar.</p>
                </div>
                <div class="bg-surface dark:bg-surface-dark rounded-3xl p-10">
                    <i class="fas fa-hand-holding-heart text-6xl text-accent dark:text-accent-dark mb-8"></i>
                    <h3 class="text-3xl font-semibold text-primary-text dark:text-primary-text-dark mb-6">Bir Hayat Kurtarın</h3>
                    <p class="text-secondary-text dark:text-secondary-text-dark text-lg">Sahiplenerek bir can dostunun hayatını değiştirin.</p>
                </div>
                <div class="bg-surface dark:bg-surface-dark rounded-3xl p-10">
                    <i class="fas fa-home text-6xl text-accent dark:text-accent-dark mb-8"></i>
                    <h3 class="text-3xl font-semibold text-primary-text dark:text-primary-text-dark mb-6">Sıcak Bir Yuva</h3>
                    <p class="text-secondary-text dark:text-secondary-text-dark text-lg">Onlara sıcak bir yuva verin, size ailenizi tamamlasınlar.</p>
                </div>
            </div>
        </div>

        <div class="mt-32">
            <h2 class="text-5xl font-bold text-primary-text dark:text-primary-text-dark mb-16 text-center">Sıkça Sorulan Sorular</h2>
            <div class="space-y-4">
                <div x-data="{ open: false }" class="bg-surface dark:bg-surface-dark rounded-3xl overflow-hidden">
                    <button @click="open = !open" class="flex justify-between items-center w-full p-6 text-left">
                        <span class="text-2xl font-semibold text-primary-text dark:text-primary-text-dark">Sahiplenmek için ne yapmam gerekiyor?</span>
                        <svg class="w-6 h-6 text-primary-text dark:text-primary-text-dark transform transition-transform duration-300" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform translate-y-0" x-transition:leave-end="opacity-0 transform translate-y-4" class="p-6 text-secondary-text dark:text-secondary-text-dark text-lg">
                        Sahiplenmek için öncelikle sitemizde beğendiğiniz bir hayvanı seçmelisiniz. Ardından, sahiplenme formunu doldurarak bizimle iletişime geçebilirsiniz. Ekibimiz sizinle iletişime geçerek gerekli bilgileri verecek ve süreci başlatacaktır.
                    </div>
                </div>
                <div x-data="{ open: false }" class="bg-surface dark:bg-surface-dark rounded-3xl overflow-hidden">
                    <button @click="open = !open" class="flex justify-between items-center w-full p-6 text-left">
                        <span class="text-2xl font-semibold text-primary-text dark:text-primary-text-dark">Sahiplenme ücreti var mı?</span>
                        <svg class="w-6 h-6 text-primary-text dark:text-primary-text-dark transform transition-transform duration-300" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform translate-y-0" x-transition:leave-end="opacity-0 transform translate-y-4" class="p-6 text-secondary-text dark:text-secondary-text-dark text-lg">
                        Hayır, sahiplenmek için herhangi bir ücret talep etmiyoruz. Ancak, hayvanların sağlık kontrolleri ve aşıları için yapılan masraflar konusunda gönüllü bir bağış yapabilirsiniz.
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-32">
            <h2 class="text-5xl font-bold text-primary-text dark:text-primary-text-dark mb-16 text-center">Mutlu Sahipler</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-16">
                <div class="bg-surface dark:bg-surface-dark rounded-3xl p-8">
                    <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Kullanıcı" class="w-24 h-24 rounded-full mx-auto mb-6">
                    <p class="text-secondary-text dark:text-secondary-text-dark text-lg mb-4">"Hayatımda aldığım en güzel karar! Minik dostum ile her gün daha mutlu uyanıyorum."</p>
                    <p class="text-accent dark:text-accent-dark font-semibold">- Ayşe Y.</p>
                </div>
                <div class="bg-surface dark:bg-surface-dark rounded-3xl p-8">
                    <img src="https://randomuser.me/api/portraits/men/54.jpg" alt="Kullanıcı" class="w-24 h-24 rounded-full mx-auto mb-6">
                    <p class="text-secondary-text dark:text-secondary-text-dark text-lg mb-4">"Sahiplendiğim kedi ile evim artık çok daha neşeli. Teşekkürler Sincan Hayvan Barınağı!"</p>
                    <p class="text-accent dark:text-accent-dark font-semibold">- Mehmet K.</p>
                </div>
                <div class="bg-surface dark:bg-surface-dark rounded-3xl p-8">
                    <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Kullanıcı" class="w-24 h-24 rounded-full mx-auto mb-6">
                    <p class="text-secondary-text dark:text-secondary-text-dark text-lg mb-4">"Sahiplenme süreci çok kolay ve hızlıydı. Şimdi harika bir köpeğim var!"</p>
                    <p class="text-accent dark:text-accent-dark font-semibold">- Zeynep A.</p>
                </div>
            </div>
        </div>
    </div>
</div>
