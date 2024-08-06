@props(['user'])
@if (auth()->user()->id != $user->id)
<div class="post-details__user-buttons user__buttons">
    @if ($user->isSubscribedBy(auth()->user()))
    <a class="user__button user__button--subscription button button--main" href="/users/{{ $user->id }}/unsubscribe">Отписаться</a>
    @else
        <a class="user__button user__button--subscription button button--main" href="/users/{{ $user->id }}/subscribe">Подписаться</a>
    @endif
        <a class="user__button user__button--writing button button--green" href="/messages/{{ $user->id }}">Сообщение</a>
</div>
@endif
