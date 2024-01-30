function addToBookmarks(id) {
    $.ajax({
        url: '/favourites',
        method: 'post',
        data: {
            criminal_article_id: id,
        },
        success: () => {

        }
    })
}

function initFolderSelect() {
    let selectBookmarks = document.getElementById('selectBookmarkFolder');

    if (selectBookmarks) {
        selectBookmarks.addEventListener('change', () => {
            $.ajax({
                url: '/folders/search_favourites',
                data: {
                    search_string: selectBookmarks.value
                },
                success: (resp) => {
                    selectBookmarks.innerHTML = "";
                    resp.forEach((el) => {
                        let option = document.createElement('option');
                        option.innerText = el.name;
                        option.id = el.id;
                        selectBookmarks.append(option);
                    })
                }
            })
        })
    }
}

const initCollection = () => {
    document.addEventListener('DOMContentLoaded', () => {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        initFolderSelect();
        document.querySelectorAll('.favouriteBtn').forEach((el) => {
            el.addEventListener('click', function () {
                document.getElementById('storeFavArticleId').value = el.dataset.id;
            })

        });
    })
}

export default initCollection;
