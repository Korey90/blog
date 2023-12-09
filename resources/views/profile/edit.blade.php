<x-app-layout>
    <x-slot name="header">
    <div class="container">
    <h2 class="display-4">
        {{ __('Profile Settings') }}
    </h2>

    <div class="py-4">
        <div class="container-fluid">
            <div class="d-flex flex-column">
                <div class="">
                    <div class="card mb-4">
                        <div class="card-body">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>
                </div>

                <div class="">
                    <div class="card mb-4">
                        <div class="card-body">
                            @include('profile.partials.upload-avatar')
                        </div>
                    </div>
                </div>

                <div class="">
                    <div class="card mb-4">
                        <div class="card-body">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                </div>

                <div class="">
                    <div class="card">
                        <div class="card-body">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
