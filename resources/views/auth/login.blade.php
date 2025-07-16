<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Absensi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .glass {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
    </style>
</head>
<body class="gradient-bg min-h-screen flex items-center justify-center relative overflow-hidden">
    <!-- Background decorative elements -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-10 -left-10 w-72 h-72 bg-white opacity-10 rounded-full floating"></div>
        <div class="absolute top-20 right-10 w-32 h-32 bg-white opacity-5 rounded-full floating" style="animation-delay: -1s;"></div>
        <div class="absolute bottom-10 left-20 w-48 h-48 bg-white opacity-5 rounded-full floating" style="animation-delay: -2s;"></div>
    </div>

    <div class="glass rounded-2xl shadow-2xl w-full max-w-md mx-4 relative z-10">
        <div class="p-8">
            <!-- Header Section -->
            <div class="text-center mb-8">
                <div class="mx-auto w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-user-clock text-2xl text-white"></i>
                </div>
                <h1 class="text-3xl font-bold text-white mb-2">Sistem Absensi</h1>
                <p class="text-white text-opacity-80">Silakan login untuk melanjutkan</p>
            </div>

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="bg-red-500 bg-opacity-20 border border-red-300 text-white px-4 py-3 rounded-lg mb-4 backdrop-blur-sm">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Success Messages -->
            @if (session('success'))
                <div class="bg-green-500 bg-opacity-20 border border-green-300 text-white px-4 py-3 rounded-lg mb-4 backdrop-blur-sm">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Login Form -->
            <form method="POST" action="{{ route('login-user-prosess') }}" class="space-y-6">
                @csrf
                
                <!-- Email Field -->
                <div class="relative">
                    <label for="email" class="block text-white text-sm font-medium mb-2">
                        <i class="fas fa-envelope mr-2"></i>Email
                    </label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="{{ old('email') }}"
                        class="w-full px-4 py-3 bg-white bg-opacity-20 border border-white border-opacity-30 rounded-lg focus:outline-none focus:ring-2 focus:ring-white focus:ring-opacity-50 text-white placeholder-white placeholder-opacity-70 @error('email') border-red-300 @enderror"
                        placeholder="Masukkan email Anda"
                        required
                    >
                    @error('email')
                        <p class="text-red-200 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="relative">
                    <label for="password" class="block text-white text-sm font-medium mb-2">
                        <i class="fas fa-lock mr-2"></i>Password
                    </label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="w-full px-4 py-3 bg-white bg-opacity-20 border border-white border-opacity-30 rounded-lg focus:outline-none focus:ring-2 focus:ring-white focus:ring-opacity-50 text-white placeholder-white placeholder-opacity-70 @error('password') border-red-300 @enderror"
                        placeholder="Masukkan password Anda"
                        required
                    >
                    @error('password')
                        <p class="text-red-200 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember" class="mr-3 rounded border-white border-opacity-30 bg-white bg-opacity-20 text-white focus:ring-white focus:ring-opacity-50">
                    <label for="remember" class="text-white text-sm">Ingat saya</label>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit"
                    class="w-full bg-white bg-opacity-20 hover:bg-opacity-30 text-white font-semibold py-3 px-4 rounded-lg transition duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-white focus:ring-opacity-50"
                >
                    <i class="fas fa-sign-in-alt mr-2"></i>Login
                </button>

                <!-- Back to Landing Page Button -->
                <a 
                    href="/"
                    class="w-full bg-gray-600 bg-opacity-30 hover:bg-opacity-40 text-white font-semibold py-3 px-4 rounded-lg transition duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-white focus:ring-opacity-50 text-center block"
                >
                    <i class="fas fa-arrow-left mr-2"></i>Kembali ke Beranda
                </a>
            </form>

            <!-- Footer -->
            <div class="text-center mt-6">
                <p class="text-white text-opacity-60 text-sm">
                    © 2024 Sistem Absensi. All rights reserved.
                </p>
            </div>
        </div>
    </div>
</body>
</html>
