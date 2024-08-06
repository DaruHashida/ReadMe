@props(['post'])
<x-post_templates.post_wrapper :post="$post">
<div class="post__main">
    <p>
         {{$post->content}}
    </p>
</div>
</x-post_templates.post_wrapper>
