<x-app-layout>
<style>
  .sidebar-sticky{position:-webkit-sticky;position:sticky;top:0}.site-newsletter{background:#f2f4f5;margin-top:3rem;padding-bottom:5rem;padding-top:5rem}.vimeo{height:0;max-width:100%;overflow:hidden;padding-bottom:50%;position:relative}.vimeo embed,.vimeo iframe,.vimeo object{height:100%;left:0;position:absolute;top:0;width:100%}.site-preview-intro{background:#f2f4f5;padding-bottom:3rem;padding-top:3rem}.site-preview-choices{padding-bottom:1.5rem;padding-top:1.5rem}
</style>

<main class="main pt-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="display-4 lead mb-4">Posts:</h2>
                    <a href="{{ route('post.create') }}" class="btn btn-outline-primary">Create new</a>
                    
                </div>
                <hr class="w-75 py-4"/>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="d-flex flex-column">
                    @forelse ($blog->posts->sortByDesc('created_at') as $post)
                        <div class="p-2">
                            <article class="card mb-1 shadow-sm border-sm p-2 d-flex flex-row">
                                <div class="my-0 pb-0 d-flex flex-column flex-fill">
                                    <a href="{{ route('post.show', encrypt($post->id)) }}" class="link-primary lead fs-3" style="text-decoration: none;">
                                        {{ $post->title }}
                                    </a>
                                    <time class="timeago text-secondary fw-normal fs-6" datetime="{{ $post->created_at }}">{{ $post->created_at }}</time>
                                </div>
                                <div class="d-flex flex-column justify-content-center">
                                    <a href="{{ route('post.edit', encrypt($post->id)) }}" class="link-primary"><i class="fas fa-edit p-1"></i></a>
                                    <a href="{{ route('post.show', encrypt($post->id)) }}" class="link-success"><i class="fas fa-eye p-1"></i></a>
                                    <form id="deletePost{{$loop->index}}" action="{{ route('post.destroy', encrypt($post->id)) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <i class="fas fa-trash-alt p-1 text-danger" onclick="return confirmSubmit({{ $loop->index }});"></i>
                                    </form>
                                </div>
                            </article><!-- /.card -->
                        </div>
                    @empty
                        <p>Brak postów.</p>
                    @endforelse
                </div>
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

function confirmSubmit(date) {
        var result = confirm("Czy na pewno chcesz usunąć?");
        if (result) {
            document.getElementById('deletePost'+date).submit();
        }
        return false; // Zapobiega domyślnej akcji elementu <i> (który jest tu tylko dla wyglądu)
    }
</script>

</x-app-layout>