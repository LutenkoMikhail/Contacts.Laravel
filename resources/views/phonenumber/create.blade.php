@extends('layouts.base')

@section('title', 'Главная')

@section('main')
    <form action="{{route ('phonenumber.store',request()->route()->parameters)}}" method="post"
          enctype="multipart/form-data">
        @csrf

        <div class="form-group row">
            <label for="phone_number" class="col-md-4 col-form-label text-md-right">{{ __('Телефон') }}</label>
            <div class="col-md-6">
                <input id="phone_number" type="text" pattern="^\+?[\s\-\(\)0-9]{10,14}$"
                       class="form-control @error('phone_number') is-invalid @enderror"
                       name="phone_number" value="{{ old('phone_number') }}" minlength="10" maxlength="14"
                       placeholder="телефон" required autocomplete="phone number" autofocus>
                @error('phone_number')
                <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                @enderror
            </div>
        </div>

        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary">Создать</button>
        </div>
    </form>

    <div class="col-md-12">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
    </div>

@endsection('main')

