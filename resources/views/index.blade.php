@extends('layouts.base')

@section('title', 'Главная')

@section('main')
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            const getSort = ({ target }) => {
                const order = (target.dataset.order = -(target.dataset.order || -1));
                const index = [...target.parentNode.cells].indexOf(target);
                const collator = new Intl.Collator(['en', 'ru'], { numeric: true });
                const comparator = (index, order) => (a, b) => order * collator.compare(
                    a.children[index].innerHTML,
                    b.children[index].innerHTML
                );

                for(const tBody of target.closest('table').tBodies)
                    tBody.append(...[...tBody.rows].sort(comparator(index, order)));

                for(const cell of target.parentNode.cells)
                    cell.classList.toggle('sorted', cell === target);
            };

            document.querySelectorAll('.table_sort thead').forEach(tableTH => tableTH.addEventListener('click', () => getSort(event)));

        });
    </script>
    <style>
        .table_sort table {
            border-collapse: collapse;
        }

        .table_sort th {
            color: #ffebcd;
            background: #008b8b;
            cursor: pointer;
        }

        .table_sort td,
        .table_sort th {
            width: 150px;
            height: 40px;
            text-align: center;
            border: 2px solid #846868;
        }

        .table_sort tbody tr:nth-child(even) {
            background: #e3e3e3;
        }

        th.sorted[data-order="1"],
        th.sorted[data-order="-1"] {
            position: relative;
        }

        th.sorted[data-order="1"]::after,
        th.sorted[data-order="-1"]::after {
            right: 8px;
            position: absolute;
        }

        th.sorted[data-order="-1"]::after {
            content: "▼"
        }

        th.sorted[data-order="1"]::after {
            content: "▲"
        }
    </style>
    @if (count($contacts) > 0)
{{--        <table class="table table-striped" id="sortable">--}}
            <table class="table_sort">
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
                    <td><h2>{{ $contact->name }}</h2></td>
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

{{--        <div class="d-flex justify-content-center">--}}
{{--            {!!$contacts->links() !!}--}}
{{--        </div>--}}
    @else
        <div class="text-center">
            <h2>
                <p> Пусто !</p>
            </h2>
        </div>

    @endif

@endsection('main')
