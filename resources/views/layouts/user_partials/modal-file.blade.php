<div class="modal modal--small" id="modal-file">
    <div class="modal__inner">
        <div class="modal__window">
            <button class="modal__close" aria-label="Close modal" data-modal-close="data-modal-close" type="button">
                <svg class="modal__close-icon" width="23" height="22">
                    <use xlink:href="{{asset('assets/img/user/sprite.svg#close-modal')}}"></use>
                </svg>
            </button>
            <h3 class="modal__title">Редагування файлу</h3>
            <form action="{{ route('files.store') }}" method="POST" class="form modal__form" id="file-form" autocomplete="off" novalidate="novalidate">
                @csrf
                <input type="hidden" name="criminal_article_id">
                <div class="form__group">
                    <input class="input form__input" id="inputFileTitle" type="text" name="name" placeholder="Введіть вашу назву пропозиції" autocomplete="off" required="required"/>
                </div>
                <div class="form__group">
                    <select class="select" id="selectFileFolder" name="folder_id" aria-label="Виберіть папку" required="required">
                        <option value="0">Без додавання папки</option>
                        @foreach(auth()->user()->allFolders as $folder)
                            <option value="{{ $folder->id }}">{{ $folder->getParentBreadcrumbs() }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form__buttons-group form__buttons-group--center">
                    <button class="button form__button modal__button">Додати</button>
                </div>
            </form>
        </div>
    </div>
</div>
