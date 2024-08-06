@props(['post'])
<x-post_templates.post_wrapper :post="$post">
    <div class="post__main">
        <div class="post-photo__image-wrapper">
            <img src="{{asset($post->img)}}" alt="Фото от пользователя" width="760" height="396">
        </div>
    </div>
</x-post_templates.post_wrapper>
