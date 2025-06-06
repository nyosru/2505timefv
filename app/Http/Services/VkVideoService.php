<?php

namespace App\Http\Services;

use GuzzleHttp\Client;
use Psr\Log\LoggerInterface;


class VkVideoService
{
    protected string $accessToken;
    protected string $apiVersion;
    protected Client $httpClient;
    protected LoggerInterface $logger;

    /**
     * VkVideoService constructor.
     *
     * @param string $accessToken Токен доступа к VK API
     * @param string $apiVersion Версия VK API (например, 5.131)
//     * @param LoggerInterface $logger Логгер для записи ошибок (опционально)
     */
    public function __construct(string $accessToken, string $apiVersion = '5.131', LoggerInterface $logger = null)
    {
        $this->accessToken = $accessToken;
        $this->apiVersion = $apiVersion;
        $this->httpClient = new Client(['base_uri' => 'https://api.vk.com/method/']);
//        $this->logger = $logger;
    }

    /**
     * Получить информацию о видео по идентификатору
     *
     * @param string $videoId Формат: "owner_id_video_id" (например: "-123456_78901234")
     * @return array|null Массив с данными видео или null при ошибке
     */
    public function getVideoInfo(string $videoId): ?array
    {
        try {
            $response = $this->httpClient->get('video.get', [
                'query' => [
                    'videos' => $videoId,
                    'access_token' => $this->accessToken,
                    'v' => $this->apiVersion,
                ],
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            if (isset($data['response']['items'][0])) {
                return $data['response']['items'][0];
            }

            if (isset($data['error'])) {
                $this->logError($data['error']);
            }

        } catch (\Exception $e) {
            $this->logError(['error_msg' => $e->getMessage()]);
        }

        return null;
    }

    /**
     * Получить URL превью видео (большое или маленькое)
     *
     * @param string $videoId
     * @return string|null
     */
    public function getVideoPreviewUrl(string $videoId): ?string
    {
        $videoInfo = $this->getVideoInfo($videoId);

        if (!$videoInfo) {
            return null;
        }

        return $videoInfo['image_big'] ?? $videoInfo['image'] ?? null;
    }

    public function parsingVideoUrl(string $url): ?array
    {
        $result = [
            'data' => [],
            'status' => false
        ];
//        $url = 'https://vkvideo.ru/video-226002974_456239694';

        if (preg_match('/video-(\d+)_(\d+)/', $url, $matches)) {
            $numberAfterDash = $matches[1];  // 226002974
            $numberAfterUnderscore = $matches[2]; // 456239694
//            echo "Номер после дефиса: $numberAfterDash\n";
//            echo "Номер после подчёркивания: $numberAfterUnderscore\n";
            $result['data'] = [ 'k1' => $numberAfterDash, 'k2' => $numberAfterUnderscore];
        } else {
            $result['error'] = 'Не удалось распарсить строку';
        }

        return $result;
    }

    /**
     * Получить URL плеера видео ВК
     *
     * @param string $videoId
     * @return string|null
     */
    public function getVideoPlayerUrl(string $videoId): ?string
    {
        $videoInfo = $this->getVideoInfo($videoId);

        if (!$videoInfo) {
            return null;
        }

        return $videoInfo['player'] ?? null;
    }

    /**
     * Логирование ошибок, если передан логгер
     *
     * @param array $error
     * @return void
     */
    protected function logError(array $error): void
    {
//        if ($this->logger) {
//            $message = $error['error_msg'] ?? json_encode($error);
//            $this->logger->error('VK API Error: ' . $message);
//        }
    }
}