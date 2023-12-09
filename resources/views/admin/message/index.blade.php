<x-app-layout>
    <div class="container">
        <h2 class="display-4">
            {{ __('Messages') }}
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
    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">New</button>
    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Archiwe</button>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
        <table class="table table-responsive-md mt-2">
            <thead>
                <th>no.</th>
                <th>Name</th>
                <th>Email</th>
                <th>Created at</th>
                <th>Actions</th>
            </thead>
            <tbody>
                @forelse ($messages as $message)
                    <tr>
                        <td>{{ $message->id }}</td>
                        <td> @if($message->status == 'unread') <span class="badge rounded-pill bg-info">New</span> @endif {{ $message->name }} </td>
                        <td>{{ $message->email }}</td>
                        <td>
                            {{ $message->created_at }}
                            <span class="badge rounded-pill bg-primary">{{ $message->status }}</span>
                        </td>
                        <td class="d-flex">
                            <a href="{{ route('message.show', encrypt($message->id)) }}" class="link-success"><i class="fas fa-eye p-1"></i></a>
                            <a href="{{ route('message.archive', encrypt($message->id)) }}"><i class="fas fa-archive"></i></a>
                                    <form id="deleteMessage{{$loop->index}}" action="{{ route('message.destroy', encrypt($message->id)) }}" method="post">
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
    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
        <table class="table table-responsive-md mt-2">
            <thead>
                <th>no.</th>
                <th>Name</th>
                <th>Email</th>
                <th>Created at</th>
                <th>Actions</th>
            </thead>
            <tbody>
                @forelse ($messages->filter(function($message){ return $message->status == 'unread';}) as $message)
                    <tr>
                        <td>{{ $message->id }}</td>
                        <td><span class="badge rounded-pill bg-info">New</span> {{ $message->name }}</td>
                        <td>{{ $message->email }}</td>
                        <td>
                            {{ $message->created_at }}
                            <span class="badge rounded-pill bg-primary">{{ $message->status }}</span>
                        </td>
                        <td class="d-flex">
                            <a href="{{ route('message.show', ['id' => encrypt($message->id)]) }}" class="link-success"><i class="fas fa-eye p-1"></i></a>
                            <a href=""><i class="fas fa-archive"></i></a>
                                    <form id="deleteMessage{{$loop->index}}" action="{{ route('message.destroy', encrypt($message->id)) }}" method="post">
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
    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
        <table class="table table-responsive-md mt-2">
            <thead>
                <th>no.</th>
                <th>Name</th>
                <th>Email</th>
                <th>Created at</th>
                <th>Actions</th>
            </thead>
            <tbody>
                @forelse ($messages->filter(function($message){ return $message->status == 'archive';}) as $message)
                    <tr>
                        <td>{{ $message->id }}</td>
                        <td>{{ $message->name }}</td>
                        <td>{{ $message->email }}</td>
                        <td>
                            {{ $message->created_at }}
                            <span class="badge rounded-pill bg-primary">{{ $message->status }}</span>
                        </td>
                        <td class="d-flex">
                            <a href="{{ route('message.show', ['id' => encrypt($message->id)]) }}" class="link-success"><i class="fas fa-eye p-1"></i></a>
                                    <form id="deleteMessage{{$loop->index}}" action="{{ route('message.destroy', encrypt($message->id)) }}" method="post">
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
</div>
        </div>

    </div>

    <script>
        function confirmSubmit(date) {
            var result = confirm("Czy na pewno chcesz usunąć tę wiadomość?");
            if (result) {
                document.getElementById('deleteMessage'+date).submit();
            }
            return false; // Zapobiega domyślnej akcji elementu <i> (który jest tu tylko dla wyglądu)
        }
    </script>
</x-app-layout>
