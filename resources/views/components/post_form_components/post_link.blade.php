<x-post_form_components.form-section-layout title="Форма добавления ссылки" action="/posts/create/link">
<div class="adding-post__textarea-wrapper form__input-wrapper">
    <label class="adding-post__label form__label" for="post-link">Ссылка <span class="form__input-required">*</span></label>
    <div class="form__input-section">
        <input class="adding-post__input form__input" id="post-link" type="text" name="link">
        <x-post_form_components.substring_error name="link" title="Ссылка"></x-post_form_components.substring_error>
    </div>
</div>
</x-post_form_components.form-section-layout>
