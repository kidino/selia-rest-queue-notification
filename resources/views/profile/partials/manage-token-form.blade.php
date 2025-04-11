<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('API Token Management') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            {{ __('Generate and manage your API token for external access.') }}
        </p>
    </header>
    <div class="mt-4">
        <div class="flex items-center gap-4">
            <x-input-label for="api-token" :value="__('Current Token')" />
            <div x-data="{ show: false }" class="relative w-full">
                <input 
                    id="api-token" 
                    :type="show ? 'text' : 'password'" 
                    class="input input-bordered w-full" 
                    :value="'{{$token['token'] ?? __('No token generated yet.') }}'" 
                    readonly 
                />
                    <button 
                        type="button" 
                        class="absolute right-12 btn btn-sm btn-neutral" 
                        @click="show = !show"
                    >
                        <span x-show="!show">{{ __('Show') }}</span>
                        <span x-show="show">{{ __('Hide') }}</span>
                    </button>
                    <button 
                        type="button" 
                        class="absolute right-0 btn btn-sm btn-neutral" 
                        @click="navigator.clipboard.writeText(document.getElementById('api-token').value)"
                    >
                        {{ __('Copy') }}
                    </button>
            </div>
        </div>
        <p class="text-sm text-gray-600 mt-2">
            <strong>{{ __('Expires at:') }}</strong>
            <span>{{ $user->tokens()->where('name','profile-token')->first()['expires_at'] ?? 'No token generated yet.' }}</span>
        </p>
    </div>

    <div class="mt-4 flex space-x-4">
        <form method="POST" action="{{ route('profile.token.generate') }}">
            @csrf
            <x-primary-button>
                {{ __('Generate New Token') }}
            </x-primary-button>
        </form>

        <form method="POST" action="{{ route('profile.token.delete') }}">
            @csrf
            @method('DELETE')
            <x-danger-button class="ms-1">
                {{ __('Delete Token') }}
            </x-danger-button>
        </form>
    </div>
</section>
