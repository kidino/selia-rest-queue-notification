<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <x-primary-button form="send-verification" class="btn-sm btn-neutral">
                            {{ __('Click here to re-send the verification email.') }}
                        </x-primary-button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>


        <div>
            <x-input-label for="phone" :value="__('Phone')" />
            <div class="flex space-x-2">
                <!-- Country Code Dropdown -->
                <select id="country_code" name="country_code" class="select select-bordered">
                    @foreach ([
                        '+60' => 'Malaysia (+60)',
                        '+1' => 'US/Canada (+1)',
                        '+44' => 'UK (+44)',
                        '+91' => 'India (+91)',
                        '+61' => 'Australia (+61)'
                    ] as $code => $label)
                        <option value="{{ $code }}"
                            {{ old('country_code', substr($user->phone, 0, strpos($user->phone, substr($user->phone, 0, 1) === '+' ? ' ' : ''))) == $code ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>


                <!-- Phone Number Input -->
                <x-text-input
                    id="phone"
                    name="phone"
                    type="text"
                    class="mt-1 block w-3/4"
                    :value="old('phone', substr($user->phone, strpos($user->phone, ' ') + 1))"
                    autocomplete="tel"
                />
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>


        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
