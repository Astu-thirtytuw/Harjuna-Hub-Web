<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-harjuna-dark leading-tight">
            {{ __('Dashboard Ketua') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl p-6 border border-harjuna-wood/10">
                <h1 class="text-2xl font-bold text-harjuna-dark">Selamat datang, {{ auth()->user()->nama }}!</h1>
                <p class="mt-2 text-gray-600">Ini adalah halaman Dashboard Ketua Karang Taruna RW 06.</p>
            </div>
        </div>
    </div>
</x-app-layout>