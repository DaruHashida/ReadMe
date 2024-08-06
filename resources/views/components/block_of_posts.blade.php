@props(['posts'])
@foreach ($posts as $post)
    @if ($post->contentType->title == 'photo')
        <x-post_templates.photo :post="$post" article="post-photo"></x-post_templates.photo>
    @endif
    @if ($post->contentType->title == 'text')
        <x-post_templates.text :post="$post" article="post-text"></x-post_templates.text>
    @endif
    @if ($post->contentType->title == 'quote')
        <x-post_templates.quote :post="$post" article="post-quote"></x-post_templates.quote>
    @endif
    @if ($post->contentType->title == 'link')
        <x-post_templates.link :post="$post" article="post-link"></x-post_templates.link>
    @endif
    @if ($post->contentType->title == 'video')
        <x-post_templates.video :post="$post" article="post-video"></x-post_templates.video>
    @endif
@endforeach
