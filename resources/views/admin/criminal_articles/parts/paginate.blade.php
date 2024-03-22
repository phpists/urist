@if(method_exists($criminal_articles, 'appends'))
    {{ $criminal_articles->appends(request()->all())->links('vendor.pagination.product_pagination') }}
@endif
