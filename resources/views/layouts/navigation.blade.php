<nav class="navbar navbar-expand-md border-bottom absolute-top py-3">
      <div class="container">

        <button class="navbar-toggler order-2 order-md-1" type="button" data-bs-toggle="collapse" data-bs-target=".navbar-collapse" aria-controls="navbar-left navbar-right" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3 order-md-2" id="navbar-left">
          <ul class="navbar-nav me-auto">
            @if(Auth::check())
            <li>
              <a class="nav-link" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
              <i class="fas fa-bars" style="color: #104fbc;"></i>
              </a>         
            </li>
            @endif
            <li class="nav-item">
              <a class="nav-link" href="/">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('about-us') }}">About us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('contact') }}">Contact</a>
            </li>

            @auth
              <li class="nav-item">
                <a class="nav-link fw-bold" href="{{ route('blog.show', str_replace(' ', '-', Auth::user()->blog()->value('title'))) }}">Blog</a>
              </li>
            @endauth

            
          </ul>
        </div>

        <a class="navbar-brand mx-auto order-1 order-md-3" href="/">Bloglø</a>

        <div class="collapse navbar-collapse order-4 order-md-4" id="navbar-right">
          <ul class="navbar-nav ms-auto">
            @if (Route::has('login'))
                
              @auth
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if (Auth::check())
                      {{ Auth::user()->name }}
                      <img src="{{ asset('avatars/'.Auth::user()->avatar) }}" class="card-img rounded-circle" style="width: 45px; height: 45px;" alt="obrazek">
                    @else
                       <!-- Obsłuż przypadek, gdy użytkownik nie jest zalogowany -->
                    @endif
                  </a>
                  <div class="dropdown-menu" aria-labelledby="dropdown04">
                    <x-dropdown-link :href="url('/dashboard')">
                        {{ __('Dashboard') }}
                    </x-dropdown-link>
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
                </li>
              @else
                <li class="nav-item">
                    <a href="{{ route('login') }}" class="nav-link">Log in</a>
                </li>
                @if (Route::has('register'))
                  <li class="nav-item">
                    <a href="{{ route('register') }}" class="nav-link">Register</a>
                  </li>
                 @endif
              @endauth
            @endif
          </ul>
        </div>
      </div>
    </nav>

