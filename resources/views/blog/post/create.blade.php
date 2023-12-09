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
                        <h2 class="display-4 lead mb-4">Posts:</h2>
                        <a href="{{ url()->previous() }}" class="btn btn-outline-primary"><i class="fas fa-arrow-alt-circle-left"></i> Back</a>
                    </div>
                    <hr class="w-75 py-4"/>
                    <form id="addPost" action="{{ route('post.store') }}" method="POST" class="">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="blog_id" value="{{ $blog_id }}">
                        <div class="mb-4">
                            <label class="form-label" for="title">
                                Title
                            </label>
                            <input class="form-control" id="title" type="text" name="title" placeholder="Post title" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="editor_content">
                                Content
                            </label>
                            <input type="text" name="content" id="editor_content" style="display: none;" value="">

                            <div>
                                <button type="button" class="btn btn-outline-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tooltip on bottom1" onclick="format('bold')"><i class="fas fa-bold"></i></button>
                                <button type="button" class="btn btn-outline-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tooltip on bottom2" onclick="format('underline')"><i class="fas fa-underline"></i></button>
                                <button type="button" class="btn btn-outline-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tooltip on bottom3" onclick="format('italic')"><i class="fas fa-italic"></i></button>
                                <button type="button" class="btn btn-outline-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tooltip on bottom4" onclick="format('justifyLeft')"><i class="fas fa-align-left"></i></button>
                                <button type="button" class="btn btn-outline-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tooltip on bottom5" onclick="format('justifyCenter')"><i class="fas fa-align-center"></i></button>
                                <button type="button" class="btn btn-outline-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tooltip on bottom6" onclick="format('justifyRight')"><i class="fas fa-align-right"></i></button>
                                <button type="button" class="btn btn-outline-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tooltip on bottom7" onclick="insertList('unordered')"><i class="fas fa-list-ul"></i></button>
                                <button type="button" class="btn btn-outline-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tooltip on bottom8" onclick="insertTable()"><i class="fas fa-table"></i></button>
                                <input type="file" id="file" name="file" class="file-input" onchange="insertImage(event)" />
                                <label for="file" class="custom-file-label btn btn-outline-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Image upload">
                                    <i class="far fa-image"></i>
                                </label>
                                <button type="button" class="btn btn-outline-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tooltip on bottom10" onclick="changeFontSize('increase')" alt="increse font"><i class="fas fa-long-arrow-alt-up" ></i></button>
                                <button type="button" class="btn btn-outline-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tooltip on bottom11" onclick="changeFontSize('decrease')" alt="decrese font"><i class="fas fa-long-arrow-alt-down"></i></button>
                            </div>

                            <div id="editor" contenteditable="true" class="text-wrap p-2"></div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="author">
                                Author
                            </label>
                            <input class="form-control " id="author" type="text" name="author" placeholder="Author" value="{{ Auth::user()->name }}" readonly required>
                        </div>
                        <div class="mb-4">
                            <label for="created_at" class="form-label">
                                Data utworzenia
                            </label>
                            <input class="form-control" id="created_at" type="date" name="created_at" required>
                        </div>
                        <div class="mb-2" id="tags-container">
                            <label class="form-label" for="tags">
                                Tags
                            </label>
                            <div class="border d-flex flex-wrap bg-light p-2">
                                <p class="fs-5 w-100 mb-0">Existing tags:</p>
                                @forelse (App\Models\Tag::get() as $tag)
                                    <div class="form-check d-flex m-2">
                                        <input type="checkbox" class="form-check-input" name="tags[]" id="tag{{ $tag->id }}" value="{{ $tag->name }}">
                                        <label class="form-check-label" for="tag{{ $tag->id }}">{{ $tag->name }}</label>
                                    </div>
                                @empty

                                @endforelse
                            </div>
                            <input class="form-control my-2" id="tags" type="text" name="tags[]">
                        </div>

                        <div class="d-flex items-center justify-content-between p-2">
                            <button type="button" id="add-tag" class="btn btn-outline-dark"><i class="fas fa-hashtag"></i> Add another tag</button>
                            <button class="btn btn-outline-primary" type="submit">Dodaj post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        document.getElementById('created_at').valueAsDate = new Date();

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
            uploadImage(file);
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

            if (range.commonAncestorContainer.parentNode.nodeName === 'SPAN') {
                span = range.commonAncestorContainer.parentNode;
            } else {
                range.surroundContents(span);
            }

            let currentSize = window.getComputedStyle(span, null).getPropertyValue('font-size');
            let newSize = parseFloat(currentSize);

            if (action === 'increase') {
                newSize *= 1.1;
            } else if (action === 'decrease') {
                newSize /= 1.1;
            }

            span.style.fontSize = newSize + 'px';

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

    fetch('/upload-image', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }
    })
    .then(response => response.json())
    .then(data => {
    if (data.success && data.url) {
        // Tworzenie elementu obrazka z możliwością zmiany rozmiaru
        const resizableDiv = document.createElement('div');
        resizableDiv.className = 'resizable';

        const img = document.createElement('img');
        img.src = data.url;
        img.alt = 'Uploaded Image';

        resizableDiv.appendChild(img);
        addResizeHandles(resizableDiv);

        // Dodanie obrazka do edytora
        const editor = document.getElementById('editor');
        editor.appendChild(resizableDiv);
    }
})

    .catch(error => {
        console.error('Wystąpił błąd podczas uploadu obrazka:', error);
    });
}


        function handleFormSubmit(e) {
            e.preventDefault();
            const editorContent = document.getElementById('editor').innerHTML;
            alert(editorContent);
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