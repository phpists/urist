<div class="modal modal--small" id="modal-create">
    <div class="modal__inner">
        <div class="modal__window">
            <button class="modal__close" aria-label="Close modal" data-modal-close="data-modal-close" type="button">
                <svg class="modal__close-icon" width="23" height="22">
                    <use xlink:href="{{asset('assets/img/user/sprite.svg#close-modal')}}"></use>
                </svg>
            </button>
            <h3 class="modal__title">Створити папку</h3>
            <form action="{{ route('folders.store') }}" method="POST" class="form modal__form" id="create-form" autocomplete="off" novalidate="novalidate">
                @csrf
                <input type="hidden" name="folder_type" value="{{ $folder_type }}">
                @if(isset($folder_id))
                    <input type="hidden" name="parent_id" value="{{ $folder_id }}">
                @endif
                <div class="form__group">
                    <input class="input form__input" id="inputCreateFolderTitle" type="text" name="name" placeholder="Введіть назву папки" autocomplete="off" required="required"/>
                </div>
                <div class="form__buttons-group form__buttons-group--center">
                    <button type="submit" class="button form__button modal__button">Додати</button>
                </div>
            </form>
        </div>
    </div>
</div>
