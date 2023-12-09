<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


        <!-- <link href="https://milo.bootlab.io/css/app.css" rel="stylesheet"> -->
                <!-- Scripts -->

                @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Scripts -->
        
    </head>
    <body class="">

            @include('layouts.navigation')
<style>
  .hover-offcanvas{
    border-radius: 10px;
    transition: transform 0.3s ease, box-shadow 0.3s ease; /* Dodaje animację dla płynnego powiększania i dodawania cienia */
}

  .hover-offcanvas:hover{
    transform: scale(1.1); /* Powiększa element o 10% */
    box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.3); /* Dodaje cień o przesunięciu 5px w prawo i 5px w dół oraz rozmycie 15px */
}

</style>

<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title display-5 lead" id="offcanvasExampleLabel">Dashboard</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <hr>
  <div class="offcanvas-body">
    <div class="row">
      <div class="col-6"><a href="{{ route('post.index') }}" class="hover-offcanvas d-flex flex-column align-items-center p-3 text-primary fw-medium nav-link"><i class="fas fa-5x fa-file " style="color: #2766d3;"></i>  Posts </a></div>
      <div class="col-6"><a href="" class="hover-offcanvas d-flex flex-column align-items-center p-3 text-primary fw-medium nav-link"><i class="fas fa-5x fa-comments" style="color: #33e668;"></i>  Comments </a></div>
      <div class="col-6"><a href="" class="hover-offcanvas d-flex flex-column align-items-center p-3 text-primary fw-medium nav-link"><i class="fas fa-5x fa-chart-area" style="color: #e63333;"></i>  Stats </a></div>
      <div class="col-6"><a href="" class="hover-offcanvas d-flex flex-column align-items-center p-3 text-primary fw-medium nav-link"><i class="fas fa-5x fa-palette" style="color: #e3e633;"></i>  Layout </a></div>
      <div class="col-6"><a href="{{ route('profile.edit') }}" class="hover-offcanvas d-flex flex-column align-items-center p-3 text-primary fw-medium nav-link"><i class="fas fa-5x fa-cogs" style="color: #2e96e5;"></i>  Settings </a></div>
      @if (Auth::check())
        <div class="col-6"><a href="{{ route('blog.show', str_replace(' ', '-', Auth::user()->blog()->value('title'))) }}" class="hover-offcanvas d-flex flex-column align-items-center p-3 text-primary fw-medium nav-link"><i class="fas fa-5x fa-eye" style="color: #2dd29b;"></i>  See yor blog </a></div>
      @endif
      <div class="col-6"><a href="" class="hover-offcanvas d-flex flex-column align-items-center p-3 text-primary fw-medium nav-link"><i class="fas fa-5x fa-question-circle" style="color: #3dd129;"></i>  F.A.Q </a></div>
      <div class="col-6">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-dropdown-link class="hover-offcanvas d-flex flex-column align-items-center p-3 text-primary fw-medium nav-link" :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
              <i class="fas fa-5x fa-door-open" style="color: #d26f2d;"></i>  Logout 
            </x-dropdown-link>
        </form> 
      </div>
    </div>
  </div>
</div>
            <!-- Page Content -->
            <main class="pt-4" style="min-height: 78vh;">
                {{ $slot }}
            </main>


            <footer class="footer bg-dark py-4 mt-auto">
    <div class="container d-flex flex-column">

      <ul class="nav justify-content-center">
        <li class="nav-item">
          <a class="nav-link" href="#">Privacy policy</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Terms</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Feedback</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Advertise</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('contact') }}">Contact</a>
        </li>
      </ul>
      <div class="text-center text-light p-2">
        &copy; Korey 2023. All rights reserved
      </div>
    </div>
  </footer>

    </body>

</html>
