<x-app-layout><!-- widok bloga dla odwiedzajacego -->
    <x-slot name="header">
        <h2 class="display-4">
            Blog Edit
        </h2>
        <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab quos labore assumenda voluptatibus a id in nesciunt.</p>
    </x-slot>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="py-12 border">
        <form action="{{ route('blog.update', encrypt($blog->id)) }}" method="post">
            @csrf
            @method('PUT')
            <div class="mb-3 p-2">
                <label for="blog-title" class="form-label">Blog Title</label>
                <input type="text" name="title" class="form-control bg-dark text-light" id="blog-title" value="{{ $blog->title }}" placeholder="Blog title">
            </div>
            <div class="mb-3 p-2">
                <label for="blog-description" class="form-label">Blog Description</label>
                <textarea class="form-control bg-dark text-light" name="description" id="blog-description" rows="3">{{ $blog->description }}</textarea>
            </div>
            <div class="mb-3 p-2 d-flex justify-content-end">
                <input type="submit" class="btn btn-outline-primary" value="Update">
            </div>
        </form>
    </div>
</x-app-layout>