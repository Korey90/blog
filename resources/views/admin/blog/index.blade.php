<x-app-layout>
    <div class="container">
        <h2 class="display-4">
            {{ __('Blogs') }}
        </h2>
        <p class="text-secondary">Manage user's Blog</p>
        <hr>
        @if(session('success'))
            <div class="alert alert-success">
                {!! html_entity_decode(session('success')) !!}
            </div>
        @endif

        <div class="container">
        <table class="table table-responsive-md mt-2">
            <thead>
                <th>no.</th>
                <th>Title</th>
                <th>Created by</th>
                <th>Created at</th>
                <th>Actions</th>
            </thead>
            <tbody>
                @forelse ($blogs as $blog)
                    <tr>
                        <td>{{ $blog->id }}</td>
                        <td>{{ $blog->title }}</td>
                        <td>{{ $blog->user->name }}</td>
                        <td>
                            {{ $blog->created_at }}
                            <span class="badge rounded-pill bg-primary">{{ $blog->status }}</span>
                        </td>
                        <td class="d-flex">
                            <a href="{{ route('blog.show', str_replace(' ', '-', $blog->title) ) }}" class="link-success"><i class="fas fa-eye p-1"></i></a>
                            
                                    <form id="deleteBlog{{$loop->index}}" action="{{ route('admin.blog.delete', encrypt($blog->id)) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <i class="fas fa-trash-alt p-1 text-danger" onclick="return confirmSubmit({{ $loop->index }});"></i>
                                    </form>
                        </td>
                    </tr>
                @empty
                    Brak Wiadomości
                @endforelse
            </tbody>
        </table>
        </div>

    </div>
    <script>
        function confirmSubmit(date) {
            var result = confirm("Czy na pewno chcesz usunąć tę wiadomość?");
            if (result) {
                document.getElementById('deleteBlog'+date).submit();
            }
            return false; // Zapobiega domyślnej akcji elementu <i> (który jest tu tylko dla wyglądu)
        }
    </script>
</x-app-layout>
