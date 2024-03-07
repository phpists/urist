@extends('layouts.user_app')
@section('title', 'Реєстр')
@section('styles')
    <style>
        a.non-draggable, svg.non-draggable, img.non-draggable {
            -webkit-user-drag: none;
            user-select: none;
        }
    </style>
@endsection
@section('page')

    <section class="collection-section">
        <div class="container collection-section__container">
            <h1 class="page-title profile-section__title">Реєстр</h1>
            <table class="collection-table collection-table--auto">
                <thead class="collection-table__thead">
                <tr>
                    <th>Номер</th>
                    <th>Назва та посилання на реєстр</th>
                </tr>
                </thead>
                <tbody class="collection-table__tbody">
                @php($firstRowOnThisPage = $registries->currentPage() * $registries->perPage() - $registries->perPage() + 1)
                @foreach($registries as $registry)
                    <tr>
                    <td>#{{ $firstRowOnThisPage + $loop->index }}</td>
                    <td>
                        <h4 class="collection-table__title">{{ $registry->title }}</h4>
                        <a class="blue-link collection-table__link" href="{{ $registry->link }}" target="_blank">Посилання на реєстр</a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>

            {!! $registries->links('vendor.pagination.urist') !!}
        </div>
    </section>

@endsection

@section('scripts_footer')
    <script type="module">
    </script>
@endsection
