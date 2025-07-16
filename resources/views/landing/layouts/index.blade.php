<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ClassAttend - Sistem Absensi Kelas Modern</title>
    <meta name="description" content="Sistem absensi kelas yang modern, sederhana, dan efisien untuk mengelola kehadiran siswa dengan mudah.">
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gradient-to-br from-blue-50 via-white to-purple-50 min-h-screen">
    <!-- Navigation -->
    @include('landing.partials.navbar')
    <main>
        @yield('content')
    </main>    <!-- Footer -->

    <div x-data="{ loginModalOpen: false }" 
             @open-login-modal.window="loginModalOpen = true; document.body.style.overflow = 'hidden'"
             @keydown.escape.window="if(loginModalOpen) { loginModalOpen = false; document.body.style.overflow = 'auto' }"
             x-show="loginModalOpen" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-[60] overflow-y-auto" 
             style="display: none;">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">                <!-- Background overlay -->
                <div class="fixed inset-0 transition-opacity bg-gray-900/30 backdrop-blur-sm z-[61]" 
                     @click="loginModalOpen = false; document.body.style.overflow = 'auto'"></div><!-- Modal content -->
                <div class="relative inline-block w-full max-w-md p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white/90 backdrop-blur-md shadow-xl rounded-2xl z-[62] border border-white/20"><div class="flex items-center justify-between mb-6">
                        <h3 class="text-2xl font-bold text-gray-900">Pilih Jenis Login</h3>
                        <button @click="loginModalOpen = false; document.body.style.overflow = 'auto'" class="text-gray-400 hover:text-gray-600 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <div class="space-y-4">                        <!-- User Login Option -->
                        <a href="/login-user" 
                           class="group block w-full p-6 bg-gradient-to-r from-blue-50/80 to-blue-100/80 hover:from-blue-100/90 hover:to-blue-200/90 border border-blue-200/50 rounded-xl transition-all duration-300 hover:shadow-lg transform hover:-translate-y-1 backdrop-blur-sm">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-900 group-hover:text-blue-700">Login sebagai User</h4>
                                    <p class="text-sm text-gray-600">Akses untuk mahasiswa dan dosen</p>
                                </div>
                                <div class="ml-auto">
                                    <svg class="w-5 h-5 text-blue-500 group-hover:text-blue-700 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>
                            </div>
                        </a>

                        <!-- Admin Login Option -->
                        <a href="/admin" 
                           class="group block w-full p-6 bg-gradient-to-r from-purple-50/80 to-purple-100/80 hover:from-purple-100/90 hover:to-purple-200/90 border border-purple-200/50 rounded-xl transition-all duration-300 hover:shadow-lg transform hover:-translate-y-1 backdrop-blur-sm">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.031 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-900 group-hover:text-purple-700">Login sebagai Admin</h4>
                                    <p class="text-sm text-gray-600">Akses untuk admin</p>
                                </div>
                                <div class="ml-auto">
                                    <svg class="w-5 h-5 text-purple-500 group-hover:text-purple-700 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @include('landing.partials.footer')

    <!-- Smooth Scrolling and Active Section Detection Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // Active section detection on scroll
            const sections = document.querySelectorAll('section[id]');
            const navLinks = document.querySelectorAll('nav a[href^="#"]');
            
            function updateActiveNav() {
                let current = '';
                sections.forEach(section => {
                    const rect = section.getBoundingClientRect();
                    if (rect.top <= 100 && rect.bottom >= 100) {
                        current = section.getAttribute('id');
                    }
                });

                // Update Alpine.js data
                if (window.Alpine && current) {
                    const navComponent = document.querySelector('nav[x-data]');
                    if (navComponent && navComponent._x_dataStack) {
                        navComponent._x_dataStack[0].activeItem = current;
                    }
                }
            }

            // Throttled scroll event
            let ticking = false;
            function onScroll() {
                if (!ticking) {
                    requestAnimationFrame(() => {
                        updateActiveNav();
                        ticking = false;
                    });
                    ticking = true;
                }
            }

            window.addEventListener('scroll', onScroll);
        });
    </script>

   
</body>
</html>
