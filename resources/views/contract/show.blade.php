@extends('layouts.base')

@section('title', 'Главная')

@section('main')
    <h6 class="my-3 text-center"><a href="{{ route('contact.edit', ['contact' => $contact]) }}">Редактировать
            контакт</a></h6>
    <h6 class="my-3 text-center"><a href="{{ route('contact.delete', ['contact' => $contact]) }}">Удалить контакт</a>
    </h6>

    <h2>
        Фамилия:{{$contact->surname}}
    </h2>
    <h2>
        Имя:{{$contact->name}}
    </h2>
    <h2>
        Почта:{{$contact->email}}
    </h2>
    <h2>
        Дата рождения:{{$contact->birthday}}
    </h2>
    <h4>
        Количество телефонов:{{$contact->phoneNumber->count()}}
    </h4>
    <a href="{{ route('phonenumber.create',  $contact->id) }}">Добавить телефон</a>
    @if ($contact->phoneNumber->count() > 0)
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Телефон</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            @if(!$contact->phoneNumber->isEmpty())

                @foreach($contact->phoneNumber as $phoneNumber)
                    <tr>
                        <td>{{ $phoneNumber->phone_number}}</td>
                        <td>
                            <a href="{{ route('phonenumber.edit', $phoneNumber->id) }}">Редактировать</a>
                        </td>
                        <td>
                            <a href="{{ route('phonenumber.delete', $phoneNumber->id) }}">Удалить</a>
                        </td>
                    </tr>
        @endforeach
    @endif
    @endif

@endsection('main')

