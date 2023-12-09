<x-app-layout><!-- widok bloga dla odwiedzajacego -->
    <x-slot name="header">
        <h2 class="display-4">
            <b>Tag:</b> {{ $tag[0]->name }}
        </h2>
        <p class="text-secondary"></p>
    </x-slot>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="py-12">
        <div class="p-4">
            {{ __("Sortuj wg:") }} <a href="">data:</a>

        </div>

        <div class="p-6">
            @forelse ($tag[0]->posts as $post)
                <div class="mb-3 px-3 py-2 rounded-2 shadow" style="background-color: #1C1C1C;">
                    <div class="d-flex justify-content-between">
                        <h2 class="h4 fs-5 lead text-uppercase">
                            {{ $post->title }}
                        </h2>
                        <p class="fs-6 fw-lighter">created at: {{ $post->created_at }}</p>
                    </div>
                    <hr>
                    <div class="lh-base">{!! $post->content !!}</div>

                    <p><b>Tags:</b>
                        @foreach($post->tags as $tag)
                            <a href="{{ route('tag.show', $tag->name) }}" class="badge p-2 m-1 bg-primary">{{ $tag->name }}</a>
                        @endforeach
                    </p>
                    <p class="text-end">
                        <a data-bs-toggle="collapse" href="#post{{ $post->id }}" role="button" aria-expanded="false" aria-controls="collapseExample" class="text-secondary text-decoration-none">Coments ({{ $post->comments->count() }})</a>
                        <p>

                        </p>
                        <div class="collapse" id="post{{ $post->id }}">
                            <div class="bg-dark p-3">
                                <h4 class="mb-3">Comments:</h4>
                                <form action="{{ route('comments.store', $post->id) }}" class="form" method="post">
                                    @csrf
                                    @method('POST')
                                    <textarea name="content" id="" rows="6" placeholder="Add new coment" class="form-control mb-1 bg-dark text-light border-secondary shadow" required></textarea>
                                    <input type="submit" class="btn btn-outline-secondary mb-4" value="Add comment">
                                </form>
                                @forelse ($post->comments as $comment)
                                    <div class="border mb-2 p-2 rounded-3">
                                        <div class="d-flex justify-content-between">
                                            <a href="" class="text-secondary text-decoration-none">
                                                {{ $comment->author()->pluck('name')->first() }} Napisał:
                                            </a>
                                            <p>Dodano: {{ $comment->author()->pluck('created_at')->first() }}</p>
                                        </div>
                                        {{ $comment->content }}
                                    </div>                                    
                                @empty
                                    There is no comments.                                    
                                @endforelse
                            </div>
                        </div>
                    </p>
                    <hr>
                    <div class="fs-6 text-end fw-lighter">created by: {{ $post->author }}</div>
                </div>
            @empty
                Ten użytkownik nie ma zadnego Wpisu
            @endforelse
        </div>
    </div>
</x-app-layout>