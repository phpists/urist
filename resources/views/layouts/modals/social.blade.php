<div class="modal" id="modal-social">
    <div class="modal__inner">
        <div class="modal__window">
            <button class="modal__close" aria-label="Close modal" data-modal-close="data-modal-close" type="button">
                <svg class="modal__close-icon" width="23" height="22">
                    <use xlink:href="{{ asset('assets/img/sprite.svg#close-modal') }}"></use>
                </svg>
            </button>
            <div class="modal__content">
                <input type="hidden" name="share_url" value="{{ get_setting_value_by_name(\App\Enums\SettingEnum::SHARE_URL) }}">
                <input type="hidden" name="share_text" value="{{ get_setting_value_by_name(\App\Enums\SettingEnum::SHARE_TEXT) }}">
                <input type="hidden" name="share_source" value="{{ config('app.name') }}">
                <div class="uSocial-Share" style="display: block;">
                    <div
                        class="uscl-bar uscl-round-rect uscl-style1 uscl-default uscl-absolute uscl-horizontal uscl-size48 uscl-eachCounter0 uscl-counter0 uscl-mobile_position_right">
                        <div class="uscl-list" style="display: block">
                            <a class="uscl-item" href="javascript:;" onclick="shareSocial.call(this)"
                               data-href="https://www.facebook.com/sharer.php?u={share_url}&t={share_text}">
                                <span data-item="fb" title="Поділитись в Facebook"
                                      class="ico_uscl_soc ico_uscl ico_uscl-fb uscl-fb"></span></a>
                            <a class="uscl-item" href="javascript:;" onclick="shareSocial.call(this)"
                               data-href="https://twitter.com/share?url={share_url}&text={share_text}">
                                <span data-item="twi" title="Поділитись в Twitter"
                                      class="ico_uscl_soc ico_uscl ico_uscl-twi uscl-twi"></span>
                            </a>
                            <a class="uscl-item" href="javascript:;" onclick="shareSocial.call(this)"
                               data-href="viber://forward?text={share_url}">
                                <span data-item="vi" title="Поділитись в Viber"
                                      class="ico_uscl_soc ico_uscl ico_uscl-vi uscl-vi"></span></a>
                            <a class="uscl-item" href="javascript:;" onclick="shareSocial.call(this)"
                               data-href="https://wa.me/?text={share_url}">
                                <span data-item="wa" title="Поділитись в WhatsApp"
                                      class="ico_uscl_soc ico_uscl ico_uscl-wa uscl-wa"></span>
                            </a>
                            <a class="uscl-item" href="javascript:;" onclick="shareSocial()"
                               data-href="http://www.linkedin.com/shareArticle?mini=true&url={share_url}&title={share_text}&summary=&source={share_source}">
                                <span data-item="lin" title="Поділитись в LinkedIn"
                                      class="ico_uscl_soc ico_uscl ico_uscl-lin uscl-lin"></span>
                            </a>
                            <a class="uscl-item" href="javascript:;" onclick="shareSocial()"
                               data-href="https://t.me/share/url?url={share_url}&text={share_text}">
                                <span data-item="telegram" title="Поділитись в Telegram"
                                      class="ico_uscl_soc ico_uscl ico_uscl-telegram uscl-telegram"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    function shareSocial() {
        const shareUrl = document.querySelector('input[name="share_url"]').value,
            shareText = document.querySelector('input[name="share_text"]').value,
            shareSource = document.querySelector('input[name="share_source"]').value;
        let url = this.dataset.href;

        url = url.replace('{share_url}', shareUrl);
        url = url.replace('{share_text}', shareText);
        url = url.replace('{share_source}', shareSource);

        window.open(url, '_blank')
    }
</script>
