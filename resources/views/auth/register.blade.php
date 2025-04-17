<x-guest-layout>
    <div class="w-full max-w-md p-6 space-y-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <div class="text-center">
            <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white">
                Créez votre compte
            </h2>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                Rejoignez notre communauté de vente d'articles d'occasion
            </p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="mt-8 space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 gap-6">
                <!-- Nom -->
                <div>
                    <x-input-label for="name" :value="__('Nom complet')" />
                    <x-text-input id="name" class="block w-full mt-1" type="text" name="name" :value="old('name')" required autofocus />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Téléphone -->
                <div>
                    <x-input-label for="phone" :value="__('Téléphone (optionnel)')" />
                    <x-text-input id="phone" class="block w-full mt-1" type="tel" name="phone" :value="old('phone')" />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>

                <!-- Mot de passe -->
                <div>
                    <x-input-label for="password" :value="__('Mot de passe')" />
                    <x-text-input id="password" class="block w-full mt-1" type="password" name="password" required />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirmation mot de passe -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirmez le mot de passe')" />
                    <x-text-input id="password_confirmation" class="block w-full mt-1" type="password" name="password_confirmation" required />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
            </div>

            <div class="flex items-center justify-between">
                <a href="{{ route('login') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300">
                    Déjà inscrit ?
                </a>

                <x-primary-button class="ml-4">
                    {{ __('S\'inscrire') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>