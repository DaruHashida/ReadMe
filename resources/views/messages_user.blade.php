<x-layout--common>
    <x-slot:heading>
        readme: личные сообщения
    </x-slot:heading>
    <main class="page__main page__main--messages">
        <h1 class="visually-hidden">Личные сообщения</h1>
        <section class="messages tabs">
            <h2 class="visually-hidden">Сообщения</h2>
            <div class="messages__contacts">
                <ul class="messages__contacts-list tabs__list">
                    <li class="messages__contacts-item">
                        <a class="messages__contacts-tab messages__contacts-tab--active tabs__item tabs__item--active" href="#">
                            <div class="messages__avatar-wrapper">
                                <img class="messages__avatar" src="{{asset($user->avatar)}}" alt="Аватар пользователя">
                            </div>
                            <div class="messages__info">
                  <span class="messages__contact-name">
                    {{$user->name}}
                  </span>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="messages__chat">
                <div class="messages__chat-wrapper">
                    <ul class="messages__list tabs__content tabs__content--active">
                        @foreach ($messages as $message)
                        @if ($message->author_id == auth()->id())
                        <li class="messages__item messages__item--my">
                            <div class="messages__info-wrapper">
                                <div class="messages__item-avatar">
                                    <a class="messages__author-link" href="#">
                                        <img class="messages__avatar" src="{{asset(auth()->user()->avatar)}}" alt="Аватар пользователя">
                                    </a>
                                </div>
                                <div class="messages__item-info">
                                    <a class="messages__author" href="/users/{{auth()->id()}}">
                                        {{auth()->user()->name}}
                                    </a>
                                    <time class="messages__time" datetime="{{$message->created_at->toIso8601String()}}">
                                        {{$message->messageRelativeTime()}}
                                    </time>
                                </div>
                            </div>
                            <p class="messages__text">
                                {{$message->content}}
                            </p>
                        </li>
                        @else
                        <li class="messages__item">
                            <div class="messages__info-wrapper">
                                <div class="messages__item-avatar">
                                    <a class="messages__author-link" href="/users/{{$user->id}}">
                                        <img class="messages__avatar" src="{{asset($user->avatar)}}" alt="Аватар пользователя">
                                    </a>
                                </div>
                                <div class="messages__item-info">
                                    <a class="messages__author" href="#">
                                        {{$message->author->name}}
                                    </a>
                                    <time class="messages__time" datetime="2019-05-01T14:39">
                                        {{$message->messageRelativeTime()}}
                                    </time>
                                </div>
                            </div>
                            <p class="messages__text">
                                {{$message->content}}
                            </p>
                        </li>
                    </ul>
                        @endif
                        @endforeach
                </div>
                <div class="comments">
                    <form class="comments__form form" action="/messages/{{$user->id}}" method="post">
                        @csrf
                        <input type="hidden" name="recipient_id" value="{{ $user->id }}">
                        <div class="comments__my-avatar">
                            <img class="comments__picture" src="{{asset(auth()->user()->avatar)}}" alt="Аватар пользователя">
                        </div>
                        <textarea class="comments__textarea form__textarea" placeholder="Ваше сообщение" name="content"></textarea>
                        <label class="visually-hidden">Ваше сообщение</label>
                        <button class="comments__submit button button--green" type="submit">Отправить</button>
                    </form>
                </div>
            </div>
        </section>
    </main>
</x-layout--common>
