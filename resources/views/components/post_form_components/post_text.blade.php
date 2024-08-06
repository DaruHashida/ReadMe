<x-post_form_components.form-section-layout title="Форма добавления фото" action="/posts/create/text">
                <div class="adding-post__textarea-wrapper form__textarea-wrapper">
                    <label class="adding-post__label form__label" for="post-text">Текст поста <span class="form__input-required">*</span></label>
                    <div class="form__input-section">
                        <textarea class="adding-post__textarea form__textarea form__input" id="post-text" name="content" placeholder="Введите текст публикации"></textarea>
                        <x-post_form_components.substring_error name="content" title="Текст поста"></x-post_form_components.substring_error>
                    </div>
                </div>
</x-post_form_components.form-section-layout>
