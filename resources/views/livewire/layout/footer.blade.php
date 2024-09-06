<footer class="bg-gray-800 text-white py-8">
    <div class="container mx-auto px-4">
        <div class="flex flex-wrap justify-between">
            <div class="w-full md:w-1/4 mb-6 md:mb-0">
                <h3 class="text-xl font-bold mb-4">Evcil Hayvan Sahiplendirme</h3>
                <p class="text-sm">Sevimli dostlarımıza yeni bir yuva buluyoruz.</p>
            </div>
            <div class="w-full md:w-1/4 mb-6 md:mb-0">
                <h4 class="text-lg font-semibold mb-4">Hızlı Bağlantılar</h4>
                <ul class="text-sm">
                    <li class="mb-2"><a href="{{ route('home') }}" class="hover:text-gray-300">Ana Sayfa</a></li>
                    <li class="mb-2"><a href="{{ route('pets') }}" class="hover:text-gray-300">Evcil Hayvanlar</a></li>
                </ul>
            </div>
            <div class="w-full md:w-1/4 mb-6 md:mb-0">
                <h4 class="text-lg font-semibold mb-4">İletişim</h4>
                <p class="text-sm mb-2">Telefon: (555) 123-4567</p>
                <p class="text-sm mb-2">E-posta: iletisim@evcilhayvan.com</p>
            </div>
            <div class="w-full md:w-1/4">
                <h4 class="text-lg font-semibold mb-4">Bizi Takip Edin</h4>
                <div class="flex space-x-4">
                    <a href="#" class="text-white hover:text-gray-300"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-white hover:text-gray-300"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-white hover:text-gray-300"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="border-t border-gray-700 mt-8 pt-6 text-sm text-center">
            <p>&copy; {{ date('Y') }} Evcil Hayvan Sahiplendirme. Tüm hakları saklıdır.</p>
        </div>
    </div>
</footer>
