<nav class="fixed h-screen left-0 w-1/6 whitespace-normal px-5 break-words bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <div class="flex items-center">
        {{-- <x-application-logo class="w-10 mt-3 mr-2" /> --}}
        <a href="{{ route('dashboard') }}" class="text-2xl mt-8 font-mono text-blue-800">Eya Express</a>
    </div>

    <hr class="my-8 w-auto border-t-2">

    <div class="nav-links text-lg text-gray-400">
        <div class="mt-5 hover:text-purple-600 active:text-purple-700">
            <i class="w-5 fa-solid fa-gauge"></i>
            <a href="{{ route('dashboard') }}">Dashboard</a>
        </div>
        <div class="mt-5 hover:text-purple-600 active:text-purple-700">
            <i class="w-5 fa-solid fa-building"></i>
            <a href="#">Browse Shops</a>
        </div>
        <div class="mt-5 hover:text-purple-600 active:text-purple-700">
            <i class="w-5 fas fa-history"></i>
            <a href="#">History</a>
        </div>
        <div class="mt-5 hover:text-purple-600 active:text-purple-700">
            <i class="w-5 fa-solid fa-file-invoice"></i>
            <a href="#">Invoice</a>
        </div>

        <hr class="my-20 w-auto border-t-2">

        <div x-data="{ open: false }" class="relative">
            <a href="#" @click="open = !open" class="text-gray-400 text-xl inline-flex items-center hover:text-purple-600">
                <i class="fas fa-user-cog mr-1"></i>
                {{ Auth::user()->firstname }}
                <svg class="fill-current h-4 w-4 inline" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M6 9l4 4 4-4"></path></svg>
            </a>

            <div x-show="open" @click.away="open = false" class="w-full mt-2 bg-white">
                <x-dropdown-link class="text-gray-400" :href="route('profile.edit')">
                    <i class="fas fa-user"></i>
                    {{ __('Profile') }}
                </x-dropdown-link>
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                        <i class="fa-solid fa-power-off"></i>
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </div>
        </div>
    </div>
</nav>