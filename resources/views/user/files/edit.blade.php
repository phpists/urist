@extends('layouts.user_app')
@section('title', 'Редагування файлу')
@section('page')
    <section class="page-section">
        <div class="container page-section__container">
            <header class="page-section__header">
                <div class="page-section__descr">
                    <a href="{{ url()->previous() }}" class="button button--outline page-section__back-button" aria-label="Back" data-tooltip="Назад">
                        <svg class="button__icon" width="10" height="19">
                            <use xlink:href="{{asset('assets/img/user/sprite.svg#arrow-left')}}"></use>
                        </svg>
                    </a>
                    <div class="page-section__info">
                        <h1 class="page-title page-section__title">{{ $file->name }}</h1>
                        <a class="blue-link page-section__link" href="{{ $file->criminalArticle?->court_decision_link ?? '#' }}" target="_blank">Посилання на рішення </a>
                    </div>
                </div>
            </header>

            <form id="editForm" action="{{ route('file.update', ['file_id' => $file->id]) }}" method="POST">
                @csrf
                @method('PUT')


                <div class="tabs page-section__tabs" data-tabs="tabs-1" data-active="0">
                    <ul class="tabs__nav">
                        <li class="tabs__nav-item">
                            <button class="button button--outline tabs__nav-btn" type="button">Назва ПП</button>
                        </li>
                        <li class="tabs__nav-item">
                            <button class="button button--outline tabs__nav-btn" type="button">ПП</button>
                        </li>
                        <li class="tabs__nav-item">
                            <button class="button button--outline tabs__nav-btn" type="button">Стаття КК</button>
                        </li>
                    </ul>
                </div>
                <div class="tabs-content page-section__tabs-content" data-tabs-content="tabs-1">
                    <div class="tabs-panel">
                        <div class="page-section__editor">
                            <textarea id="textEditor" name="nazva_pp">{{ $file->nazva_pp }}</textarea>
                        </div>
                    </div>
                    <div class="tabs-panel">
                        <div class="page-section__editor">
                            <textarea id="textEditor1" name="pp">{{ $file->pp }}</textarea>
                        </div>
                    </div>
                    <div class="tabs-panel">
                        <div class="page-section__editor">
                            <textarea id="textEditor2" name="statya_kk">{{ $file->statya_kk }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="page-section__buttons">
                    <button class="button page-section__button" type="submit">Зберегти</button>
                    <button class="button button--outline page-section__button" type="button">Экспорт у Word
                        <svg class="button__icon" width="28" height="28">
                            <use xlink:href="{{asset('assets/img/user/sprite.svg#word')}}"></use>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('scripts_footer')
    <script src="https://cdn.ckeditor.com/4.8.0/full-all/ckeditor.js"></script>
    <script src="{{ asset('user/ckeditor/document-config.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            CKEDITOR.replace( 'textEditor', CKEditorDocumentConfig );
            CKEDITOR.replace( 'textEditor1', CKEditorDocumentConfig );
            CKEDITOR.replace( 'textEditor2', CKEditorDocumentConfig );

            // var KTCkeditor = function () {
            //     // Private functions
            //     var demos = function () {
            //         ClassicEditor
            //             .create( document.querySelector( '#textEditor' ) )
            //             .catch( error => {
            //                 console.error( error );
            //             } );
            //     }
            //
            //     return {
            //         // public functions
            //         init: function() {
            //             demos();
            //         }
            //     };
            // }();
            // KTCkeditor.init();
            $("#createFileFolder").select2({
                placeholder: "Виберіть папку",
                ajax: makeSelect2AjaxSearch('/folders/search_file_folders', 'createFileFolder')
            })
        })

        $(document).on('submit', '#editForm', function (e) {
            e.preventDefault();

            let form = this;

            $.ajax({
                type: form.method,
                url: form.action,
                data: $(form).serialize(),
                dataType: 'json',
                success: function (response) {
                    throwSuccessToaster(response.message);
                },
                error: function (jqXHR) {
                    throwErrorToaster(jqXHR?.responseJSON?.message ?? 'Не вдалось обробити запит')
                }
            })
        })
    </script>

@endsection
