<x-layout--common>
    <x-slot:heading>
    readme: добавление публикации
    </x-slot:heading>
    <main class="page__main page__main--adding-post">
      <div class="page__main-section">
        <div class="container">
          <h1 class="page__title page__title--adding-post">Добавить публикацию</h1>
        </div>
        <div class="adding-post container">
          <div class="adding-post__tabs-wrapper tabs">
            <div class="adding-post__tabs filters">
              <ul class="adding-post__tabs-list filters__list tabs__list">
                  <x-post_form_components.form-filters-button title="Фото" name="photo">
                      <svg class="filters__icon" width="22" height="18">
                          <use xlink:href="#icon-filter-photo"></use>
                      </svg>
                  </x-post_form_components.form-filters-button>
                  <x-post_form_components.form-filters-button title="Видео" name="video">
                      <svg class="filters__icon" width="24" height="16">
                          <use xlink:href="#icon-filter-video"></use>
                      </svg>
                  </x-post_form_components.form-filters-button>
                  <x-post_form_components.form-filters-button title="Текст" name="text">
                      <svg class="filters__icon" width="20" height="21">
                          <use xlink:href="#icon-filter-text"></use>
                      </svg>
                  </x-post_form_components.form-filters-button>
                  <x-post_form_components.form-filters-button title="Цитата" name="quote">
                      <svg class="filters__icon" width="21" height="20">
                          <use xlink:href="#icon-filter-quote"></use>
                      </svg>
                  </x-post_form_components.form-filters-button>
                  <x-post_form_components.form-filters-button title="Ссылка" name="link">
                      <svg class="filters__icon" width="21" height="18">
                          <use xlink:href="#icon-filter-link"></use>
                      </svg>
                  </x-post_form_components.form-filters-button>
              </ul>
            </div>
            <div class="adding-post__tab-content">
                @if (\Illuminate\Support\Facades\Request::is('posts/create/photo'))
                    @include('components.post_form_components.post_photo')
                @elseif (\Illuminate\Support\Facades\Request::is('posts/create/video'))
                    @include('components.post_form_components.post_video')
                @elseif (\Illuminate\Support\Facades\Request::is('posts/create/text'))
                    @include('components.post_form_components.post_text')
                @elseif (\Illuminate\Support\Facades\Request::is('posts/create/quote'))
                    @include('components.post_form_components.post_quote')
                @elseif (\Illuminate\Support\Facades\Request::is('posts/create/link'))
                    @include('components.post_form_components.post_link')
                @endif
            </div>
          </div>
        </div>
      </div>
    </main>
</x-layout--common>
