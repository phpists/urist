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

            <form action="{{ route('file.update', ['file_id' => $file->id]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="page-section__editor">
                    <textarea id="textEditor" name="content">{{ $file->content }}</textarea>
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
    <script src="{{ asset('super_admin/plugins/custom/ckeditor/ckeditor-classic.bundle.js') }} "></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var KTCkeditor = function () {
                // Private functions
                var demos = function () {
                    ClassicEditor
                        .create( document.querySelector( '#textEditor' ) )
                        .catch( error => {
                            console.error( error );
                        } );
                }

                return {
                    // public functions
                    init: function() {
                        demos();
                    }
                };
            }();
            KTCkeditor.init();
            $("#createFileFolder").select2({
                placeholder: "Виберіть папку",
                ajax: makeSelect2AjaxSearch('/folders/search_file_folders', 'createFileFolder')
            })
        })
    </script>

@endsection
