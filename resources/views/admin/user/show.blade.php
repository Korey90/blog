<x-app-layout>
    <div class="container">
        <h2 class="display-4">
            {{ __('User: ').$user->name }}
        </h2>
        <p class="text-secondary">Users Profile</p>
        <hr>
        <div class="card mb-5">
            <h5 class="card-header">Account Information</h5>
            <div class="card-body">
      <img src="{{ asset('avatars/'.$user->avatar) }}" alt="{{ $user->avatar}}" style="max-width: 200px; position: absolute; right: 20px;">
    <dl class="row">
        <dt class="col-sm-3 p-2">User Name</dt>
        <dd class="col-sm-9 p-2">{{ $user->name }}</dd>

        <dt class="col-sm-3 p-2">User Email</dt>
        <dd class="col-sm-9 p-2">{{ $user->email }}</dd>

        <dt class="col-sm-3 p-2">Account Created at</dt>
        <dd class="col-sm-9 p-2">{{ $user->created_at }}</dd>

        <dt class="col-sm-3 p-2">Role</dt>
        <dd class="col-sm-9 p-2">
            @forelse ($user->roles as $role)
                <span class="badge rounded-pill bg-primary">{{ $role->name }}</span> , 
            @empty
                It's nothing to show here.
            @endforelse
        </dd>


        <dt class="col-sm-3 p-2">Blog Title</dt>
        <dd class="col-sm-9 p-2"><a href="{{ route('blog.show', str_replace(' ', '-', $user->blog->title)) }}" class="nav-link text-primary">{{ $user->blog->title }}</a></dd>

        <dt class="col-sm-3 p-2">Blog Description</dt>
        <dd class="col-sm-9 p-2">{{ $user->blog->description }}</dd>

        <dt class="col-sm-3 p-2">Blog Created at</dt>
        <dd class="col-sm-9 p-2">{{ $user->blog->created_at }}</dd>

        <dt class="col-sm-3 p-2">About Author</dt>
        <dd class="col-sm-9 p-2">{{ $user->blog->about_author }}</dd>

        
        <dt class="col-sm-3 p-2">Posted articles</dt>
        <dd class="col-sm-9 p-2">{{ $user->blog->posts->count() }}</dd>
    </dl>
  </div>
</div>

<code>

</code>

    </div>
</x-app-layout>
