<?php

namespace HasanovJ\Currency;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class HttpClient
{
    private static $responseStorage = null;

    const API_URL = 'https://api.nbrb.by/exrates/rates';

    const REQUEST_METHOD = 'GET';

    public static function getResponse(string $onDate = null, int $periodicity = 0) : array
    {
        if (self::$responseStorage != NULL) {
            return self::$responseStorage;
        }

        $client = new Client();

        $request = new Request(self::REQUEST_METHOD, self::API_URL);

        $response = $client->send($request, [
            'query' => [
                'onDate' => $onDate ?? date('Y-m-d'),
                'periodicity' => $periodicity,
            ]
        ]);

        if ($response->getStatusCode() != 200) {
            throw new \Exception(sprintf("Something is going wrong. API request gives %s instead of 200",
                $response->getStatusCode()));
        }

        return self::$responseStorage = json_decode($response->getBody()->getContents(), true);
    }
}