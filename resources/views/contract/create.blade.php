@extends('layouts.base')

@section('title', 'Главная')

@section('main')
    <form action="{{route ('contact.store')}}" method="post"
          enctype="multipart/form-data">
        @csrf

        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Имя') }}</label>
            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                       name="name" value="{{ old('name') }}" minlength="5" maxlength="50"
                       placeholder="имя" required autocomplete="имя" autofocus>
                @error('name')
                <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                @enderror
            </div>
        </div>


        <div class="form-group row">
            <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Фамилия') }}</label>
            <div class="col-md-6">
                <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror"
                       name="surname" value="{{ old('surname') }}" minlength="5" maxlength="50"
                       placeholder="фамилия" autocomplete="фамилия" autofocus>
                @error('surname')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="email"
                   class="col-md-4 col-form-label text-md-right">{{ __('Почта') }}</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                       placeholder="почта"    name="email" value="{{ old('email') }}" required autocomplete="почта">

                @error('email')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="birthday"
                   class="col-md-4 col-form-label text-md-right">{{ __('Дата рождения') }}</label>

            <div class="col-md-6">
                <input id="birthday" type="date"
                       class="form-control @error('birthday') is-invalid @enderror" name="birthday"
                       value="{{date_create( old('birthday'))->Format('Y-m-d')}}" required
                       autocomplete="birthday" autofocus>

                @error('birthday')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="phone_number" class="col-md-4 col-form-label text-md-right">{{ __('Телефон') }}</label>
            <div class="col-md-6">
                <input id="phone_number" type="text" pattern="^((\+?3)?8)?0\d{9}$"
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

