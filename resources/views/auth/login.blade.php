@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center py-24 px-4 bg-surface">
    <div class="bg-surface-container-lowest rounded-[2.5rem] p-8 sm:p-12 max-w-md w-full shadow-xl border border-outline-variant/30">
        <div class="text-center mb-8">
            <span class="material-symbols-outlined text-5xl text-primary mb-3">account_circle</span>
            <h1 class="font-headline-md text-headline-md text-on-surface mb-1">Masuk ke TEMPEKU</h1>
            <p class="text-body-sm text-on-surface-variant">Bagikan kreasi dan temukan inspirasi olahan tempe.</p>
        </div>

        @if ($errors->any())
            <div class="bg-error-container text-on-error-container p-4 rounded-xl mb-6 text-xs font-label-bold flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">error</span>
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="flex flex-col gap-5">
            @csrf
            <div class="flex flex-col gap-1.5">
                <label for="username" class="font-label-bold text-on-surface text-xs">Username</label>
                <input 
                    type="text" 
                    id="username" 
                    name="username" 
                    value="{{ old('username') }}" 
                    required 
                    placeholder="Masukkan username Anda"
                    class="rounded-xl border border-outline-variant px-4 py-3 bg-surface text-sm focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all outline-none"
                >
            </div>

            <div class="flex flex-col gap-1.5">
                <label for="password" class="font-label-bold text-on-surface text-xs">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    required 
                    placeholder="••••••••"
                    class="rounded-xl border border-outline-variant px-4 py-3 bg-surface text-sm focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all outline-none"
                >
            </div>

            <div class="flex items-center justify-between text-xs">
                <label class="flex items-center gap-2 cursor-pointer text-on-surface-variant">
                    <input type="checkbox" name="remember" class="rounded border-outline-variant text-primary focus:ring-primary" />
                    <span>Ingat Saya</span>
                </label>
            </div>

            <button type="submit" class="mt-2 bg-primary text-on-primary py-3.5 rounded-xl font-label-bold hover:shadow-lg hover:bg-primary/90 transition-all active:scale-95 flex items-center justify-center gap-2 text-sm">
                <span class="material-symbols-outlined text-sm">login</span>
                Masuk
            </button>
        </form>
        
        <div class="mt-8 pt-6 border-t border-outline-variant/30 text-center flex flex-col gap-3 text-xs">
            <p class="text-on-surface-variant">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="text-primary font-label-bold hover:underline">Daftar sekarang</a>
            </p>
            <a href="{{ route('admin.login') }}" class="text-on-surface-variant/60 hover:text-primary transition-colors flex items-center justify-center gap-1">
                <span class="material-symbols-outlined text-xs">shield</span> Login Pengelola Admin
            </a>
        </div>
    </div>
</div>
@endsection
