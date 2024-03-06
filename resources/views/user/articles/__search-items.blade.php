@foreach($items as $item)
    <a href="{{ route('user.articles.show', $item) }}">{{ $item->name }}</a>
@endforeach
