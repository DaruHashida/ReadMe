@props(['post','article'=>''])
<article class="feed__post post {{$article}}">
<header class="post__header post__author">
        @if($post->repost)
      <a class="post__author-link" href="/users/{{$post->originalAuthor->id}}" title="Автор">
        <div class="post__avatar-wrapper post__avatar-wrapper--repost">
            <img class="post__author-avatar" src="{{asset($post->originalAuthor->avatar)}}" alt="Аватар пользователя">
        </div>
        <div class="post__info">
            <b class="post__author-name">Репост: {{$post->originalAuthor->name}}</b>
            @else
     <a class="post__author-link" href="/users/{{$post->user->id}}" title="Автор">
        <div class="post__avatar-wrapper">
            <img class="post__author-avatar" src="{{asset($post->user->avatar)}}" alt="Аватар пользователя" width="60" height="60">
        </div>
        <div class="post__info">
            <b class="post__author-name">{{$post->user->name}}</b>
            @endif
            <span class="post__time">{{$post->postRelativeTime()}}</span>
        </div>
    </a>
</header>
    <h2><a href="/posts/{{$post->id}}">{{$post->title}}</a></h2>
{{$slot}}
    <ul class="post__tags">
        @foreach($post->hashtags as $tag)
        <li><a href="/search/{{$tag->name}}">#{{$tag->name}}</a></li>
            @endforeach
    </ul>
<footer class="post__footer post__indicators">
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
        <a class="post__indicator post__indicator--comments button" href="#" title="Комментарии">
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
</footer>
</article>
