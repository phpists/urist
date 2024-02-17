const loadMore = () => {

    $(document).on('click', '.collection-descr__more', function (e) {
        let $btn = $(this),
            $btnSpan = $btn.find('span'),
            $parent = $btn.parent(),
            $text = $parent.find('.collection-descr__text p'),
            $hidden = $parent.find('.collection-descr__hidden');

        $hidden.toggleClass('is-visible');
        $btn.toggleClass('is-active');

        if ($btnSpan.text() === 'Читати детальніше') {
            if ($text.text().slice(-3) === '...') {
                $text.html($text.html().slice(0, -3));
            }
            $btnSpan.text('Згорнути');
        } else {
            $text.html($text.html() + '...');
            $btnSpan.text('Читати детальніше');
        }
    })
}

export default loadMore;
