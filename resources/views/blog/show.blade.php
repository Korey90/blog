<x-app-layout>
<style>
  .sidebar-sticky{position:-webkit-sticky;position:sticky;top:0}.site-newsletter{background:#f2f4f5;margin-top:3rem;padding-bottom:5rem;padding-top:5rem}.vimeo{height:0;max-width:100%;overflow:hidden;padding-bottom:50%;position:relative}.vimeo embed,.vimeo iframe,.vimeo object{height:100%;left:0;position:absolute;top:0;width:100%}.site-preview-intro{background:#f2f4f5;padding-bottom:3rem;padding-top:3rem}.site-preview-choices{padding-bottom:1.5rem;padding-top:1.5rem}
</style>
    <main class="main pt-4">

    <div class="container">

      <div class="row">
        <h2 class="text-center display-4 lead mb-4">{{ $blog->title }}</h2>
        <div class="col-md-9">
          <hr />
          <div class="d-flex">
         
          <div class="d-flex flex-column w-50">
            @forelse ($blog->posts[0] as $post)
                <div class="p-2">
                    <article class="card h-100 mb-4 shadow-sm border-sm p-2 d-flex align-items-start">
                        <header class="pb-4">
                            <a href="{{ route('post.show', encrypt($post->id)) }}" class="nav-link link-primary">
                                <h4 class="card-title lead fs-3">{{ $post->title }}</h4>
                            </a>
                            <div class="card-meta">
                                <time class="timeago" datetime="{{ $post->created_at }}">{{ $post->created_at }}</time>
                            </div>
                        </header>
                        <a href="post-image.html">
                            <img class="card-img" src="{{ asset('storage/foto1.png') }}" alt="" />
                        </a>
                        <div class="d-flex flex-column">
                            <p class="card-text lead" style="text-align: justify;">{!! $post->content !!}</p>
                        </div>
                    </article><!-- /.card -->
                </div>
            @empty
                <p>Brak postów.</p>
            @endforelse
          </div>

          <div class="d-flex flex-column w-50">
            @forelse ($blog->posts[1] as $post)
                <div class="p-2">
                    <article class="card h-100 mb-4 shadow-sm border-sm p-2 d-flex align-items-start">
                        <header class="pb-4">
                            <a href="{{ route('post.show', encrypt($post->id)) }}" class="nav-link link-primary">
                                <h4 class="card-title lead fs-3">{{ $post->title }}</h4>
                            </a>
                            <div class="card-meta">
                                <time class="timeago" datetime="{{ $post->created_at }}">{{ $post->created_at }}</time>
                            </div>
                        </header>
                        <a href="post-image.html">
                            <img class="card-img" src="{{ asset('storage/foto1.png') }}" alt="" />
                        </a>
                        <div class="d-flex flex-column">
                            <p class="card-text lead" style="text-align: justify;">{!! $post->content !!}</p>
                        </div>
                    </article><!-- /.card -->
                </div>
            @empty
                <p>Brak postów.</p>
            @endforelse
          </div>
          </div>

        </div>
        <div class="col-md-3 ms-auto">

          <aside class="sidebar">
            <div class="card mb-4 shadow-sm">
              <div class="card-body">
                <h4 class="card-title text-primary d-flex justify-content-between align-items-center">
                  <span class="fs-2">About Blog</span>
                  
                  
                <img src="{{ asset('avatars/'.$blog->user->avatar) }}" class="card-img rounded-circle w-25"  alt="obrazek">

                </h4>
                <p class="card-text" style="text-align: justify;">{{ $blog->description }}</p>

                <p>
                  Created <time class="timeago" datetime="{{ $blog->created_at }}">{{ $blog->created_at }}</time>
                  by <span class="text-muted">{{ $blog->user()->value('name') }}</span>
                </p>
              </div>
            </div><!-- /.card -->
          </aside>

          <aside class="sidebar sidebar-sticky">
            <div class="card mb-4 shadow-sm">
              <div class="card-body">
                <h4 class="card-title text-primary">Popular stories</h4>

                <a href="post-image.html" class="d-inline-block link-dark">
                  <h4 class="h6">Alon in Bush</h4>
                  <img class="card-img" src="{{ asset('storage/foto2.png') }}" alt="" />
                </a>
                <time class="timeago" datetime="2021-09-03 20:00">3 october 2021</time>

                <a href="post-image.html" class="d-inline-block mt-3 link-dark">
                  <h4 class="h6">GTA 6 Trailer</h4>
                  <img class="card-img" src="{{ asset('storage/foto1.png') }}" alt="" />
                </a>
                <time class="timeago" datetime="2023-07-16 20:00">16 july 2023</time>

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