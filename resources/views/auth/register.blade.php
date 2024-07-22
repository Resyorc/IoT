@extends('layout.auth')

@section('title', 'Login')
@section('content')
<div class="min-h-screen bg-gray-100 text-gray-800 antialiased py-6 flex flex-col justify-center sm:py-12">
    <div class="relative py-3 w-72 md:w-96 mx-auto text-center">
        <span class="text-2xl font-dark">Register</span>
        <div class="mt-4 bg-white shadow-md rounded-lg text-left">
            <div class="h-2 bg-hover rounded-t-md"></div>
            <div class="px-8 py-6">
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="username" class="block font-semibold">Username</label>
                        <input type="text" name="username" id="username" class="border w-full h-5 px-3 py-5 mt-2 hover:outline-none focus:outline-none focus:ring-1 focus:ring-hover rounded-md" value="{{ old('username') }}">
                        @error('username')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block font-semibold">Email</label>
                        <input type="email" name="email" id="email" class="border w-full h-5 px-3 py-5 mt-2 hover:outline-none focus:outline-none focus:ring-1 focus:ring-hover rounded-md" value="{{ old('username') }}">
                        @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block mt-3 font-semibold">Password</label>
                        <input type="password" name="password" id="password" class="border w-full h-5 px-3 py-5 mt-2 hover:outline-none focus:outline-none focus:ring-1 focus:ring-hover rounded-md">
                        @error('password')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex justify-between items-baseline">
                        <button type="submit" class="mt-4 bg-hover text-white py-2 px-6 rounded-md">Register</button>
                        <a href="#" class="text-sm hover:underline">Forgot Password</a>
                    </div>
                </form>
                <p class="text-center mt-4">Sudah punya akun? <a href="{{ route('page.login') }}" class="text-indigo-500 hover:underline">Login</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
