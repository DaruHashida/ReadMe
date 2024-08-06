@props(['title','action'])
<section class="adding-post__video tabs__content tabs__content--active">
    <h2 class="visually-hidden">{{$title}}</h2>
    <form class="adding-post__form form" action="{{$action}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form__text-inputs-wrapper">
            <div class="form__text-inputs">
                <div class="adding-post__input-wrapper form__input-wrapper">
                    <label class="adding-post__label form__label" for="video-heading">Заголовок <span class="form__input-required">*</span></label>
                    <div class="form__input-section">
                        <input class="adding-post__input form__input" id="video-heading" type="text" name="title" placeholder="Введите заголовок">
                        <x-post_form_components.substring_error name="title" title="Заголовок"></x-post_form_components.substring_error>
                    </div>
                </div>
                {{$slot}}
                <div class="adding-post__input-wrapper form__input-wrapper">
                    <label class="adding-post__label form__label" for="hashtags">Теги</label>
                    <div class="form__input-section">
                        <input class="adding-post__input form__input" id="hashtags" type="text" name="hashtags" placeholder="Введите теги">
                        <x-post_form_components.substring_error name="hashtags" title="Теги"></x-post_form_components.substring_error>
                    </div>
                </div>
            </div>
            <x-post_form_components.form-invalid-block></x-post_form_components.form-invalid-block>
        </div>
        @if(\Illuminate\Support\Facades\Request::is('posts/create/photo'))
            <div class="adding-post__input-file-container form__input-container form__input-container--file">
                <div class="adding-post__input-file-wrapper form__input-file-wrapper">
                    <div class="adding-post__file-zone adding-post__file-zone--photo form__file-zone dropzone">
                        <input class="adding-post__input-file form__input-file" id="userpic-file-photo" type="file" name="image" title=" ">
                        <div class="form__file-zone-text">
                            <span>Перетащите фото сюда</span>
                        </div>
                    </div>
                    <button class="adding-post__input-file-button form__input-file-button form__input-file-button--photo button" type="button">
                        <span>Выбрать фото</span>
                        <svg class="adding-post__attach-icon form__attach-icon" width="10" height="20">
                            <use xlink:href="#icon-attach"></use>
                        </svg>
                    </button>
                </div>
                <div class="adding-post__file adding-post__file--photo form__file dropzone-previews">

                </div>
            </div>
        @endif
            <div class="adding-post__buttons">
                <button class="adding-post__submit button button--main" type="submit">Опубликовать</button>
                <a class="adding-post__close" href="#">Закрыть</a>
            </div>
    </form>
</section>
