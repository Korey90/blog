<x-app-layout>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Blog Name -->
                        <div class="mb-3">
                            <label for="blog_name" class="form-label">{{ __('Blog Name') }}</label>
                            <input id="blog_name" type="text" class="form-control" name="blog_name" value="{{ old('blog_name') }}" required autofocus>
                            <x-input-error :messages="$errors->get('blog_name')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email') }}</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control" name="password" required>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <a class="text-sm text-gray-600" href="{{ route('login') }}">{{ __('Already registered?') }}</a>
                            <button type="submit" class="btn btn-primary">{{ __('Register') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
