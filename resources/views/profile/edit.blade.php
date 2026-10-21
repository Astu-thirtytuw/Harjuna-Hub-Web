<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-harjuna-dark leading-tight">
            {{ __('Pengaturan Profil') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Form Update Info -->
            <div class="p-6 bg-white shadow-sm sm:rounded-2xl border border-harjuna-wood/10">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Form Update Password -->
            <div class="p-6 bg-white shadow-sm sm:rounded-2xl border border-harjuna-wood/10">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Form Hapus Akun -->
            <div class="p-6 bg-white shadow-sm sm:rounded-2xl border border-harjuna-wood/10">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>