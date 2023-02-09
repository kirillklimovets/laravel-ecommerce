@extends('layouts.main', [
    'title' => 'Вход в аккаунт',
])

@section('content')
    <div class="row d-flex justify-content-center mt-5 mb-7">
        <div class="col-12 col-md-4">
            <h1 class="mb-4">Вход в аккаунт</h1>
            <form method="post" action="{{ route('login') }}">
                <div class="row">
                    @csrf
                    <div class="col-12 mb-4">
                        <label for="email" class="form-label">Ваш Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                               required
                               placeholder="Email" name="email" value="{{ old('email') }}" autofocus>
                        @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-12 mb-4">
                        <label for="password" class="form-label">Ваш пароль</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                               id="password" required
                               placeholder="Пароль" name="password" value="{{ old('password') }}">
                        @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-12 mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember"
                                   id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">Запомнить меня</label>
                        </div>
                    </div>

                    <div class="col-12 d-grid gap-4 text-center">
                        <button type="submit" class="btn btn-primary px-5 py-2 me-2">Войти</button>

                        @if (Route::has('password.request'))
                            <a class="text-decoration-none" href="{{ route('password.request') }}">
                                Забыли пароль?
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
