@props(['user'])
<section class="profile__likes tabs__content">
    @foreach ($user->likes as $like)
    <h2 class="visually-hidden">Лайки</h2>
    <ul class="profile__likes-list">
        <li class="post-mini post-mini--{{$like->post->contentType->title}} post user">
            <div class="post-mini__user-info user__info">
                <div class="post-mini__avatar user__avatar">
                    <a class="user__avatar-link" href="/user/{{$like->user->id}}">
                        <img class="post-mini__picture user__picture" src="{{asset($like->user->avatar)}}" alt="Аватар пользователя">
                    </a>
                </div>
                <div class="post-mini__name-wrapper user__name-wrapper">
                    <a class="post-mini__name user__name" href="#">
                        <span>{{$like->user->name}}</span>
                    </a>
                    <div class="post-mini__action">
                        <span class="post-mini__activity user__additional">Лайкнул вашу публикацию</span>
                        <time class="post-mini__time user__additional" datetime="{{ $like->created_at->toIso8601String() }}">{{$like->likeRelativeTime()}}</time>
                    </div>
                </div>
            </div>
            <div class="post-mini__preview">
                <a class="post-mini__link" href="/posts/{{$like->post->id}}" title="Перейти на публикацию">
                    <div class="post-mini__image-wrapper">
                        <img class="post-mini__image" src="{{asset($like->post->img)}}" width="109" height="109" alt="Превью публикации">
                    </div>
                    <span class="visually-hidden">Фото</span>
                </a>
            </div>
        </li>
        @endforeach
    </ul>
</section>
