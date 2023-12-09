<x-app-layout>

    <div class="container">
<a href="{{ route('files.create') }}">Upload new file</a>

    @foreach($files as $file)
    <div>
        <img src="{{ str_replace('public', 'storage', $file) }}" alt="nie laduje">

        <form action="{{ route('files.destroy', str_replace('public', 'storage', $file)) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Usuń</button>
        </form>
    </div>
    @endforeach


    </div>


</x-app-layout>