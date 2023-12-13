function makeSelect2AjaxSearch(url, element_id) {
    return {
        url: url,
        data: function (params) {
            var query = {
                search_string: params.term
            }
            // Query parameters will be ?search=[term]&type=public
            return query;
        },
        processResults: function (data) {
            data = data.map((el) => {
                return {
                    id: el.id,
                    text: el.name
                }
            })
            return {
                results: data
            };
        }
    }
}
