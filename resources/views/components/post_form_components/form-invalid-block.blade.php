@php
    //Тексты заголовков сообщений об ошибках
    $mass = [
            'title' => 'Заголовок',
            'hashtags' => 'Теги',
            'content' => 'Текст',
            'image' => 'Изображение',
            'image-url' =>'Ссылка на изображение',
            'video' =>'Ссылка youtube',
            'quote_author'=>'Автор',
            'link'=>'Ссылка',
        ];
@endphp

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
