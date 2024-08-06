<x-layout--common>
<x-slot:heading>
    @if ($user->id == auth()->user()->id)
    readme: мой профиль
    @else
    readme: профиль пользователя {{$user->name}}
    @endif
</x-slot:heading>
    <main class="page__main page__main--profile">
      <h1 class="visually-hidden">Профиль</h1>
      <div class="profile profile--default">
        <div class="profile__user-wrapper">
          <div class="profile__user user container">
            <div class="profile__user-info user__info">
              <div class="profile__avatar user__avatar">
                <img class="profile__picture user__picture" src="{{asset($user->avatar)}}" alt="Аватар пользователя">
              </div>
              <div class="profile__name-wrapper user__name-wrapper">
                <span class="profile__name user__name">{{$user->name}}</span>
                <time class="profile__user-time user__time" datetime="{{ $user->created_at->toIso8601String() }}">
                    {{$timeLabel}}</time>
              </div>
            </div>
            <div class="profile__rating user__rating">
              <p class="profile__rating-item user__rating-item user__rating-item--publications">
                <span class="user__rating-amount">{{$user->posts_count}}</span>
                <span class="profile__rating-text user__rating-text">публикаций</span>
              </p>
              <p class="profile__rating-item user__rating-item user__rating-item--subscribers">
                <span class="user__rating-amount">{{$user->followers_count}}</span>
                <span class="profile__rating-text user__rating-text">подписчиков</span>
              </p>
            </div>
            <x-profile_components.user_interact_buttons :user="$user">
            </x-profile_components.user_interact_buttons>
          </div>
        </div>
        <div class="profile__tabs-wrapper tabs">
          <div class="container">
            <div class="profile__tabs filters">
              <b class="profile__tabs-caption filters__caption">Показать:</b>
              <ul class="profile__tabs-list filters__list tabs__list">
                <li class="profile__tabs-item filters__item">
                  <a class="profile__tabs-link filters__button filters__button--active tabs__item tabs__item--active button">Посты</a>
                </li>
                <li class="profile__tabs-item filters__item">
                  <a class="profile__tabs-link filters__button tabs__item button" href="#">Лайки</a>
                </li>
                <li class="profile__tabs-item filters__item">
                  <a class="profile__tabs-link filters__button tabs__item button" href="#">Подписки</a>
                </li>
              </ul>
            </div>
            <div class="profile__tab-content">
              <section class="profile__posts tabs__content tabs__content--active">
                <h2 class="visually-hidden">Публикации</h2>
                  <x-block_of_posts :posts="$user->posts"></x-block_of_posts>
              </section>
            </div>
          </div>
        </div>
      </div>
    </main>
</x-layout--common>
