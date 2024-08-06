<x-post_form_components.form-section-layout title="Форма добавления фото" action="/posts/create/photo">
                <div class="adding-post__input-wrapper form__input-wrapper">
                    <label class="adding-post__label form__label" for="image_url">Ссылка из интернета</label>
                    <div class="form__input-section">
                        <input class="adding-post__input form__input" id="image_url" type="text" name="image_url" placeholder="Введите ссылку">
                        <x-post_form_components.substring_error name="image_url" title="Ссылка на изображение"></x-post_form_components.substring_error>
                    </div>
                </div>
</x-post_form_components.form-section-layout>
