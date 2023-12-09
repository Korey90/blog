<x-app-layout>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                    </div>

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password">
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">{{ __('Confirm') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
