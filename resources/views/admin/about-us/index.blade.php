<x-app-layout>

    <div class="container">

    <h2 class="text-center display-4 fw-lighter my-5">About Us</h2>
    @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    <div class="row">
      <div class="col-md-4">
        <img src="{{ $aboutUs->photo }}" class="img-fluid card-img" alt="">
      </div>
      <div class="col-md-8">
          <h3>{{ $aboutUs->title }}</h3>
      <p class="fs-5">
        {{ $aboutUs->content }}    
      </p>
    </div>
   </div>



    </div>

</x-app-layout>

