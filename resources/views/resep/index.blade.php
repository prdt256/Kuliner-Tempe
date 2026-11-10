@extends('layouts.app')

@section('content')
<div class="pt-32 pb-24 px-margin-mobile md:px-margin-desktop bg-surface min-h-screen">
    <div class="max-w-max-width mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12 gap-6">
            <div>
                <h1 class="font-headline-xl text-headline-xl text-on-surface mb-2">Katalog Resep Tempe</h1>
                <p class="text-body-lg text-on-surface-variant">Kumpulan kreasi tempe lezat dan murah dari komunitas Sobat Kos.</p>
            </div>
            @auth
                <a href="{{ route('resep.create') }}" class="inline-flex items-center gap-2 bg-primary text-on-primary px-6 py-3 rounded-xl font-label-bold hover:shadow-lg hover:bg-primary/90 transition-all active:scale-95">
                    <span class="material-symbols-outlined">add</span> Bagi Resepmu
                </a>
            @else
                <div class="bg-primary-container/20 border border-primary/20 rounded-2xl p-4 max-w-sm flex flex-col items-start gap-2 shadow-sm">
                    <div class="flex items-center gap-2 text-primary">
                        <span class="material-symbols-outlined text-2xl">campaign</span>
                        <p class="text-sm font-label-bold">Mau ikut berbagi kreasi resep?</p>
                    </div>
                    <a href="{{ route('login') }}" class="text-xs bg-primary text-on-primary px-4 py-2 rounded-lg font-label-bold hover:bg-primary/90 transition-colors w-full text-center">Masuk Dulu Yuk!</a>
                </div>
            @endauth
        </div>

        <livewire:recipe-list />
    </div>
</div>
@endsection
