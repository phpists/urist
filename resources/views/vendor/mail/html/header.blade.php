@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (config('app.logo'))
<img src="{{ asset(config('app.logo')) }}" class="logo" alt="{{ $slot }}">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
