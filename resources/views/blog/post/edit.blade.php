<x-app-layout>

    <style>
        #editor {
            width: 100%;
            height: 300px;
            border: 1px solid #000;
            overflow-y: scroll;
        }

        .resizable {
            position: relative;
            display: inline-block;
        }

        .resizable img {
            width: 100%;
            height: auto;
        }

        .resizable-handle {
            position: absolute;
            width: 10px;
            height: 10px;
            background-color: #000;
            border-radius: 50%;
        }

        .resizable-handle.ne {
            top: 0;
            right: 0;
            cursor: ne-resize;
        }

        .resizable-handle.se {
            bottom: 0;
            right: 0;
            cursor: se-resize;
        }

        .file-input {
            display: none;
        }

        .custom-file-label {
            cursor: pointer;
        }
    </style>


<main class="main pt-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="display-4 lead mb-4">Edit Post:</h2>
                    <a href="{{ url()->previous() }}" class="btn btn-outline-primary"><i class="fas fa-arrow-alt-circle-left"></i> Back</a>
                </div>
                <hr class="w-75 py-4"/>
                <form id="addPost" action="{{ route('post.update', encrypt($post->id)) }}" method="POST" class="">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="form-label" for="title">
                            Title
                        </label>
                        <input class="form-control" id="title" type="text" name="title" placeholder="Post title" value="{{ $post->title }}" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label" for="editor_content">
                            Content
                        </label>
                        <input type="text" name="editor_content" id="editor_content" style="display: none;" value="">

                        <div>
                            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tooltip on bottom1" onclick="format('bold')"><i class="fas fa-bold"></i></button>
                            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tooltip on bottom2" onclick="format('underline')"><i class="fas fa-underline"></i></button>
                            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tooltip on bottom3" onclick="format('italic')"><i class="fas fa-italic"></i></button>
                            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tooltip on bottom4" onclick="format('justifyLeft')"><i class="fas fa-align-left"></i></button>
                            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tooltip on bottom5" onclick="format('justifyCenter')"><i class="fas fa-align-center"></i></button>
                            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tooltip on bottom6" onclick="format('justifyRight')"><i class="fas fa-align-right"></i></button>
                            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tooltip on bottom7" onclick="insertList('unordered')"><i class="fas fa-list-ul"></i></button>
                            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tooltip on bottom8" onclick="insertTable()"><i class="fas fa-table"></i></button>
                            <input type="file" id="file" name="file" class="file-input" onchange="insertImage(event)">
                            <label for="file" class="custom-file-label btn btn-outline-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Image upload">
                                <i class="far fa-image"></i>
                            </label>
                            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tooltip on bottom10" onclick="changeFontSize('increase')" alt="increse font"><i class="fas fa-long-arrow-alt-up" ></i></button>
                            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tooltip on bottom11" onclick="changeFontSize('decrease')" alt="decrese font"><i class="fas fa-long-arrow-alt-down"></i></button>
                        </div>

                        <div id="editor" contenteditable="true" class="text-wrap p-2">{!! html_entity_decode($post->content) !!}</div>

                    </div>
                    <div class="mb-4">
                        <label class="form-label" for="author">
                            Autor
                        </label>
                        <input class="form-control" id="author" type="text" name="author" placeholder="Author" value="{{ $post->blog->user->name }}" readonly required>
                    </div>
                    <div class="mb-4">
                        <label for="created_at" class="form-label">
                            Created at
                        </label>
                        <input class="form-control" value="{{ $post->created_at->toDateString() }}" id="created_at" type="date" name="created_at" required>
                    </div>

                    <div class="mb-2" id="tags-container">
                        <label class="form-label" for="tags">Tags</label>
                        @forelse ($post->tags as $tag)
                            <div class="tag-input d-flex py-2">
                                <input class="form-control" type="text" name="tags[]" value="{{ $tag->name }}">
                                <button class="btn btn-danger remove-tag" data-tag-id="{{ $tag->id }}" data-post-id="{{ $post->id }}">Remove</button>
                            </div>
                        @empty
                            <input class="form-control mb-2" id="tags" type="text" name="tags[]" required>
                        @endforelse
                    </div>
