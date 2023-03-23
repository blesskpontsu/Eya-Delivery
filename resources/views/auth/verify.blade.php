<x-guest-layout>
    {{-- <p class="text-red-500 text-lg">{{ session('error') }}</p> --}}
    <x-input-error :messages="session('error')" />
    Please enter the OTP sent to your number: {{session('phone')}}
    <form method="POST" action="{{ route('verify') }}">
        @csrf

        {{-- Phone --}}
        <div class="mt-4">
            <x-input-label for="phone" :value="__('OTP')" />
            <x-text-input type="hidden" name="phone" :value="session('phone')" />
            <x-text-input id="verification_code" class="block mt-1 w-full" type="tel" name="verification_code" :value="old('verification_code')" required />
            <x-input-error :messages="$errors->get('verification_code')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-md text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already verified?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Verify Phone Number') }}
            </x-primary-button>
        </div>
    </form>

    <form id="verify-resend" action="{{ route('verify.resend') }}" method="POST">
        @csrf
        <x-primary-button>
            {{ __('Resend Code') }}
        </x-primary-button>
    </form>
</x-guest-layout>
