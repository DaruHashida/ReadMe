<x-post_form_components.form-section-layout title="Форма добавления видео" action="/posts/create/video">
                <div class="adding-post__input-wrapper form__input-wrapper">
                    <label class="adding-post__label form__label" for="video-url">Ссылка youtube <span class="form__input-required">*</span></label>
                    <div class="form__input-section">
                        <input class="adding-post__input form__input" id="video-url" type="text" name="video" placeholder="Введите ссылку">
                        <x-post_form_components.substring_error name="video" title="Ссылка youtube"></x-post_form_components.substring_error>
                    </div>
                </div>
</x-post_form_components.form-section-layout>

