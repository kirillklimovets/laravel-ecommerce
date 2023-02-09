@extends('layouts.main', [
    'title' => 'Регистрация',
])

@section('content')
    <div class="row d-flex justify-content-center mt-5 mb-7">
        <div class="col-12 col-md-8">
            <h1 class="mb-4">Регистрация</h1>
            <form method="post" action="{{ route('register') }}">
                <div class="row">
                    @csrf
                    <div class="col-12 col-md-6 mb-4">
                        <label for="name" class="form-label">Ваше имя</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" required
                               placeholder="Имя" name="name" value="{{ old('name') }}" autofocus>
                        @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-12 col-md-6 mb-4">
                        <label for="email" class="form-label">Ваш Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                               required
                               placeholder="Email" name="email" value="{{ old('email') }}" autofocus>
                        @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-12 col-md-6 mb-4">
                        <label for="password" class="form-label">Ваш пароль</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                               id="password" required
                               placeholder="Пароль" name="password" value="{{ old('password') }}">
                        @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-12 col-md-6 mb-4">
                        <label for="passwordConfirmation" class="form-label">Повтор пароля</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                               id="passwordConfirmation" required
                               placeholder="Пароль еще раз" name="password_confirmation"
                               value="{{ old('password_confirmation') }}">
                        @error('password_confirmation')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-12 mb-3 d-grid gap-2">
                        <button type="submit" class="btn btn-primary py-2">Зарегистрироваться</button>
                    </div>

                    <div class="col-12 mb-2">
                        <p class="text-muted">Регистрируясь, вы соглашаетесь с
                            <a target="_blank" href="{{ route('information.index').'#privacy-policy' }}"
                               class="text-decoration-none">политикой конфиденциальности</a>.
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
