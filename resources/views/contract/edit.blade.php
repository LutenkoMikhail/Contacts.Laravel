@extends('layouts.base')

@section('title', 'Главная')

@section('main')
    <form action="{{route ('contact.update', $contact)}}" method="post"
          enctype="multipart/form-data">
        @csrf

        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Имя') }}</label>
            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                       name="name" value="{{ $contact->name }}" minlength="5" maxlength="50"
                       placeholder="name" required autocomplete="name" autofocus>
                @error('name')
                <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                @enderror
            </div>
        </div>


        <div class="form-group row">
            <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Фамилия') }}</label>
            <div class="col-md-6">
                <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror"
                       name="surname" value="{{  $contact->surname}}" minlength="5" maxlength="50"
                       placeholder="surname" autocomplete="surname" autofocus>
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
                       name="email" value="{{ $contact->email}}" required autocomplete="email">

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
                       value="{{date_create( $contact->birthday)->Format('Y-m-d')}}" required
                       autocomplete="birthday" autofocus>

                @error('birthday')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>

        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary">Сохранить</button>
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

