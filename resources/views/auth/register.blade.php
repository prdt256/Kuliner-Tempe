@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center py-24 px-4 bg-surface">
    <div class="bg-surface-container-lowest rounded-[2.5rem] p-8 sm:p-12 max-w-md w-full shadow-xl border border-outline-variant/30">
        <div class="text-center mb-8">
            <span class="material-symbols-outlined text-5xl text-primary mb-3">person_add</span>
            <h1 class="font-headline-md text-headline-md text-on-surface mb-1">Daftar Akun TEMPEKU</h1>
            <p class="text-body-sm text-on-surface-variant">Bergabung bersama komunitas Sobat Kos pecinta tempe.</p>
        </div>

        @if ($errors->any())
            <div class="bg-error-container text-on-error-container p-4 rounded-xl mb-6 text-xs font-label-bold flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">error</span>
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST" class="flex flex-col gap-5">
            @csrf
            <div class="flex flex-col gap-1.5">
                <label for="name" class="font-label-bold text-on-surface text-xs">Nama Lengkap</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    value="{{ old('name') }}" 
                    required 
                    placeholder="Contoh: Budi Santoso"
                    class="rounded-xl border border-outline-variant px-4 py-3 bg-surface text-sm focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all outline-none"
                >
            </div>

            <div class="flex flex-col gap-1.5">
                <label for="username" class="font-label-bold text-on-surface text-xs">Username</label>
                <input 
                    type="text" 
                    id="username" 
                    name="username" 
                    value="{{ old('username') }}" 
                    required 
                    placeholder="Contoh: budi123"
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
                    placeholder="Minimal 4 karakter"
                    class="rounded-xl border border-outline-variant px-4 py-3 bg-surface text-sm focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all outline-none"
                >
            </div>

            <button type="submit" class="mt-2 bg-primary text-on-primary py-3.5 rounded-xl font-label-bold hover:shadow-lg hover:bg-primary/90 transition-all active:scale-95 flex items-center justify-center gap-2 text-sm">
                <span class="material-symbols-outlined text-sm">how_to_reg</span>
                Buat Akun Sekarang
            </button>
        </form>
        
        <div class="mt-8 pt-6 border-t border-outline-variant/30 text-center text-xs">
            <p class="text-on-surface-variant">
                Sudah punya akun? 
                <a href="{{ route('login') }}" class="text-primary font-label-bold hover:underline">Masuk di sini</a>
            </p>
        </div>
    </div>
</div>
@endsection
