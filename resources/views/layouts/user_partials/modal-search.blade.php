<div class="modal" id="modal-search">
    <div class="modal__inner">
        <div class="modal__window">
            <button class="modal__close" aria-label="Close modal" data-modal-close="data-modal-close" type="button">
                <svg class="modal__close-icon" width="23" height="22">
                    <use xlink:href="{{asset('assets/img/user/sprite.svg#close-modal')}}"></use>
                </svg>
            </button>
            <form class="search modal__search" id="modal-search-form" autocomplete="off" action="{{ route('user.articles.search') }}" novalidate="novalidate">
                <div class="search__group">
                    <input class="input search__input" id="inputModalSearch" type="text" name="search" placeholder="Пошук по збірнику" autocomplete="off" required="required" data-url="{{ route('user.search.items') }}"/>
                    <div class="searchItemsContainer"></div>

                    <button type="submit" class="search__button">
                        <svg class="search__icon" width="21" height="21">
                            <use xlink:href="{{asset('assets/img/user/sprite.svg#search')}}"></use>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
