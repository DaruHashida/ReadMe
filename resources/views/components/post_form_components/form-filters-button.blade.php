@props(['title', 'name' => 'no'])
@php
$isActive= false;
if (\Illuminate\Support\Facades\Request::is('posts/create/'.$name))
    {
        $isActive = true;
    }
@endphp

<li class="adding-post__tabs-item filters__item">
    <a class="adding-post__tabs-link filters__button filters__button--{{ $name }} {{ $isActive ? 'filters__button--active' : '' }}" href="/posts/create/{{ $name }}">
        {{ $slot }}
        <span>{{ $title }}</span>
    </a>
</li>
