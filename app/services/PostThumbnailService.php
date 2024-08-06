<?php


namespace App\services;
use App\Http\Requests\LinkRequest;
use Illuminate\Support\Facades\Http;
use App\Models\Post;

class PostThumbnailService
{
    private $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.thumbnail.api_key');
    }

    /**
     * @param  $image_url
     * @return mixed
     */
    public function getPostThumbnail($image_url)
    {
        $url = 'https://www.thumbnail.ws/api/'.$this->apiKey.'/thumbnail/get';
        $response = Http::withoutVerifying()->get(
            $url, [
            'url' => $image_url,
            'width' => 760,
            'height' => 396,
            ]
        );
        return $response->getBody()->getContents();
    }
}
