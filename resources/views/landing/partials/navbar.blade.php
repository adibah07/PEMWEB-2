<nav class="bg-white/80 backdrop-blur-md border-b border-gray-200/20 sticky top-0 z-50" x-data="{ open: false, activeItem: '{{ request()->route() ? request()->route()->getName() : 'home' }}' }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ route('home') }}" class="flex items-center">
                            <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <span class="ml-3 text-xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">ClassAttend</span>
                        </a>
                    </div>
                </div>
                
                <!-- Desktop Menu -->
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-2">
                        <a href="{{ route('home') }}" 
                           class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 border border-transparent
                           {{ request()->routeIs('home') ? 'bg-blue-50 text-blue-600 border-blue-200' : 'text-gray-700 hover:text-blue-600 hover:bg-blue-50' }}">
                           Beranda
                        </a>                        <a href="{{ route('features') }}" 
                           class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 border border-transparent
                           {{ request()->routeIs('features') ? 'bg-blue-50 text-blue-600 border-blue-200' : 'text-gray-700 hover:text-blue-600 hover:bg-blue-50' }}">
                           Fitur
                        </a>
                        <a href="{{ route('how-it-works') }}" 
                           class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 border border-transparent
                           {{ request()->routeIs('how-it-works') ? 'bg-blue-50 text-blue-600 border-blue-200' : 'text-gray-700 hover:text-blue-600 hover:bg-blue-50' }}">
                           Cara Kerja
                        </a>                        <a href="{{ route('about') }}" 
                           class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 border border-transparent
                           {{ request()->routeIs('about') ? 'bg-blue-50 text-blue-600 border-blue-200' : 'text-gray-700 hover:text-blue-600 hover:bg-blue-50' }}">
                           Tentang
                        </a>                        <a href="{{ route('contact') }}" 
                           class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 border border-transparent
                           {{ request()->routeIs('contact') ? 'bg-blue-50 text-blue-600 border-blue-200' : 'text-gray-700 hover:text-blue-600 hover:bg-blue-50' }}">
                           Kontak
                        </a>                       
                         @auth
                         @if(auth()->user()->role === 'dosen')
                            <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 border border-transparent bg-blue-500 text-white hover:bg-blue-600">
                               Dashboard
                            </a>
                        @elseif(auth()->user()->role === 'mahasiswa')
                            <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 border border-transparent bg-blue-500 text-white hover:bg-blue-600">
                               Dashboard
                            </a>
                        @elseif(auth()->user()->role === 'admin')
                            <a href="/admin" class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 border border-transparent bg-blue-500 text-white hover:bg-blue-600">
                               Dashboard
                            </a>
                            @else
                            @endif
                            @endauth
                            @if(!auth()->user())
                            <button @click="$dispatch('open-login-modal')" class="bg-gradient-to-r from-blue-500 to-purple-600 text-white px-6 py-2 rounded-full text-sm font-medium hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200 ml-4">
                                Login
                            </button>
                            @endif
                    </div>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button @click="open = !open" class="text-gray-700 hover:text-blue-600 p-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>        <!-- Mobile menu -->
        <div x-show="open" x-transition class="md:hidden bg-white/95 backdrop-blur-sm border-t border-gray-200">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="{{ route('home') }}" 
                   class="block px-3 py-2 rounded-md transition-all duration-200
                   {{ request()->routeIs('home') ? 'bg-blue-50 text-blue-600 border-l-4 border-blue-500' : 'text-gray-700 hover:text-blue-600 hover:bg-blue-50' }}">
                   Beranda
                </a>                <a href="{{ route('features') }}" 
                   class="block px-3 py-2 rounded-md transition-all duration-200
                   {{ request()->routeIs('features') ? 'bg-blue-50 text-blue-600 border-l-4 border-blue-500' : 'text-gray-700 hover:text-blue-600 hover:bg-blue-50' }}">
                   Fitur
                </a>
                <a href="{{ route('how-it-works') }}" 
                   class="block px-3 py-2 rounded-md transition-all duration-200
                   {{ request()->routeIs('how-it-works') ? 'bg-blue-50 text-blue-600 border-l-4 border-blue-500' : 'text-gray-700 hover:text-blue-600 hover:bg-blue-50' }}">
                   Cara Kerja
                </a>                <a href="{{ route('about') }}" 
                   class="block px-3 py-2 rounded-md transition-all duration-200
                   {{ request()->routeIs('about') ? 'bg-blue-50 text-blue-600 border-l-4 border-blue-500' : 'text-gray-700 hover:text-blue-600 hover:bg-blue-50' }}">
                   Tentang
                </a>                <a href="{{ route('contact') }}" 
                   class="block px-3 py-2 rounded-md transition-all duration-200
                   {{ request()->routeIs('contact') ? 'bg-blue-50 text-blue-600 border-l-4 border-blue-500' : 'text-gray-700 hover:text-blue-600 hover:bg-blue-50' }}">
                   Kontak
                </a>
                @auth
                    <a href="{{ route('dashboard') }}" class="block px-3 py-2 text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-md">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-3 py-2 text-red-600 hover:bg-red-50 rounded-md">Logout</button>
                    </form>
                @else
                    <button @click="$dispatch('open-login-modal')" class="w-full text-left bg-gradient-to-r from-blue-500 to-purple-600 text-white px-3 py-2 rounded-lg mt-2">
                        Login
                    </button>
                @endauth
            </div>
        </div>        <!-- Login Modal -->
    </nav>