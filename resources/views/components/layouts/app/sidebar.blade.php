<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
    @fluxAppearance
</head>
<body class="min-h-screen bg-white dark:bg-zinc-800">
    <flux:sidebar sticky stashable class="bg-zinc-50 dark:bg-zinc-900 border-r rtl:border-r-0 rtl:border-l border-zinc-200 dark:border-zinc-700">
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

    
        <flux:brand href="#" name="Dyanne">
    <x-slot name="logo" class="size-8 rounded-full bg-zinc-800 text-white text-xs font-bold">
        <flux:icon name="slack" class="w-5 h-5"/>
    </x-slot>
</flux:brand>

        <flux:input as="button" variant="filled" placeholder="Search..." icon="magnifying-glass" />

        <flux:navlist variant="outline">
            <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>{{ __('Dashboard') }}</flux:navlist.item>
            <flux:navlist.item icon="library-big" :href="route('dashboard.categories.index')" :current="request()->routeIs('dashboard.categories.index')" wire:navigate>{{ __('Categories') }}</flux:navlist.item>
            <flux:navlist.item icon="package-plus" :href="route('dashboard.products.index')" :current="request()->routeIs('dashboard.products.index')" wire:navigate>{{ __('Product') }}</flux:navlist.item>
            <flux:navlist.item icon="smile-plus" :href="route('dashboard.customer.index')" :current="request()->routeIs('dashboard.customer.index')" wire:navigate>{{ __('Customer') }}</flux:navlist.item>

            <flux:navlist.group expandable heading="Favorites" class="hidden lg:grid">
                <flux:navlist.item href="#">Marketing site</flux:navlist.item>
                <flux:navlist.item href="#">Android app</flux:navlist.item>
                <flux:navlist.item href="#">Brand guidelines</flux:navlist.item>
            </flux:navlist.group>
        </flux:navlist>

        <flux:spacer />

        <flux:navlist variant="outline">
            <flux:navlist.item icon="cog-6-tooth" href="route('settings.profile')">Settings</flux:navlist.item>
            <flux:navlist.item icon="information-circle" href="https://laravel.com/docs/starter-kits">Help</flux:navlist.item>
        </flux:navlist>

        {{-- Desktop User Menu --}}
        <flux:dropdown position="bottom" align="start" class="max-lg:hidden">
            <flux:profile
                :name="auth()->user()->name"
                :initials="auth()->user()->initials()"
                icon-trailing="chevrons-up-down"
            />
            <flux:menu class="w-[220px]">
                <flux:menu.radio.group>
                    <div class="flex items-center gap-2 px-1 py-1.5 text-sm">
                        <span class="relative flex h-8 w-8 overflow-hidden rounded-lg bg-neutral-200 dark:bg-neutral-700 text-black dark:text-white items-center justify-center">
                            {{ auth()->user()->initials() }}
                        </span>
                        <div class="grid text-left">
                            <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                            <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                        </div>
                    </div>
                </flux:menu.radio.group>
                <flux:menu.separator />
                <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                <flux:menu.separator />
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:sidebar>

    <flux:header class="block! bg-white lg:bg-zinc-50 dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700">
        <flux:navbar class="lg:hidden w-full">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="start">
                <flux:profile avatar="" />
                <flux:menu>
                    

                    <flux:menu.separator />

                    <flux:menu.item icon="arrow-right-start-on-rectangle">Logout</flux:menu.item>
                </flux:menu>
            </flux:dropdown>
        </flux:navbar>

        <flux:navbar scrollable>
            <flux:navbar.item href="/" current>Dashboard</flux:navbar.item>
            <flux:navbar.item badge="32" href="#">Orders</flux:navbar.item>
            <flux:navbar.item href="#">Catalog</flux:navbar.item>
            <flux:navbar.item href="#">Configuration</flux:navbar.item>
        </flux:navbar>
    </flux:header>

    <flux:main>
    <div class="p-6 max-w-7xl mx-auto">
        {{ $slot }}
    </div>
    </flux:main>

    @fluxScripts
</body>
</html>
