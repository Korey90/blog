<x-app-layout>
<style>
  .sidebar-sticky{position:-webkit-sticky;position:sticky;top:0}.site-newsletter{background:#f2f4f5;margin-top:3rem;padding-bottom:5rem;padding-top:5rem}.vimeo{height:0;max-width:100%;overflow:hidden;padding-bottom:50%;position:relative}.vimeo embed,.vimeo iframe,.vimeo object{height:100%;left:0;position:absolute;top:0;width:100%}.site-preview-intro{background:#f2f4f5;padding-bottom:3rem;padding-top:3rem}.site-preview-choices{padding-bottom:1.5rem;padding-top:1.5rem}
</style>
    <div class="container">
<div class="alert alert-danger">
  Widok Pojedynczego posta <br>
  - dorobic popular Stories <br>
  - zrobic widok tagow <br>

</div>
      <div class="row">
        <div class="col-md-9">

          <article class="card mb-4" style="border: solid 0px;">
            <header class="card-body text-center">
            <a href="post-image.html" class="nav-link">
                <h1 class="card-title display-4">{{ $post->title }}</h1>
              </a>
              <div class="card-meta">
                <time class="timeago text-muted" datetime="{{ $post->created_at }}">{{ $post->created_at }}</time>
              </div>

            </header>
            <div class="card-body">

             <p class="lead fs-4 text" style="text-align: justify;">

                 {!! $post->content !!}
             </p>
             <p class="lead fs-4 text" style="text-align: justify;">
                  Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eveniet laudantium deserunt ullam fugiat. Quasi, ducimus. Cum consequatur corrupti, blanditiis dolorum hic, nesciunt repellat error sint commodi laboriosam neque accusantium corporis.
             </p>

             <p class="align-right lead text-end mt-5">
              <b>Writed by</b> <a href="{{ route('blog.show', str_replace(' ', '-', $post->blog()->value('title')) ) }}">{{ $post->blog->user()->value('name') }}</a>
             </p>

              <hr class="my-5" />

              <h3>{{ $post->comments->count() }} comments</h3>
              
                @forelse ($post->comments as $comment)
 
                    
                    <div class="d-flex mb-3 p-3 bg-light">
                <div class="text-center">
                  <img class="me-3 rounded-circle" src="{{ asset('avatars/'.$comment->author()->value('avatar')) }}" alt="{{ $comment->author()->value('avatar') }}" width="100" height="100">
                  <h6 class="mt-1 mb-0 me-3">{{ $comment->author()->value('name') }}</h6>
                </div>
                <div class="flex-grow-1 d-block">
                  <p class="mt-3 mb-2">{{ $comment->content }}</p>
                  <time class="timeago text-muted float-end" datetime="{{ $comment->author()->value('created_at') }}">{{ $comment->author()->value('created_at') }}</time>
                </div>
              </div>
                @empty
                    There is no comments.                                    
                @endforelse


              <div class="mt-5">
                <h5>Write a response</h5>

                <form action="{{ route('comments.store', $post->id) }}" class="form" method="post">
                    @csrf
                    @method('POST')
                    <textarea name="content" id="" rows="6" placeholder="Add new coment" class="form-control mb-1 shadow-sm" required></textarea>
                    <input type="submit" class="btn btn-outline-primary mb-4" value="Add comment">
                </form>

              </div>

            </div>
          </article><!-- /.card -->

        </div>
        
        <div class="col-md-3 ms-auto">

          <aside class="sidebar">
            <div class="card mb-4 shadow-sm">
              <div class="card-body">
                <h4 class="card-title">About Me</h4>
                <p class="card-text">
                {{ $post->blog()->value('about_author') }}                  
                </p>
              </div>
            </div><!-- /.card -->
          </aside>

          <aside class="sidebar sidebar-sticky">
            <div class="card mb-4 shadow-sm">
              <div class="card-body">
                <h4 class="card-title">Tags</h4>
                @foreach($post->tags as $tag)
                    <a href="{{ route('tag.show', $tag->name) }}" class="badge p-2 m-1 bg-primary nav-link text-light rounded-3 text-capitalize">{{ $tag->name }}</a>
                @endforeach
              </div>
            </div><!-- /.card -->
            <div class="card mb-4 shadow-sm">
              <div class="card-body">
                <h4 class="card-title">Popular Stories</h4>

                <a href="post-image.html" class="d-inline-block link-primary">
                  <h4 class="h6">Amazing Design</h4>
                  <img class="card-img" src="{{ asset('storage/foto1.png') }}" alt="" />
                </a>
                <time class="timeago text-muted lead" datetime="2021-09-03 20:00">3 october 2021</time>

                <a href="post-image.html" class="d-inline-block mt-3 link-primary">
                  <h4 class="h6">Rise down</h4>
                  <img class="card-img" src="{{ asset('storage/foto2.png') }}" alt="" />
                </a>
                <time class="timeago text-muted lead" datetime="2022-07-16 20:00">16 july 2022</time>

              </div>
            </div><!-- /.card -->
          </aside>

        </div>
      </div>
    </div>

  </main>


<script>
function timeSince(date) {
    const seconds = Math.floor((new Date() - date) / 1000);
    let interval = Math.floor(seconds / 31536000);

    if (interval > 1) {
        return interval + " years ago";
    }
    interval = Math.floor(seconds / 2592000);
    if (interval > 1) {
        return interval + " months ago";
    }
    interval = Math.floor(seconds / 86400);
    if (interval > 1) {
        return interval + " days ago";
    }
    interval = Math.floor(seconds / 3600);
    if (interval > 1) {
        return interval + " hours ago";
    }
    interval = Math.floor(seconds / 60);
    if (interval > 1) {
        return interval + " minutes ago";
    }
    return Math.floor(seconds) + " secounds ago";
}

document.querySelectorAll(".timeago").forEach(elem => {
    const dateTime = elem.getAttribute("datetime");
    const date = new Date(dateTime);
    elem.textContent = timeSince(date);
});

</script>

</x-app-layout>