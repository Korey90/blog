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

      <h2 class="text-center display-4 fw-lighter my-5">Search Results</h2>
<form action="{{ route('search') }}" method="get" class="d-flex justify-content-center">
  <input type="search" name="searchTerm" id="search-input" value="{{ request('searchTerm') }}" class="w-75 mb-3 form-control rounded-pill border-primary" placeholder="Search for blogs.." >
</form>
<p>          {{ $posts->links(); }}</p>
      <div class="d-flex flex-wrap justify-content-center w-100">
        @foreach ($posts as $post)
          <div class="card m-2 border-0 shadow w-100">

                <div class="card-body d-flex flex-column">
                  <h5 class="card-title"><a class="nav-link link-primary" href="{{ route('post.show', encrypt($post->id) ) }}">{{ $post->title }}</a></h5>
                  <div class="card-text mb-3">{!! $post->content !!}</div>

                  <div class="text-muted fs-5 text-end mt-auto">{{ $post->author }} <small>from</small> <a href="{{ route('blog.show', str_replace(' ', '-', $post->blog->title) ) }}" class="nav-link text-primary">{{ $post->blog->title }}</a></div>
                </div>



          </div>
          
        @endforeach
      </div>

          {{ $posts->links(); }}


    </div>


  <div class="container my-4">
    <h2 class="text-center display-4 fw-lighter my-5">Popular Tags</h2>
    <div class="d-flex flex-wrap">
      @foreach (App\Models\Tag::get() as $tag)
        <a href="" class="m-2 rounded-3">
          <span class="badge bg-secondary p-2">{{ $tag->name }} </span>
        </a>

      @endforeach

    </div>

  </div>



</body>
</html>


</x-app-layout>