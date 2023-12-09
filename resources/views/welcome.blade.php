<x-app-layout>
<style>
.title-img {
    color: #ffffff;
    text-align: center;
    transition: transform 0.3s, box-shadow 0.3s;
}

.title-img:hover {
    transform: translateY(-6px); 
    box-shadow: 0 10px 10px rgba(0, 0, 0, 0.5); 
}
</style>
    <div class="container">

      <h2 class="text-center display-4 fw-lighter my-5">Most Popular Blogs</h2>
<form action="{{ route('search') }}" method="get" class="d-flex justify-content-center">
  <input type="search" name="searchTerm" id="search-input" class="w-75 mb-4 form-control rounded-pill border-primary" placeholder="Search for blogs.." data-url="{{ route('search') }}">
</form>

      <div class="d-flex flex-wrap justify-content-center">
        @foreach (App\Models\Blog::all() as $blog)
          <div class="card m-2 border-0 shadow" style="width: 45%;">
            <div class="row">
              <div class="col-md-4 p-3">
                @if($blog->user->avatar !== null)
                  <img src="{{ asset('avatars/'.$blog->user->avatar) }}" class="w-100 title-img" alt="{{ $blog->title }}">
                @endif
              </div>
              <div class="col-md-8">
                <div class="card-body d-flex flex-column">
                  <h5 class="card-title"><a class="nav-link link-primary" href="{{ route('blog.show', str_replace(' ', '-', $blog->title) ) }}">{{ $blog->title }}</a></h5>
                  <div class="card-text mb-3">{{ $blog->description }}</div>

                  <div class="text-muted fs-5 text-end mt-auto">{{ $blog->user->name }}</div>
                </div>
              </div>
            </div>

          </div>
          
        @endforeach
      </div>

    </div>


  <div class="container my-4">
    <h2 class="text-center display-4 fw-lighter my-5">Popular Tags</h2>
    <div class="d-flex flex-wrap">
      @foreach (App\Models\Tag::get() as $tag)
        <a href="" class="m-2 rounded-3">
          <span class="badge bg-secondary p-2">{{ $tag->name }}</span>
        </a>

      @endforeach

    </div>

  </div>

  <div class="site-newsletter py-5" style="background-color: #2f3c52;">
    <div class="container">
      <div class="text-center text-light">
        <h3 class="h3 mb-3">Subscribe to our newsletter</h3>
        <p class="">Join our monthly newsletter and never miss out on new stories and promotions.</p>

        <div class="row">
          <div class="col-xs-12 col-sm-9 col-md-7 col-lg-5 ms-auto me-auto">
            <div class="input-group mb-3 mt-3">
              <input type="text" class="form-control" placeholder="Email address" aria-label="Email address">
              <span class="input-group-btn">
                <button class="btn btn-outline-light" type="button">Subscribe</button>
              </span>

            </div>
            https://milo.bootlab.io/js/app.js
          </div>
        </div>
      </div>
    </div>
  </div>


</body>
</html>


</x-app-layout>