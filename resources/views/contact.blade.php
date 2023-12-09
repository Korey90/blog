<x-app-layout>

    <div class="container">

    <h2 class="text-center display-4 fw-lighter my-5">Get in touch</h2>
    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
    <form id="contact-form" action="{{ route('contact.store') }}" method="post">
        @csrf
        @method('POST')
        <div class="mb-3">
            <label for="name" class="form-label">Your Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="tel" class="form-control" id="phone" name="phone">
        </div>
        <div class="mb-3">
            <label for="message" class="form-label">Your Message</label>
            <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary" name="status" value="unread">Post</button>
    </form>


    </div>

</x-app-layout>
