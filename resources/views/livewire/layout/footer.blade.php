<footer class="bg-gray-900 text-gray-300 py-10 mt-auto">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <h3 class="text-2xl font-bold text-white mb-4">Evcil Hayvan Sahiplendirme</h3>
                <p class="text-sm">Sevimli dostlarımıza yeni bir yuva buluyoruz.</p>
            </div>
            <div>
                <h4 class="text-lg font-semibold text-white mb-4">Hızlı Bağlantılar</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}" class="hover:text-white transition duration-300">Ana Sayfa</a></li>
                    <li><a href="{{ route('pets') }}" class="hover:text-white transition duration-300">Evcil Hayvanlar</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-white transition duration-300">İletişim</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-lg font-semibold text-white mb-4">İletişim</h4>
                <p class="mb-2">Telefon: (555) 123-4567</p>
                <p class="mb-2">E-posta: iletisim@evcilhayvan.com</p>
                <p>Adres: Hayvan Sokak No:1, İstanbul</p>
            </div>
            <div>
                <h4 class="text-lg font-semibold text-white mb-4">Bizi Takip Edin</h4>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-white transition duration-300"><i class="fab fa-facebook-f text-2xl"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white transition duration-300"><i class="fab fa-twitter text-2xl"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white transition duration-300"><i class="fab fa-instagram text-2xl"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white transition duration-300"><i class="fab fa-youtube text-2xl"></i></a>
                </div>
            </div>
        </div>
        <div class="border-t border-gray-800 mt-10 pt-6 text-sm text-center">
            <p>&copy; {{ date('Y') }} Evcil Hayvan Sahiplendirme. Tüm hakları saklıdır.</p>
        </div>
    </div>
</footer>

