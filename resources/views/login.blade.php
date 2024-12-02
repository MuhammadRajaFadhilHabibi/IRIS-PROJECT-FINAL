@extends('header')

@section('title','Login IRIS')

@section('page')
<body class="min-h-screen w-full bg-white flex">
    <!-- Bagian kiri dengan gambar dan teks -->
    <div class="w-1/2 bg-gradient-to-r from-blue-500 to-blue-300 flex items-center justify-center relative">
        <!-- Teks di atas gambar -->
        <div class="absolute top-32 left-1/2 transform -translate-x-1/2 text-center w-full">
            <h1 class="text-5xl font-bold text-black">Welcome Back!</h1>
            <p class="text-black text-lg mt-2">To organize your semester, log in with <strong>IRIS</strong></p>
        </div>
        <!-- Gambar -->
        <div class="absolute bottom-0 right-[-100px] mb-12">
            <img src="elemeniris.png" alt="Element Image" class="w-[700px]"> <!-- Gambar diperbesar dan digeser ke kanan -->
        </div>
    </div>

    <!-- Bagian kanan untuk form login -->
    <div class="w-1/2 flex items-center justify-center">
        <div class="bg-gradient-to-br from-gray-100 via-gray-200 to-gray-500 shadow-lg rounded-2xl p-10 w-3/4">
            <div class="flex flex-col items-center">
                <!-- Logo -->
                <img src="iris.png" alt="IRIS Logo" class="w-24 mb-4">
            </div>
            
            <form action="{{ route('login') }}" method="POST" class="mt-8">
                @csrf
                <!-- Email field -->
                <div class="flex items-center border rounded-lg mb-4 bg-gray-100">
                    <span class="px-3 text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M2.94 2.94a1.5 1.5 0 012.12 0L10 7.879l4.94-4.939a1.5 1.5 0 112.12 2.122L12.121 10l4.939 4.939a1.5 1.5 0 01-2.122 2.12L10 12.121l-4.94 4.939a1.5 1.5 0 01-2.12-2.122L7.879 10 2.94 5.061a1.5 1.5 0 010-2.122z"/>
                        </svg>
                    </span>
                    <input type="text" name="email" placeholder="E-mail/Username" class="w-full py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-400 rounded-r-lg" required>
                </div>

                <!-- Password field -->
                <div class="flex items-center border rounded-lg mb-4 bg-gray-100">
                    <span class="px-3 text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 4a4 4 0 00-4 4v1H5a3 3 0 00-3 3v3a3 3 0 003 3h10a3 3 0 003-3v-3a3 3 0 00-3-3h-1V8a4 4 0 00-4-4zM8 8a2 2 0 114 0v1H8V8zm5 3H7v4h6v-4z" clip-rule="evenodd"/>
                        </svg>
                    </span>
                    <input type="password" name="password" placeholder="Password" class="w-full py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-400 rounded-r-lg" required>
                </div>


                <!-- Login button -->
                <button type="submit" class="w-full py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300">Login</button>
            </form>

        </div>
    </div>
</body>
</html>
