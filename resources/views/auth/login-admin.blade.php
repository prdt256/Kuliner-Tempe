@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center py-24 px-4 bg-surface">
    <div class="bg-surface-container rounded-[2.5rem] p-8 sm:p-12 max-w-md w-full shadow-2xl border border-outline-variant/40">
        <div class="text-center mb-8">
            <span class="material-symbols-outlined text-6xl text-primary mb-3">admin_panel_settings</span>
            <h1 class="font-headline-md text-headline-md text-on-surface mb-1">Login Admin</h1>
            <p class="text-body-sm text-on-surface-variant">Akses rahasia pengelola sistem TEMPEKU</p>
        </div>

        @if ($errors->any())
            <div class="bg-error-container text-on-error-container p-4 rounded-xl mb-6 text-xs font-label-bold flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">error</span>
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('admin.login.post') }}" method="POST" class="flex flex-col gap-5">
            @csrf
            <div class="flex flex-col gap-1.5">
                <label for="username" class="font-label-bold text-on-surface text-xs">Username Admin</label>
                <input 
                    type="text" 
                    id="username" 
                    name="username" 
                    value="{{ old('username') }}" 
                    required 
                    placeholder="admin"
                    class="rounded-xl border border-outline-variant px-4 py-3 bg-surface text-sm focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all outline-none"
                >
            </div>

            <div class="flex flex-col gap-1.5">
                <label for="password" class="font-label-bold text-on-surface text-xs">Password Admin</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    required 
                    placeholder="••••••••"
                    class="rounded-xl border border-outline-variant px-4 py-3 bg-surface text-sm focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all outline-none"
                >
            </div>

            <button type="submit" class="mt-2 bg-primary text-on-primary py-3.5 rounded-xl font-label-bold hover:shadow-lg hover:bg-primary/90 transition-all active:scale-95 flex items-center justify-center gap-2 text-sm">
                <span class="material-symbols-outlined text-sm">lock_open</span>
                Masuk ke Panel Admin
            </button>
        </form>
        
        <div class="mt-8 text-center">
            <a href="{{ url('/') }}" wire:navigate class="text-xs text-primary hover:underline flex items-center justify-center gap-1">
                <span class="material-symbols-outlined text-[14px]">arrow_back</span>
                Kembali ke Beranda
            </a>
        </div>
    </div>
</div>
@endsection
