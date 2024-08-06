<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;

class DownloadableImage implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Если ссылка пуста, пропускаем проверку
        if (empty($value)) {
            return true;
        }

        $content = file_get_contents($value);

        // Ошибка при скачивании файла
        if ($content === false) {
            return false;
        }

        // Файл пустой
        if (empty($content)) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'URL-адрес изображения должен быть доступен для загрузки.';
    }
}
