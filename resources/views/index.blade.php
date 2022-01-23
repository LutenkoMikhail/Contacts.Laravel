@extends('layouts.base')

@section('title', 'Главная')

@section('main')
    @if (count($contacts) > 0)
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Имя</th>
                <th>Фамилия</th>
                <th>Почта</th>
                <th>Дата рождения</th>
                <th>Количество номеров</th>
                <th>Дата</th>
                <th>&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($contacts as $contact)
                <tr>
                    <td><h3>{{ $contact->name }}</h3></td>
                    <td>{{ $contact->surname }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->birthday }}</td>
                    <td>{{ $contact->phoneNumber->count() }}</td>
                    <td>{{ $contact->created_at }}</td>
                    <td>
                        <a href="{{ route('contact.show', ['contact' => $contact->id]) }}">Подробнее…</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {!!$contacts->links() !!}
        </div>
    @else
        <div class="text-center">
            <h2>
                <p> Пусто !</p>
            </h2>
        </div>

    @endif

@endsection('main')
