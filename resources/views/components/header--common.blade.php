@props(['topbar'])
<header class="header">
    <div class="header__wrapper container">
        <div class="header__logo-wrapper">
            <a class="header__logo-link" href="/">
                <img class="header__logo" src={{asset('../img/logo.svg')}} alt="Логотип readme" width="128" height="24">
            </a>
            <p class="header__topic">
                micro blogging
            </p>
        </div>
        @auth
        <form class="header__search-form form" action="/search" method="get">
            <div class="header__search">
                <label class="visually-hidden">Поиск</label>
                <input class="header__search-input form__input" type="search" name="q">
                <button class="header__search-button button" type="submit">
                    <svg class="header__search-icon" width="18" height="18">
                        <use xlink:href="#icon-search"></use>
                    </svg>
                    <span class="visually-hidden">Начать поиск</span>
                </button>
            </div>
        </form>
        @endauth
        <div class="header__nav-wrapper">
            <nav class="header__nav">
                @auth
                <ul class="header__my-nav">
                    <li class="header__my-page header__my-page--popular">
                        <a class="header__page-link" href="/popular" title="Популярный контент">
                            <span class="visually-hidden">Популярный контент</span>
                        </a>
                    </li>
                    <li class="header__my-page header__my-page--feed">
                        <a class="header__page-link" href="/" title="Моя лента">
                            <span class="visually-hidden">Моя лента</span>
                        </a>
                    </li>
                    <li class="header__my-page header__my-page--messages">
                        <a class="header__page-link" href="/messages" title="Личные сообщения">
                            <span class="visually-hidden">Личные сообщения</span>
                        </a>
                    </li>
                </ul>
                    <ul class="header__user-nav">
                        <li class="header__profile">
                            <a class="header__profile-link" href="#">
                                <div class="header__avatar-wrapper">
                                    <img class="header__profile-avatar" src="{{asset(auth()->user()->avatar)}}" alt="Аватар профиля">
                                </div>
                                <div class="header__profile-name">
                                    <span>{{auth()->user()->name}}</span>
                                    <svg class="header__link-arrow" width="10" height="6">
                                        <use xlink:href="#icon-arrow-right-ad"></use>
                                    </svg>
                                </div>
                            </a>
                            <div class="header__tooltip-wrapper">
                                <div class="header__profile-tooltip">
                                    <ul class="header__profile-nav">
                                        <li class="header__profile-nav-item">
                                            <a class="header__profile-nav-link" href="/users/{{auth()->id()}}">
                          <span class="header__profile-nav-text">
                            Мой профиль
                          </span>
                                            </a>
                                        </li>
                                        <li class="header__profile-nav-item">
                                            <a class="header__profile-nav-link" href="/messages">
                          <span class="header__profile-nav-text">
                            Сообщения
                          </span>
                                            </a>
                                        </li>
                                        <li class="header__profile-nav-item">
                                            <a class="header__profile-nav-link" href="#">
                          <span class="header__profile-nav-text">
                            Настройки
                          </span>
                                            </a>
                                        </li>
                                        <li class="header__profile-nav-item">
                                            <a class="header__profile-nav-link" href="/logout">
                          <span class="header__profile-nav-text">
                            Выход
                          </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
{{--                        Выводим элемент только в том случае, если мы не на странице с постами--}}
                        @if(!\Illuminate\Support\Facades\Route::currentRouteNamed('posts.create'))
                        <li>
                            <a class="header__post-button button button--transparent" href="/posts/create/photo">Пост</a>
                        </li>
                        @endif
                    </ul>
                @endauth
                    @guest
                        <ul class="header__user-nav">
                            <li class="header__authorization">
                                <a class="header__user-button header__authorization-button button" href="/">Вход</a>
                            </li>
                            <li>
                                <a class="header__user-button header__user-button--active header__register-button button">Регистрация</a>
                            </li>
                        </ul>
                    @endguest
            </nav>
        </div>
    </div>
</header>
