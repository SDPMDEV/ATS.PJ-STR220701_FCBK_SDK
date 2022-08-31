<?php

namespace Meta\FacebookSDK;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use Meta\FacebookSDK\Exception\FacebookException;

class Facebook
{
    private const FB_BASE_URI = "https://graph.facebook.com/";

    public FacebookHelper $helper;

    public function __construct(string $app_id = '', string $app_secret = '')
    {
        $this->setHelper(new FacebookHelper($app_id, $app_secret));
    }

    /**
     * @param FacebookHelper $helper
     */
    private function setHelper(FacebookHelper $helper): void
    {
        $this->helper = $helper;
    }

    public function user(string $access_token): FacebookUser
    {
        return new FacebookUser($access_token);
    }

    public function getLongLivedToken(string $token)
    {
        try {
            $data = [
                'client_id' => $this->helper->getAppId(),
                'grant_type' => 'fb_exchange_token',
                'client_secret' => $this->helper->getAppSecret(),
                'fb_exchange_token' => $token
            ];

            $client = new Client(['base_uri' => self::FB_BASE_URI]);
            $response = $client->request('GET', "/oauth/access_token?".http_build_query($data), [
                'Accept' => 'application/json'
            ]);

            return json_decode($response->getBody());
        } catch(ClientException $exception) {
            throw new FacebookException($exception->getResponse()->getBody(), $exception->getCode());
        }
    }
}