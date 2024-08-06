<x-layout--common>
<x-slot:heading>
    readme: регистрация
</x-slot:heading>
    @php
    $mass = [
            'name' => 'Логин',
            'email' => 'Email',
            'password' => 'Пароль',
            'file' =>'Аватар',
            'password_confirmation'=> 'Повтор пароля',
        ];
    @endphp

    <main class="page__main page__main--registration">
      <div class="container">
        <h1 class="page__title page__title--registration">Регистрация</h1>
      </div>
      <section class="registration container">
        <h2 class="visually-hidden">Форма регистрации</h2>
        <form class="registration__form form" action="/register" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form__text-inputs-wrapper">
            <div class="form__text-inputs">
              <div class="registration__input-wrapper form__input-wrapper">
                <label class="registration__label form__label" for="registration-email">Электронная почта <span class="form__input-required">*</span></label>
                <div class="form__input-section">
                  <input class="registration__input form__input" id="registration-email" type="email" name="email" placeholder="Укажите эл.почту">
                    @error('email')
                    <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                  <div>
                    <h3 style="color: red;">Email</h3>
                    <p style="color: red;">{{$message}}</p>
                  </div>
                    @enderror
                </div>
              </div>
              <div class="registration__input-wrapper form__input-wrapper">
                <label class="registration__label form__label" for="registration-login">Логин <span class="form__input-required">*</span></label>
                <div class="form__input-section">
                  <input class="registration__input form__input" id="registration-login" type="text" name="name"
                         placeholder="Укажите логин">
                    @error('name')
                    <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                  <div>
                    <h3 style="color: red;">Логин</h3>
                    <p style="color: red;">{{$message}}</p>
                  </div>
                    @enderror
                </div>
              </div>
              <div class="registration__input-wrapper form__input-wrapper">
                <label class="registration__label form__label" for="registration-password">Пароль<span class="form__input-required">*</span></label>
                <div class="form__input-section">
                  <input class="registration__input form__input" id="registration-password" type="password" name="password" placeholder="Придумайте пароль">
                    @error('password')
                    <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                  <div>
                    <h3 style="color: red;">Пароль</h3>
                    <p style="color: red;">{{$message}}</p>
                  </div>
                    @enderror
                </div>
              </div>
              <div class="registration__input-wrapper form__input-wrapper">
                <label class="registration__label form__label" for="registration-password-repeat">Повтор пароля<span class="form__input-required">*</span></label>
                <div class="form__input-section">
                  <input class="registration__input form__input" id="registration-password-repeat" type="password" name="password_confirmation" placeholder="Повторите пароль">
                    @error('password_confirmation')
                    <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                    <div>
                    <h3 style="color: red;">Повтор пароля</h3>
                    <p style="color: red;">{{$message}}</p>
                  </div>
                    @enderror
                </div>
              </div>
            </div>
              @if(!empty($errors->all()))
            <div class="form__invalid-block">
              <b class="form__invalid-slogan">Пожалуйста, исправьте следующие ошибки:</b>
                <ul class="form__invalid-list">
                  @foreach($errors->getMessages() as $key=>$message)
                      <li class="form__invalid-item">{{$mass[$key]}}. {{$message[0]}}</li>
                  @endforeach
              </ul>
            </div>
              @endif
          </div>
          <div class="registration__input-file-container form__input-container form__input-container--file">
            <div class="registration__input-file-wrapper form__input-file-wrapper">
              <div class="registration__file-zone form__file-zone dropzone">
                <input class="registration__input-file form__input-file" id="userpic-file" type="file" name="file" title=" ">
                <div class="form__file-zone-text">
                  <span>Перетащите фото сюда</span>
                </div>
              </div>
              <button class="registration__input-file-button form__input-file-button button" type="button">
                <span>Выбрать фото</span>
                <svg class="registration__attach-icon form__attach-icon" width="10" height="20">
                  <use xlink:href="#icon-attach"></use>
                </svg>
              </button>
            </div>
            <div class="registration__file form__file dropzone-previews">

            </div>
          </div>
          <button class="registration__submit button button--main" type="submit">Отправить</button>
        </form>
      </section>
    </main>

    <script src={{asset('../libs/dropzone.js')}}></script>
    <script src={{asset('../js/dropzone-settings.js')}}></script>
</x-layout--common>
