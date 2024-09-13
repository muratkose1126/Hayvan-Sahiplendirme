<div class="min-h-screen bg-gradient-background dark:bg-gradient-background-dark py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-100 mb-6">Hakkımızda</h2>

        <div class="space-y-6">
            <p class="text-lg text-gray-600 dark:text-gray-400">
                Evcil dostlarımıza sevgi dolu yuvalar bulmak için buradayız. Her can dostumuzun mutluluğu bizim önceliğimiz.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <h3 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-2">Misyonumuz</h3>
                    <p class="text-gray-600 dark:text-gray-400">{{ $misyonumuz }}</p>
                </div>
                <div>
                    <h3 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-2">Vizyonumuz</h3>
                    <p class="text-gray-600 dark:text-gray-400">{{ $vizyonumuz }}</p>
                </div>
            </div>

            <div class="mt-8">
                <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Ekibimiz</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($ekibimiz as $uye)
                        <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg">
                            <h4 class="text-lg font-medium text-gray-700 dark:text-gray-300">{{ $uye['isim'] }}</h4>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $uye['pozisyon'] }}</p>
                            <p class="mt-2 text-gray-600 dark:text-gray-400">{{ $uye['aciklama'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="mt-8">
                <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Neden Biz?</h3>
                <ul class="list-disc list-inside space-y-2 text-gray-600 dark:text-gray-400">
                    <li>Deneyimli ve tutkulu ekibimiz</li>
                    <li>Güvenilir sahiplendirme süreci</li>
                    <li>Evcil hayvan bakımı konusunda ücretsiz danışmanlık</li>
                    <li>Sahiplendirme sonrası destek</li>
                </ul>
            </div>

            <div class="mt-8">
                <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Başarı Hikayelerimiz</h3>
                <div class="bg-gray-100 dark:bg-gray-700 p-6 rounded-lg">
                    <blockquote class="italic text-gray-600 dark:text-gray-400">
                        "Evcil Hayvan Sahiplendirme sayesinde hayatımın aşkı olan köpeğim Paşa'yı buldum. Onlar olmasaydı, bu mutluluğu yaşayamazdım."
                    </blockquote>
                    <p class="mt-2 text-right text-gray-500 dark:text-gray-300">- Ayşe K., Mutlu Sahiplenen</p>
                </div>
            </div>
        </div>

        <div class="mt-10 text-center">
            <a href="{{ route('contact') }}" class="inline-block px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition duration-300">
                Bize Ulaşın
            </a>
        </div>
    </div>
</div>
