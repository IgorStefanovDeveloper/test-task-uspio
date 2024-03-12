<?php

namespace App\Helpers;

class  GoogleMap
{
    private string $apiKey;

    const GOOGLE_API_PATH = 'https://maps.googleapis.com/maps/api/';

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function getAddressSuggestions(string $input)
    {
        $url = $this::GOOGLE_API_PATH . 'place/autocomplete/json?input=' . urlencode($input) . '&key=' . $this->apiKey;

        $json = file_get_contents($url);
        $data = json_decode($json, true);

        // Парсинг полученных данных
        $addressSuggestions = [];
        foreach ($data['predictions'] as $prediction) {
            $addressSuggestions[] = $prediction['description'];
        }

        return $addressSuggestions;
    }

    public function getStaticMap($address, string $width = '400', $height = '400')
    {
        return $this::GOOGLE_API_PATH . 'staticmap?center=' . urlencode($address) . '&size=' . $width . 'x ' . $height . '&zoom=15&key=' . $this->apiKey;
    }
}
