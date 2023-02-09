@extends('layouts.main', [
    'title' => 'Сброс пароля',
])

@section('content')
    <div class="row d-flex justify-content-center mt-5 mb-7">
        <div class="col-4">
            <x-page-title title="Сбросить пароль"></x-page-title>

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="post" action="{{ route('password.email') }}">
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

                    <div class="col-12 d-grid gap-2">
                        <button type="submit" class="btn btn-primary py-2">Отправить ссылку для сброса пароля</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
