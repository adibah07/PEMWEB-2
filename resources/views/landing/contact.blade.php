@extends('landing.layouts.index')
@section('content')
    <!-- Hero Section -->
    <section class="relative py-20 lg:py-32 overflow-hidden">
        <!-- Animated Background -->
        <div class="absolute inset-0 -z-10">
            <div class="absolute top-20 left-10 w-96 h-96 bg-blue-300/30 rounded-full mix-blend-multiply filter blur-xl animate-pulse"></div>
            <div class="absolute top-40 right-10 w-96 h-96 bg-purple-300/30 rounded-full mix-blend-multiply filter blur-xl animate-pulse animation-delay-1s"></div>
            <div class="absolute bottom-20 left-1/3 w-96 h-96 bg-pink-300/30 rounded-full mix-blend-multiply filter blur-xl animate-pulse animation-delay-2s"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <div class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-800 rounded-full text-sm font-medium mb-6">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    Mari Terhubung
                </div>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-gray-900 mb-6">
                    Hubungi <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Tim Kami</span>
                </h1>
                <p class="text-xl text-gray-600 mb-12 max-w-3xl mx-auto leading-relaxed">
                    Kami siap membantu Anda dalam perjalanan digitalisasi absensi. Tim expert kami 
                    akan memberikan solusi terbaik untuk kebutuhan sekolah Anda.
                </p>
                
                <!-- Quick Stats -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-3xl mx-auto">
                    <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-gray-200/50">
                        <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-emerald-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="text-2xl font-bold text-gray-900 mb-1">24/7</div>
                        <div class="text-gray-600 text-sm">Support Available</div>
                    </div>
                    <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-gray-200/50">
                        <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path>
                            </svg>
                        </div>
                        <div class="text-2xl font-bold text-gray-900 mb-1">< 2 Jam</div>
                        <div class="text-gray-600 text-sm">Response Time</div>
                    </div>
                    <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-gray-200/50">
                        <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="text-2xl font-bold text-gray-900 mb-1">99.9%</div>
                        <div class="text-gray-600 text-sm">Customer Satisfaction</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Methods Section -->
    <section class="py-20 bg-white/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">
                    Berbagai Cara <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Menghubungi Kami</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Pilih cara yang paling nyaman untuk Anda
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-16">
                <!-- Email -->
                <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 hover:border-blue-200 text-center">
                    <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Email Support</h3>
                    <p class="text-gray-600 mb-4">Kirim pertanyaan detail Anda melalui email</p>
                    <a href="mailto:support@classattend.com" class="text-blue-600 font-medium hover:text-blue-700">support@classattend.com</a>
                </div>

                <!-- Phone -->
                <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 hover:border-green-200 text-center">
                    <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Phone Support</h3>
                    <p class="text-gray-600 mb-4">Bicara langsung dengan tim support kami</p>
                    <a href="tel:+628001234567" class="text-green-600 font-medium hover:text-green-700">+62 800 1234 567</a>
                </div>

                <!-- WhatsApp -->
                <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 hover:border-green-200 text-center">
                    <div class="w-16 h-16 bg-gradient-to-r from-green-400 to-green-500 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.109"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">WhatsApp</h3>
                    <p class="text-gray-600 mb-4">Chat langsung untuk response cepat</p>
                    <a href="https://wa.me/628001234567" class="text-green-600 font-medium hover:text-green-700">+62 800 1234 567</a>
                </div>

                <!-- Live Chat -->
                <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 hover:border-purple-200 text-center">
                    <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Live Chat</h3>
                    <p class="text-gray-600 mb-4">Chat real-time dengan tim kami</p>
                    <button class="text-purple-600 font-medium hover:text-purple-700">Mulai Chat</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Form & Map Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
                <!-- Contact Form -->
                <div>
                    <div class="bg-gradient-to-br from-blue-50 to-purple-50 rounded-3xl p-8 shadow-xl border border-gray-200/50">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Kirim Pesan</h3>
                        <form class="space-y-6" x-data="{ submitted: false }" @submit.prevent="submitted = true">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="firstName" class="block text-sm font-medium text-gray-700 mb-2">Nama Depan</label>
                                    <input type="text" id="firstName" name="firstName" required 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                </div>
                                <div>
                                    <label for="lastName" class="block text-sm font-medium text-gray-700 mb-2">Nama Belakang</label>
                                    <input type="text" id="lastName" name="lastName" required 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                </div>
                            </div>
                            
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input type="email" id="email" name="email" required 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                            </div>
                            
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                                <input type="tel" id="phone" name="phone" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                            </div>
                            
                            <div>
                                <label for="institution" class="block text-sm font-medium text-gray-700 mb-2">Nama Sekolah/Institusi</label>
                                <input type="text" id="institution" name="institution" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                            </div>
                            
                            <div>
                                <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subjek</label>
                                <select id="subject" name="subject" required 
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                    <option value="">Pilih subjek</option>
                                    <option value="demo">Request Demo</option>
                                    <option value="pricing">Pertanyaan Harga</option>
                                    <option value="support">Technical Support</option>
                                    <option value="partnership">Partnership</option>
                                    <option value="other">Lainnya</option>
                                </select>
                            </div>
                            
                            <div>
                                <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Pesan</label>
                                <textarea id="message" name="message" rows="5" required 
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 resize-none"
                                          placeholder="Ceritakan lebih detail tentang kebutuhan Anda..."></textarea>
                            </div>
                            
                            <div class="flex items-center">
                                <input type="checkbox" id="privacy" name="privacy" required 
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="privacy" class="ml-2 block text-sm text-gray-700">
                                    Saya setuju dengan <a href="#" class="text-blue-600 hover:text-blue-700">kebijakan privasi</a>
                                </label>
                            </div>
                            
                            <button type="submit" 
                                    :class="submitted ? 'bg-green-500 hover:bg-green-600' : 'bg-gradient-to-r from-blue-500 to-purple-600 hover:shadow-lg transform hover:-translate-y-0.5'"
                                    class="w-full text-white px-8 py-4 rounded-lg text-lg font-semibold transition-all duration-300 flex items-center justify-center">
                                <span x-show="!submitted" class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                    </svg>
                                    Kirim Pesan
                                </span>
                                <span x-show="submitted" class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Pesan Terkirim!
                                </span>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Office Info & Map -->
                <div class="space-y-8">
                    <!-- Office Info -->
                    <div class="bg-white rounded-3xl p-8 shadow-xl border border-gray-200/50">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Kantor Kami</h3>
                        <div class="space-y-6">
                            <div class="flex items-start">
                                <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-1">Alamat</h4>
                                    <p class="text-gray-600">Jl. Teknologi No. 123<br>Jakarta Selatan 12560<br>Indonesia</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-emerald-600 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-1">Jam Operasional</h4>
                                    <p class="text-gray-600">Senin - Jumat: 09:00 - 18:00<br>Sabtu: 09:00 - 15:00<br>Minggu: Tutup</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-1">Email Kantor</h4>
                                    <p class="text-gray-600">office@classattend.com<br>info@classattend.com</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Map -->
                    <div class="bg-white rounded-3xl p-2 shadow-xl border border-gray-200/50 overflow-hidden">
                        <div id="map" class="w-full h-80 rounded-2xl"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-20 bg-gradient-to-r from-gray-50 to-blue-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">
                    Pertanyaan <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Umum</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Temukan jawaban untuk pertanyaan yang sering diajukan
                </p>
            </div>

            <div class="space-y-4" x-data="{ openFaq: null }">
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <button @click="openFaq = openFaq === 1 ? null : 1" class="w-full px-8 py-6 text-left flex items-center justify-between hover:bg-gray-50 transition-colors">
                        <span class="font-semibold text-gray-900">Berapa lama waktu implementasi ClassAttend?</span>
                        <svg :class="openFaq === 1 ? 'rotate-180' : ''" class="w-5 h-5 text-gray-500 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="openFaq === 1" x-transition class="px-8 pb-6">
                        <p class="text-gray-600">Implementasi ClassAttend biasanya memakan waktu 1-2 minggu, tergantung pada ukuran sekolah dan kompleksitas kebutuhan. Tim kami akan membantu proses setup dan training untuk memastikan transisi yang mulus.</p>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <button @click="openFaq = openFaq === 2 ? null : 2" class="w-full px-8 py-6 text-left flex items-center justify-between hover:bg-gray-50 transition-colors">
                        <span class="font-semibold text-gray-900">Apakah ada trial gratis?</span>
                        <svg :class="openFaq === 2 ? 'rotate-180' : ''" class="w-5 h-5 text-gray-500 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="openFaq === 2" x-transition class="px-8 pb-6">
                        <p class="text-gray-600">Ya! Kami menyediakan trial gratis 30 hari tanpa komitmen. Anda dapat mencoba semua fitur ClassAttend dan melihat bagaimana sistem ini dapat membantu sekolah Anda.</p>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <button @click="openFaq = openFaq === 3 ? null : 3" class="w-full px-8 py-6 text-left flex items-center justify-between hover:bg-gray-50 transition-colors">
                        <span class="font-semibold text-gray-900">Bagaimana dengan keamanan data?</span>
                        <svg :class="openFaq === 3 ? 'rotate-180' : ''" class="w-5 h-5 text-gray-500 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="openFaq === 3" x-transition class="px-8 pb-6">
                        <p class="text-gray-600">Keamanan data adalah prioritas utama kami. Kami menggunakan enkripsi end-to-end, server yang tersertifikasi ISO 27001, dan compliance dengan regulasi perlindungan data. Data Anda disimpan dengan aman di data center Indonesia.</p>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <button @click="openFaq = openFaq === 4 ? null : 4" class="w-full px-8 py-6 text-left flex items-center justify-between hover:bg-gray-50 transition-colors">
                        <span class="font-semibold text-gray-900">Apakah ClassAttend bisa terintegrasi dengan sistem sekolah yang ada?</span>
                        <svg :class="openFaq === 4 ? 'rotate-180' : ''" class="w-5 h-5 text-gray-500 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="openFaq === 4" x-transition class="px-8 pb-6">
                        <p class="text-gray-600">Tentu saja! ClassAttend dilengkapi dengan API yang fleksibel dan dapat terintegrasi dengan berbagai sistem manajemen sekolah (SIS), Google Classroom, Microsoft Teams Education, dan platform pembelajaran lainnya.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-blue-600 to-purple-600">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl lg:text-4xl font-bold text-white mb-6">
                Siap Memulai Transformasi Digital?
            </h2>
            <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                Jangan ragu untuk menghubungi kami. Tim expert kami siap membantu Anda mengoptimalkan sistem absensi sekolah.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <button class="bg-white text-blue-600 px-8 py-4 rounded-full text-lg font-semibold hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                    Schedule Demo
                </button>
                <a href="{{ route('features') }}" class="border-2 border-white text-white px-8 py-4 rounded-full text-lg font-semibold hover:bg-white hover:text-blue-600 transition-all duration-300">
                    Lihat Fitur Lengkap
                </a>
            </div>
        </div>
    </section>

    <!-- Custom Scripts -->
    <script>
        // Initialize Map
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Leaflet map
            const map = L.map('map').setView([-6.2088, 106.8456], 15);
            
            // Add tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);
            
            // Add marker
            const marker = L.marker([-6.2088, 106.8456]).addTo(map);
            marker.bindPopup('<b>ClassAttend Office</b><br>Jl. Teknologi No. 123<br>Jakarta Selatan').openPopup();
        });

        // Animation delays
        const style = document.createElement('style');
        style.textContent = `
            .animation-delay-1s { animation-delay: 1s; }
            .animation-delay-2s { animation-delay: 2s; }
        `;
        document.head.appendChild(style);
    </script>
@endsection
