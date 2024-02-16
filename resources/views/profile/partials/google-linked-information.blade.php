<section>
    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 flex items-center">
        <img class="h-5 mr-2" src="{{ URL::to('images/icons/google.png') }}" alt="Google Icon">
        {{ __('Google authentication enabled') }}
    </h2>

    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Your account credentials are managed through your Google Account.') }}
    </p>

    <form method="POST" action="{{ route('password.restore') }}" class="mt-4">
        @csrf
        <x-text-input id="email" type="hidden" name="email" :value="$user->email" required />
        <x-primary-button>{{ __('Disable Google authentication') }}</x-primary-button>
        <x-input-error class="mt-4" :messages="$errors->get('email')" />

        @if (session('status') === 'restore-password')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 6000)"
                class="text-sm text-gray-600 dark:text-gray-400 mt-4"
            >
                {{ __('You will receive an email to reset your password.') }}
            </p>
        @endif
    </form>
</section>
