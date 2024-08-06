<x-post_form_components.form-section-layout title="Форма добавления цитаты" action="/posts/create/quote">
                <div class="adding-post__input-wrapper form__textarea-wrapper">
                    <label class="adding-post__label form__label" for="cite-text">Текст цитаты <span class="form__input-required">*</span></label>
                    <div class="form__input-section">
                          <textarea class="adding-post__textarea adding-post__textarea--quote form__textarea form__input" id="cite-text" name="content"
                                    placeholder="Текст цитаты"></textarea>
                        <x-post_form_components.substring_error name="content" title="Текст цитаты"></x-post_form_components.substring_error>
                    </div>
                </div>
                <div class="adding-post__textarea-wrapper form__input-wrapper">
                    <label class="adding-post__label form__label" for="quote-author">Автор <span class="form__input-required">*</span></label>
                    <div class="form__input-section">
                        <input class="adding-post__input form__input" id="quote-author" type="text" name="quote_author">
                        <x-post_form_components.substring_error name="quote_author" title="Автор"></x-post_form_components.substring_error>
                    </div>
                </div>
</x-post_form_components.form-section-layout>
