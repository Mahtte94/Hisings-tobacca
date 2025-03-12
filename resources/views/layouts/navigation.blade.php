<nav x-data="{ open: false, categoryOpen: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">


                <!-- Navigation Links -->
                <div class="hidden space-x-8  sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link class="hover:bg-gray-700" :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <!-- Categories Dropdown -->
                    <div class="relative inline-flex center hover:bg-gray-700">
                        <button @click="categoryOpen = !categoryOpen" 
                                class="inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 dark:border-indigo-600 text-lg font-medium leading-5 text-gray-900 dark:text-gray-100 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out">
                            <span>Categories</span>
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    
                        <!-- Dropdown Content -->
                        <div x-show="categoryOpen" @click.away="categoryOpen = false" 
                                class="absolute left-0 top-full mt-1 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg z-50">
                            <a href="{{ route('category.show', 'white') }}" class="block px-4 py-2 text-white 
                            hover:bg-gray-700 rounded-md hover:text-gray-300 transition duration-150 ease-in-out">White</a>
                            <a href="{{ route('category.show', 'black') }}" class="block px-4 py-2 text-white
                             hover:bg-gray-700 rounded-md hover:text-gray-300 transition duration-150 ease-in-out">Black</a>
                            <a href="{{ route('category.show', 'powder') }}" class="block px-4 py-2 text-white
                             hover:bg-gray-700 rounded-md hover:text-gray-300 transition duration-150 ease-in-out">Powder</a>
                            <a href="{{ route('category.show', 'pouches') }}" class="block px-4 py-2 text-white
                             hover:bg-gray-700 rounded-md hover:text-gray-300 transition duration-150 ease-in-out">Pouches</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>
