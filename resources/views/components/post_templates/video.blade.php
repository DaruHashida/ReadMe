props(['post'])
<x-post_templates.post_wrapper :post="$post">
    <div class="post__main">
        <div class="post-link__wrapper">
            <a class="post-link__external" href="{{$post->link}}" title="Посмотреть видео">
                <div class="post-link__info">
                    <h3>{{$post->title}}</h3>
                    <span>{{$post->video}}</span>
                </div>
                <svg class="post-link__arrow" width="11" height="16">
                    <use xlink:href="#icon-arrow-right-ad"></use>
                </svg>
            </a>
        </div>
    </div>
</x-post_templates.post_wrapper>
