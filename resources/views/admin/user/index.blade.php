<x-app-layout>
    <div class="container">
        <h2 class="display-4">
            {{ __('Users') }}
        </h2>
        <p class="text-secondary">Twoje centrum dowodzenia</p>
        <hr>
        @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

        <div class="container">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Index</button>
                    @foreach ($roles as $role)
                        <button class="nav-link" id="nav-{{ $role }}-tab" data-bs-toggle="tab" data-bs-target="#nav-{{ $role }}" type="button" role="tab" aria-controls="nav-{{ $role }}" aria-selected="false">{{ $role }}</button>        
                    @endforeach
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <table class="table table-responsive-md mt-2 mb-5">
                        <thead>
                            <th>no.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Created at</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td class="d-flex">
                                        <a href="{{ route('admin.user.show', encrypt($user->id)) }}" class="link-success"><i class="fas fa-eye p-1"></i></a>
                                        <a href="{{ route('admin.user.edit', encrypt($user->id)) }}" class="link-primary"><i class="fas fa-edit p-1"></i></a>
                                                <form id="deleteUser{{$loop->index}}" action="{{ route('admin.user.destroy', encrypt($user->id) )}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <i class="fas fa-trash-alt p-1 text-danger" onclick="return confirmSubmit({{ $loop->index }});"></i>
                                                </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4"> Brak Wiadomości </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @foreach ($roles as $role)
                    <div class="tab-pane fade" id="nav-{{ $role }}" role="tabpanel" aria-labelledby="nav-{{ $role }}-tab">
        
                        <table class="table table-responsive-md mt-2 mb-5">
                            <thead>
                                <th>no.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Created at</th>
                                <th>Actions</th>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    @if($user->hasRole($role))
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->created_at }}</td>
                                            <td class="d-flex">
                                                <a href="{{ route('admin.user.show', encrypt($user->id)) }}" class="link-success"><i class="fas fa-eye p-1"></i></a>
                                                <a href="{{ route('admin.user.edit', encrypt($user->id)) }}" class="link-primary"><i class="fas fa-edit p-1"></i></a>
                                                        <form id="deleteUser{{$loop->index}}" action="{{ route('admin.user.destroy', encrypt($user->id) )}}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <i class="fas fa-trash-alt p-1 text-danger" onclick="return confirmSubmit({{ $loop->index }});"></i>
                                                        </form>
                                            </td>
                                        </tr>
                                    @endif
                                @empty
                                    <tr>
                                        <td colspan="4"> Brak Wiadomości </td>
                                    </tr>
                                    
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        function confirmSubmit(date) {
            var result = confirm("Czy na pewno chcesz usunąć tego uzytkownika?");
            if (result) {
                document.getElementById('deleteUser'+date).submit();
            }
            return false; // Zapobiega domyślnej akcji elementu <i> (który jest tu tylko dla wyglądu)
        }
    </script>
</x-app-layout>