<div>
</div>
                    


                    <div class="d-flex items-center justify-content-between p-2">
                        <button type="button" id="add-tag" class="btn btn-outline-dark"><i class="fas fa-hashtag"></i> Add another tag</button>
                        <button class="btn btn-outline-primary" type="submit">
                            Save it
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
        // Pobierz token CSRF
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

    // Obsłuż kliknięcie przycisku usuwania
    $('.remove-tag').on('click', function (e) {
        e.preventDefault(); // Zapobieganie domyślnej akcji
        var tagId = $(this).data('tag-id');
        var tagInput = $(this).closest('.tag-input');
        var postId = $(this).data('post-id'); // Dodajemy zmienną post_id
        
        $.ajax({
            type: 'DELETE',
            url: '/remove-tag/' + tagId, // Zmodyfikuj URL odpowiednio
            headers: {
                'X-CSRF-TOKEN': csrfToken // Dodaj token CSRF do nagłówka
            },
            data: {
                post_id: postId // Przekazujemy post_id jako dane żądania
            },
            success: function (data) {
                // Zamień element na zielony alert Bootstrapa
                tagInput.html('<div class="alert alert-success m-2">Tag removed successfully</div>');

                // Spowoduj powolne znikanie alertu
                setTimeout(function () {
                    tagInput.fadeOut('slow', function () {
                        $(this).remove(); // Usunięcie elementu po zaniknięciu
                    });
                }, 1500); // Zanik po 1.5 sekundach (możesz dostosować czas)
            },
            error: function (error) {
                console.log(error);
            }
        });
    });
});

 //   document.getElementById('created_at').valueAsDate = new Date();

    document.addEventListener("DOMContentLoaded", function() {
        const tagsContainer = document.getElementById("tags-container");
        const addTagButton = document.getElementById("add-tag");

        addTagButton.addEventListener("click", function() {
            const input = document.createElement("input");
            input.className = "form-control mb-2";
            input.type = "text";
            input.name = "tags[]";
            input.required = true;
            tagsContainer.appendChild(input);
        });
    });

        function format(command) {
            document.execCommand(command, false, null);
        }

        function insertList(type) {
            document.execCommand(type === 'ordered' ? 'insertOrderedList' : 'insertUnorderedList', false, null);
        }

        function insertTable() {
            const tableHTML = '<table class="table table-responsive table-bordered" border="1"><tr><td>Przykład</td><td>Tabela</td></tr></table>';
            document.execCommand('insertHTML', false, tableHTML);
        }

        function insertImage(event) {
            const file = event.target.files[0];
            uploadImage(file); // Dodaj to
            const reader = new FileReader();
            reader.onload = function (e) {
                const imgHTML = `<div class="resizable"><img src="${e.target.result}" alt="Uploaded Image"></div>`;
                document.execCommand('insertHTML', false, imgHTML);
                setupResizableImages();
            };
            reader.readAsDataURL(file);
        }

        function setupResizableImages() {
    const images = document.querySelectorAll('#editor .resizable img');
    images.forEach(img => {
        img.addEventListener('click', function() {
            clearHandles();
            addResizeHandles(this.parentElement);
        });
    });
}

function changeFontSize(action) {
    let editor = document.getElementById('editor');
    let selection = window.getSelection();
    let range = selection.getRangeAt(0);
    let span = document.createElement('span');

    // Sprawdzanie czy zaznaczony tekst jest już w elemencie <span>
    if (range.commonAncestorContainer.parentNode.nodeName === 'SPAN') {
        span = range.commonAncestorContainer.parentNode;
    } else {
        range.surroundContents(span);
    }

    // Pobieranie aktualnego rozmiaru czcionki
    let currentSize = window.getComputedStyle(span, null).getPropertyValue('font-size');
    let newSize = parseFloat(currentSize);

    // Zmiana rozmiaru czcionki w zależności od wybranej akcji
    if (action === 'increase') {
        newSize *= 1.1;  // Zwiększenie o 10%
    } else if (action === 'decrease') {
        newSize /= 1.1;  // Zmniejszenie o 10%
    }

    span.style.fontSize = newSize + 'px';

    // Deselect the range (optional)
    selection.removeAllRanges();
}

        function clearHandles() {
            const existingHandles = document.querySelectorAll('.resizable-handle');
            existingHandles.forEach(handle => handle.remove());
        }

        function addResizeHandles(container) {
            const neHandle = document.createElement('div');
            const seHandle = document.createElement('div');

            neHandle.className = 'resizable-handle ne';
            seHandle.className = 'resizable-handle se';

            neHandle.addEventListener('mousedown', startResizeNE);
            seHandle.addEventListener('mousedown', startResizeSE);

            container.appendChild(neHandle);
            container.appendChild(seHandle);
        }

        function startResizeNE(e) {
            e.preventDefault();
            const container = e.target.parentElement;
            const img = container.querySelector('img');
            const initialX = e.clientX;
            const initialWidth = img.offsetWidth;

            function resize(e) {
                const deltaX = e.clientX - initialX;
                img.style.width = (initialWidth + deltaX) + 'px';
            }

            function stopResize() {
                document.removeEventListener('mousemove', resize);
                document.removeEventListener('mouseup', stopResize);
            }

            document.addEventListener('mousemove', resize);
            document.addEventListener('mouseup', stopResize);
        }

        function startResizeSE(e) {
            e.preventDefault();
            const container = e.target.parentElement;
            const img = container.querySelector('img');
            const initialX = e.clientX;
            const initialWidth = img.offsetWidth;

            function resize(e) {
                const deltaX = e.clientX - initialX;
                img.style.width = (initialWidth + deltaX) + 'px';
                img.style.height = 'auto'; 
            }

            function stopResize() {
                document.removeEventListener('mousemove', resize);
                document.removeEventListener('mouseup', stopResize);
            }

            document.addEventListener('mousemove', resize);
            document.addEventListener('mouseup', stopResize);
        }

        document.getElementById('editor').addEventListener('click', function(e) {
    if (e.target.tagName.toLowerCase() !== 'img') {
        clearHandles();
    }
});


function uploadImage(file) {
    let formData = new FormData();
    formData.append('image', file);
    
    fetch('/upload-image', { // Zakładam, że '/upload-image' to endpoint na twoim serwerze obsługujący upload obrazka
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        if (data.success && data.url) {
            // Zaktualizuj URL obrazka w edytorze na podstawie odpowiedzi z serwera
            let imgElements = document.querySelectorAll('#editor img[src="' + file.name + '"]');
            imgElements.forEach(img => {
                img.src = data.url;
            });
        }
    })
    .catch(error => {
        console.error('Wystąpił błąd podczas uploadu obrazka:', error);
    });
}



function handleFormSubmit(e) {
    e.preventDefault();
    const editorContent = document.getElementById('editor').innerHTML;
    alert(editorContent); // Usunąłem .value, ponieważ .innerHTML zwraca stringa, więc nie potrzebujesz .value
    document.getElementById('editor_content').value = editorContent;
    e.target.submit();
}

const form = document.getElementById('addPost');
if (form) {
    form.addEventListener('submit', handleFormSubmit);
} else {
    console.error('Formularz nie został znaleziony!');
}


    </script>

</x-app-layout>