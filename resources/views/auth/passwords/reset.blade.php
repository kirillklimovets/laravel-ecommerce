@extends('layouts.main', [
    'title' => 'Смена пароля',
])

@section('content')
    <div class="row d-flex justify-content-center mt-5 mb-7">
        <div class="col-8">
            <x-page-title title="Сменить пароль"></x-page-title>

            <form method="post" action="{{ route('password.update') }}">
                <div class="row">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="col-12 mb-4">
                        <label for="email" class="form-label">Ваш Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                               required placeholder="Email" name="email" autofocus value="{{ $email ?? old('email') }}">
                        @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-6 mb-4">
                        <label for="password" class="form-label">Новый пароль</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                               id="password" required placeholder="Новый пароль" name="password">
                        @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-6 mb-4">
                        <label for="passwordConfirmation" class="form-label">Повтор пароля</label>
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                               id="passwordConfirmation" required placeholder="Новый пароль еще раз"
                               name="password_confirmation">
                        @error('password_confirmation')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-12 d-grid gap-2">
                        <button type="submit" class="btn btn-primary py-2">Сменить пароль</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
