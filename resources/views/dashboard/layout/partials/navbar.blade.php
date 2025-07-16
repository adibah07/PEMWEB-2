<nav class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 shadow-xl border-b border-white/10 backdrop-blur-lg sticky top-0 z-1">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Left Section: Logo & Mobile Menu -->
            <div class="flex items-center space-x-4">                {{-- Mobile Menu Button --}}
                <button id="openSidebar" 
                        class="lg:hidden p-2 text-white/90 hover:text-white hover:bg-white/20 rounded-lg transition-all duration-200 hover:scale-105 active:scale-95 focus:outline-none focus:ring-2 focus:ring-white/30"
                        aria-label="Open navigation menu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                  {{-- Logo & Brand --}}
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white/15 backdrop-blur-sm rounded-xl flex items-center justify-center border border-white/30 shadow-lg hover:scale-105 transition-transform duration-200">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                    </div>
                    <div class="hidden sm:block">
                        <h1 class="text-xl font-bold text-white tracking-tight">AbsenSmart</h1>
                        <p class="text-xs text-white/90 font-medium">QR Attendance System</p>
                    </div>
                    <div class="sm:hidden">
                        <h1 class="text-lg font-bold text-white">AbsenSmart</h1>
                    </div>
                </div>
            </div>            <!-- Right Section: Time & Quick Actions -->
            <div class="flex items-center space-x-3">
                <!-- Current Time Display -->
                <div class="hidden sm:flex items-center space-x-2 bg-white/10 backdrop-blur-sm rounded-lg px-3 py-2 border border-white/20">
                    <svg class="w-4 h-4 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div class="text-white text-sm">
                        <span id="current-time" class="font-medium">{{ now()->format('H:i') }}</span>
                        <span class="text-white/70 ml-1">{{ now()->format('d/m') }}</span>
                    </div>
                </div>

                @guest
                    <!-- Login Button for Guests -->
                    <a href="{{ route('login-user') }}" 
                       class="group relative inline-flex items-center px-4 py-2 bg-white/15 hover:bg-white/25 border border-white/30 rounded-lg text-white font-medium text-sm transition-all duration-200 backdrop-blur-sm shadow-md hover:shadow-lg hover:scale-105 active:scale-95">
                        <svg class="w-4 h-4 mr-2 transition-transform duration-200 group-hover:-rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                        Login
                    </a>
                @endguest
            </div>
        </div>    </div>
</nav>

<script>
// Update time every minute
function updateTime() {
    const now = new Date();
    const timeElement = document.getElementById('current-time');
    if (timeElement) {
        timeElement.textContent = now.toLocaleTimeString('en-US', {
            hour: '2-digit',
            minute: '2-digit',
            hour12: false
        });
    }
}

// Update time immediately and then every minute
updateTime();
setInterval(updateTime, 60000);
</script>
