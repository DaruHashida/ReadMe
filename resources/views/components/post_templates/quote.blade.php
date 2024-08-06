@props(['post','article'=>''])
<x-post_templates.post_wrapper :post="$post" article={{$article}}>
    <div class="post__main">
        <blockquote>
            <p>
                {{$post->content}}
            </p>
            <cite>{{$post->quote_author}}</cite>
        </blockquote>
    </div>
</x-post_templates.post_wrapper>
