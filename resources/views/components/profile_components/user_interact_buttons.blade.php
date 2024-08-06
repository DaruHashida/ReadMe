@props(['user'])
@if (auth()->user()->id != $user->id)
    <div class="profile__user-buttons user__buttons">
    @if ($user->isSubscribedBy(auth()->user()))
        <a class="profile__user-button user__button user__button--subscription button button--main" href="/users/{{ $user->id }}/unsubscribe">Отписаться</a>
    @else
        <a class="profile__user-button user__button user__button--subscription button button--main" href="/users/{{ $user->id }}/subscribe">Подписаться</a>
    @endif
        <a class="profile__user-button user__button user__button--writing button button--green" href="/messages/{{$user->id}}">Сообщение</a>
    </div>
@endif
