<section>
    <div class="row">
        <div class="col-md-10">
        <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('User Avatar') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Manage your avatar.") }}
        </p>
    </header>
<div id="alert-box"></div>
<form id="upload-avatar-form" enctype="multipart/form-data">
    @csrf
    <label for="avatar" class="form-label">Upload your avatar</label>
    <input type="file" name="avatar" id="avatar" required class="form-control mb-3">
    <button class="btn btn-primary text-light" type="submit">Prześlij Avatar</button>
</form>
        </div>
        <div class="col-md-2">
            <div class="d-flex flex-column">
                @if(Auth::user()->avatar == null)
                    <img id="avatar-image" src="" class="card-img mb-2" alt="Brak avatara">
                @else
                <form action="{{ route('avatar.destroy', encrypt(Auth::user()->avatar)) }}" method="post">
                    @csrf
                    @method('POST')

                    <img src="{{ asset('avatars/'.Auth::user()->avatar) }}" class="card-img mb-2" alt="obrazek">
                        <input type="submit" class="btn btn-danger text-light w-100" value="Delete">
                    </form>
                @endif
            </div>
        </div>
    </div>
   
<section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
   $(document).ready(function() {
    $("#upload-avatar-form").on("submit", function(e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "{{ route('avatar.store') }}",
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function(response) {
                $('#alert-box').html('<div class="alert alert-success">' + response.success + '</div>');

                    // Zakładając, że response.image zawiera nazwę przesłanego obrazka
                    $('#avatar-image').attr('src', 'avatars/' + response.image);

                $('input[type="file"]').val('');
            },
            error: function(response) {
    var errors = response.responseJSON.errors;
    var errorMessage = '<div class="alert alert-danger">Unexpected fail: <ul>';

    $.each(errors, function(field, messages){
        $.each(messages, function(index, message){
            errorMessage += '<li>' + message + '</li>';
        });
    });

    errorMessage += '</ul></div>';

    $('#alert-box').html(errorMessage);
}

        });
    });
});

</script>
