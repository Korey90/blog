<x-app-layout>
    <div class="container">
        <h2 class="display-4">
            {{ __('Edit About Us') }}
        </h2>
        <p class="text-secondary">Manage section about us</p>
        <hr>
        @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

        <div class="container">
        <form method="POST" class="form" action="{{ route('about-us.update') }}">
        @csrf
        @method('PUT')

        <div class="form-group mb-2">
            <label class="form-label" for="title">Title:</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $aboutUs->title }}">
        </div>

        <div class="form-group mb-2">
            <label class="form-label" for="content">Content:</label>
            <textarea name="content" id="content" class="form-control" rows="6">{{ $aboutUs->content }}</textarea>
        </div>

        <div class="form-group mb-2">
            <label class="form-label" for="photo">photo url:</label>
            <input type="text" name="photo" id="photoe" class="form-control" value="{{ $aboutUs->photo }}">
        </div>

        <div class="form-group mb-2">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
        </div>

    </div>


</x-app-layout>
