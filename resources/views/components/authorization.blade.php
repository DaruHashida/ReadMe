@props(['errors'])
<section class="authorization">
    <h2 class="visually-hidden">Авторизация</h2>
    <form class="authorization__form form" action="/login" method="post">
        @csrf
        <div class="authorization__input-wrapper form__input-wrapper">
            <div class="form__input-section">
                <input class="authorization__input authorization__input--login form__input" type="text" name="email" placeholder="email">
                <svg class="form__input-icon" width="19" height="18">
                    <use xlink:href="#icon-input-user"></use>
                </svg>
                <label class="visually-hidden">Email</label>
            </div>
            @error('email')
            <span style="color: red;">{{$message}}</span>
            @enderror
        </div>
        <div class="authorization__input-wrapper form__input-wrapper">
            <div class="form__input-section">
                <input class="authorization__input authorization__input--password form__input" type="password" name="password" placeholder="Пароль">
                <svg class="form__input-icon" width="16" height="20">
                    <use xlink:href="#icon-input-password"></use>
                </svg>
                <label class="visually-hidden">Пароль</label>
            </div>
            @error('password')
            <span style="color: red;">{{$message}}</span>
            @enderror
        </div>
        <button class="authorization__submit button button--main" type="submit">Войти</button>
    </form>
</section>
