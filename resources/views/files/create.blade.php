<x-app-layout>

    <div class="container">

    <form action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file">
    <button type="submit">Prześlij plik</button>
</form>



    </div>


</x-app-layout>