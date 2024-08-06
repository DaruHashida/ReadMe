<x-layout--common>
    <x-slot:heading>
        readme: публикация
    </x-slot:heading>
    <main class="page__main page__main--publication">
      <div class="container">
        <h1 class="page__title page__title--publication">{{$post->title}}</h1>
        <section class="post-details">
          <h2 class="visually-hidden">Фото</h2>
          <div class="post-details__wrapper post-photo">
            <div class="post-details__main-block post post--details">
                @if($post->img)
                <div class="post-details__image-wrapper post-photo__image-wrapper">
                    <img src={{asset($post->img)}} alt="Фото от пользователя" width="760" height="507">
                </div>
                @endif
                @if($post->video)
                        <div class="post__main">
                            <a href="{{$post->video}}" title="Перейти по ссылке"> {{$post->video}} </a>
                        </div>
                @endif
                @if($post->content)
                            <p>
                                {{$post->content}}
                            </p>
                @endif
                @if($post->quote_author)
                        <div class="post__main">
                            <blockquote>
                                <p>
                                    {{$post->content}}
                                </p>
                                <cite>{{$post->quote_author}}</cite>
                            </blockquote>
                        </div>
                @endif
                @if($post->link)
                        <div class="post__main">
                            <div class="post-link__wrapper">
                                <a class="post-link__external" href="{{$post->link}}" title="Перейти по ссылке">
                                    <div class="post-link__icon-wrapper">
                                        <img src="{{asset($post->img)}}" alt="Иконка">
                                    </div>
                                    <div class="post-link__info">
                                        <h3>{{$post->title}}</h3>
                                        <span>{{$post->link}}</span>
                                    </div>
                                    <svg class="post-link__arrow" width="11" height="16">
                                        <use xlink:href="#icon-arrow-right-ad"></use>
                                    </svg>
                                </a>
                            </div>
                        </div>
                @endif
              <div class="post__indicators">
                <div class="post__buttons">
                    @if (\Illuminate\Support\Facades\Auth::user()->hasLiked($post))
                       <a class="post__indicator post__indicator--likes button" href="/posts/{{$post->id}}/unlike" title="Лайк">
                      <svg class="post__indicator-icon post__indicator-icon--like-active" width="20" height="17">
                          <use xlink:href="#icon-heart-active"></use>
                      </svg>
                      @else
                          <a class="post__indicator post__indicator--likes button" href="/posts/{{$post->id}}/like" title="Лайк">
                          <svg class="post__indicator-icon" width="20" height="17">
                              <use xlink:href="#icon-heart"></use>
                          </svg>
                     @endif
                    <span>{{$post->likesCount()}}</span>
                    <span class="visually-hidden">количество лайков</span>
                  </a>
                  <a class="post__indicator post__indicator--comments button" href="№" title="Комментарии">
                    <svg class="post__indicator-icon" width="19" height="17">
                      <use xlink:href="#icon-comment"></use>
                    </svg>
                    <span>{{$post->commentsCount()}}</span>
                    <span class="visually-hidden">количество комментариев</span>
                  </a>
                  <a class="post__indicator post__indicator--repost button" href="/posts/{{$post->id}}/repost" title="Репост">
                    <svg class="post__indicator-icon" width="19" height="17">
                      <use xlink:href="#icon-repost"></use>
                    </svg>
                    <span>{{$post->repostsCount()}}</span>
                    <span class="visually-hidden">количество репостов</span>
                  </a>
                </div>
                <span class="post__view">500 просмотров</span>
              </div>
              <div class="comments">
                <form class="comments__form form" action="/posts/{{$post->id}}/comment" method="post">
                    @csrf
                  <div class="comments__my-avatar">
                    <img class="comments__picture" src="{{asset(auth()->user()->avatar)}}" alt="Аватар пользователя">
                  </div>
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    @if(!empty($errors->all()))
                    <div class="form__input-section form__input-section--error">
                        @endif
                    <textarea class="comments__textarea form__textarea form__input" name="content"
                              placeholder="Ваш комментарий"></textarea>
                    <label class="visually-hidden">Ваш комментарий</label>
                      @if(!empty($errors->all()))
                      <button class="form__error-button button" type="button">!</button>
                    <div class="form__error-text">
                        @foreach($errors->all() as $error)
                      <h3 class="form__error-title">Ошибка валидации</h3>
                      <p class="form__error-desc">{{$error}}</p>
                    </div>
                        @endforeach
                  </div>
                      @endif
                  <button class="comments__submit button button--green" type="submit">Отправить</button>
                </form>
                <div class="comments__list-wrapper">
                  <ul class="comments__list">
                      @foreach($post->comments as $comment):
                    <li class="comments__item user">
                      <div class="comments__avatar">
                        <a class="user__avatar-link" href="/users/{{$comment->user->id}}">
                          <img class="comments__picture" src="{{asset($comment->user->avatar)}}" alt="Аватар пользователя">
                        </a>
                      </div>
                      <div class="comments__info">
                        <div class="comments__name-wrapper">
                          <a class="comments__user-name" href="/users/{{$comment->user->id}}">
                            <span>{{$comment->user->name}}</span>
                          </a>
                          <time class="comments__time" datetime="{{$comment->created_at->toIso8601String()}}">{{$comment->commentRelativeTime()}}</time>
                        </div>
                        <p class="comments__text">
                          {{$comment->content}}
                        </p>
                      </div>
                    </li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
            <div class="post-details__user user">
              <div class="post-details__user-info user__info">
                <div class="post-details__avatar user__avatar">
                  <a class="post-details__avatar-link user__avatar-link" href="#">
                    <img class="post-details__picture user__picture" src="{{asset($post->user->avatar)}}" alt="Аватар пользователя">
                  </a>
                </div>
                <div class="post-details__name-wrapper user__name-wrapper">
                  <a class="post-details__name user__name" href="/users/{{$post->user->id}}">
                    <span>{{$post->user->name}}</span>
                  </a>
                  <time class="post-details__time user__time" datetime="{{ $post->user->created_at->toIso8601String() }}">{{$post->user->userRelativeTime()}}</time>
                </div>
              </div>
              <div class="post-details__rating user__rating">
                <p class="post-details__rating-item user__rating-item user__rating-item--subscribers">
                  <span class="post-details__rating-amount user__rating-amount">{{$post->user->followers_count}}</span>
                  <span class="post-details__rating-text user__rating-text">подписчиков</span>
                </p>
                <p class="post-details__rating-item user__rating-item user__rating-item--publications">
                  <span class="post-details__rating-amount user__rating-amount">{{$post->user->posts_count}}</span>
                  <span class="post-details__rating-text user__rating-text">публикаций</span>
                </p>
              </div>
              <x-post_view.interact_buttons :user="$post->user"></x-post_view.interact_buttons>
            </div>
          </div>
        </section>
      </div>
    </main>
</x-layout--common>
