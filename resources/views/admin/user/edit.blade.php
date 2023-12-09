<x-app-layout>
    <div class="container">
        <h2 class="display-4">
            {{ __('User: ').$user->name }}
        </h2>
        <p class="text-secondary">Edit Users Profile</p>
        <hr>
        <div class="card mb-5">
            <h5 class="card-header">Account Information</h5>
            <div class="card-body">
      <img src="{{ asset('avatars/'.$user->avatar) }}" alt="{{ $user->avatar}}" style="max-width: 200px; position: absolute; right: 20px;">
      <form action="{{ route('admin.user.update', encrypt($user->id)) }}" method="post">
        @csrf
        @method('PUT')
    <dl class="row">
        <dt class="col-sm-3 p-2">User Name</dt>
        <dd class="col-sm-9 p-2">
            <input type="text" name="name" id="" value="{{ $user->name }}">
        </dd>

        <dt class="col-sm-3 p-2">User Email</dt>
        <dd class="col-sm-9 p-2">
            <input type="email" name="email" id="" value="{{ $user->email }}">
        </dd>

        <dt class="col-sm-3 p-2">Account Created at</dt>
        <dd class="col-sm-9 p-2">
            <input type="text" name="created_at" id="" value="{{ $user->created_at }}" readonly />
        </dd>

        <dt class="col-sm-3 p-2">Role</dt>
        <dd class="col-sm-9 p-2">
            @forelse ($roles as $role)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="{{ $role->id }}" name="roles[]" id="flexCheck{{ $loop->index }}" @if(in_array( $role->name, $user->roles->pluck('name')->toArray())) checked @endif >
                    <label class="form-check-label" for="flexCheck{{ $loop->index }}" >
                        {{ $role->name }}
                    </label>
                </div>
            @empty
                It's nothing to show here.
            @endforelse
        </dd>


        <dt class="col-sm-3 p-2">Blog Title</dt>
        <dd class="col-sm-9 p-2">
            <input type="text" name="title" id="" value="{{ $user->blog->title }}">
        </dd>

        <dt class="col-sm-3 p-2">Blog Description</dt>
        <dd class="col-sm-9 p-2">
            <textarea name="description" id="" cols="30" rows="5">{{ $user->blog->description }}</textarea>
        </dd>

        <dt class="col-sm-3 p-2">Blog Created at</dt>
        <dd class="col-sm-9 p-2">
            <input type="text" name="blog_created_at" id="" value="{{ $user->blog->created_at }}" readonly>
        </dd>

        <dt class="col-sm-3 p-2">About Author</dt>
        <dd class="col-sm-9 p-2">
            <input type="text" name="blog_about_author" id="" value="{{ $user->blog->about_author }}">
        </dd>

        
        <dt class="col-sm-3 p-2">Posted articles</dt>
        <dd class="col-sm-9 p-2">{{ $user->blog->posts->count() }}</dd>
    </dl>
    <input type="submit" class="btn btn-outline-primary" value="Update profile">
</div>
</form>
</div>

<code>

</code>

    </div>
</x-app-layout>
