<div x-data="{ open: false }" class="min-h-screen flex ">

    <!-- Mobile sidebar backdrop -->
    <div x-show="open"
         x-transition.opacity
         class="fixed inset-0 bg-black bg-opacity-50 z-40 sm:hidden"
         @click="open = false"></div>

    <!-- Sidebar -->
    <aside :class="{ 'translate-x-0': open, '-translate-x-full': !open }"
           class="fixed sm:static inset-y-0 left-0 z-50 w-64 bg-white border-r shadow-md transform transition-transform duration-300 sm:translate-x-0 sm:flex flex-col justify-between">

        <!-- Top: Logo + Dropdown + Navigation -->
        <div class="flex-grow">
            <!-- Logo -->
            <div class="px-6 py-4 border-b">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                    <span class="font-semibold text-lg text-gray-800">Resto Wafa 99</span>
                </a>
            </div>

            <!-- User Dropdown: moved up below logo -->
            <div class="px-6 py-4 border-b">
                <x-dropdown align="left" width="48">
                    <x-slot name="trigger">
                        <button
                            class="w-full flex justify-between items-center px-3 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-600 bg-white hover:text-gray-800 transition">
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

     
            <nav class="mt-4 space-y-1 px-6 flex flex-col">
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-nav-link>
                <x-nav-link :href="route('menu.index')" :active="request()->routeIs('menu.index')">
                    {{ __('Menu Makanan') }}
                </x-nav-link>
                <x-nav-link :href="route('kategori.index')" :active="request()->routeIs('kategori.index')">
                    {{ __('List Kategori') }}
                </x-nav-link>
                <x-nav-link :href="route('orders.index')" :active="request()->routeIs('orders.index')">
                    {{ __('List Pesanan') }}
                </x-nav-link>
               
            </nav>
        </div>
    </aside>


    <div class="flex-1 flex flex-col">

       
        <div class="sm:hidden bg-white p-4 shadow flex justify-between items-center">
            <button @click="open = !open"
                    class="text-gray-600 hover:text-gray-800 focus:outline-none">
           
                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path x-show="!open" d="M4 6h16M4 12h16M4 18h16" />
                    <path x-show="open" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <span class="text-lg font-semibold text-gray-800">Wafa 99</span>
        </div>

      
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>
</div>
