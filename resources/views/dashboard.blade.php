<x-app-layout>
    <x-slot name="header">
        <h2 class="display-4">
            {{ __('Dashboard') }}
        </h2>
        <p class="text-secondary">Twoje centrum dowodzenia</p>
    

    <div class="py-12">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="border p-4">
                        <p class="text-secondary">{{ __("You're logged in!") }}</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="border p-4">
                        <ul>
                            <li class="d-flex"> <i class="fas fa-check p-1" style="color: #3ddb5d;"></i> <a href="{{ route('files.index') }}" class="nav-link">pliki</a></li>
                            <li class="d-flex"> <i class="fas fa-check p-1" style="color: #3ddb5d;"></i> <a href="{{ route('messages') }}" class="nav-link">Wiadomości</a> </li>
                            <li class="d-flex"> <i class="fas fa-check p-1" style="color: #3ddb5d;"></i> <a href="{{ route('admin.user.index') }}" class="nav-link">Uzytklownicy</a></li>
                            <li class="d-flex"> <i class="fas fa-check p-1" style="color: #3ddb5d;"></i> <a href="{{ route('admin.blogs') }}" class="nav-link">Zazadzanie blogami</a></li>
                            <li class="d-flex"> <a href="" class="nav-link">zazadzanie komantarzami (do zrobienia)</a></li>
                            <li class="d-flex"> <i class="fas fa-check p-1" style="color: #3ddb5d;"></i> <a href="{{ route('about-us.edit') }}" class="nav-link">Edit about us</a></li>
                            <li class="d-flex"> <a href="" class="nav-link">Obsluga tagow (wyswiatlanie postów po tagach: do zrobienia)</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="text-primary" >This text will have a custom color.</div>


</x-app-layout>
