<nav class="navbar navbar-expand-lg navbar-dark border-bottom" style="background-color: #1C1C1C;">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <x-application-logo class="d-inline-block align-top" />
        </a>

        <!-- Hamburger -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Links -->
        <div class="collapse navbar-collapse w-100 justify-content-between" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </li>
                <li class="nav-item">
                    <x-nav-link :href="route('post.create')" :active="request()->routeIs('post.create')">
                        {{ __('Dodaj Post') }}
                    </x-nav-link>
                </li>
                <li class="nav-item">
                    <x-nav-link :href="route('post.index')" :active="request()->routeIs('post.index')">
                        {{ __('Twoje Posty') }}
                    </x-nav-link>
                </li>
                <li class="nav-item">
                    <x-nav-link :href="route('blog.edit', \Illuminate\Support\Str::slug(\App\Models\Blog::where('user_id', Auth::id())->value('title')) )" :active="request()->routeIs('blog.edit', \Illuminate\Support\Str::slug(\App\Models\Blog::where('user_id', Auth::id())->value('title')) )">
                        {{ __('Ustawienia Bloga') }}
                    </x-nav-link>
                </li>
            </ul>



                    <!-- Settings Dropdown -->
        <div class="ml-auto">
            <div class="dropdown">
                <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if (Auth::check())
                        {{ Auth::user()->name }}
                    @else
                        <!-- Obsłuż przypadek, gdy użytkownik nie jest zalogowany -->
                    @endif
                </button>
                <div class="dropdown-menu dropdown-menu-end border" aria-labelledby="dropdownMenuButton">
                    <x-dropdown-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-dropdown-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </div>
            </div>
        </div>
        </div>


    </div>
</nav>

