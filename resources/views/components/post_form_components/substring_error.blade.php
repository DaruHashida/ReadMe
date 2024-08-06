@props(['name','title'])

@error($name)
<button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
<div class="form__error-text">
    <h3 class="form__error-title">{{$title}}</h3>
    <p class="form__error-desc">{{$message}}</p>
</div>
@enderror
