<?php

namespace Firedev\KaizenCSS;

class Client
{
    const CSS_KAIZEN_API_URL = 'http://css.kaizenseo.com.br/api/';
    /**
     * @var \GuzzleHttp\Client
     */
    private $httpClient;

    /**
     * Client constructor.
     */
    public function __construct()
    {
        $this->httpClient = new \GuzzleHttp\Client([
            'base_uri' => self::CSS_KAIZEN_API_URL,
            'timeout'  => 5
        ]);
    }

    /**
     * Padrão para additionalData
     *  [
            [
                'key'        => 'type',
                'title'      => 'Tipo',
                'value'      => 'venda',
                'searchable' => 1
            ]
        ]
     *
     * @param string $name
     * @param string $email
     * @param string $phone
     * @param string $message
     * @param array $additionalData
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     */
    public function registraLead(
        string $name,
        string $email,
        string $phone,
        string $message = "",
        $additionalData = []
    ): void {
        $css_token = null;
        $css_token = (isset($_COOKIE['css_token']) ? $_COOKIE['css_token'] : null);

        if ($css_token == null and isset($_POST['css_token'])) {
            $css_token = $_POST['css_token'];
        }

        $data = [
            'token'             => $css_token,
            'captation_means'   => 'form_site',
            'name'              => $name,
            'email'             => $email,
            'phone_countrycode' => '55',
            'phone'             => $phone,
            'message'           => $message,
            'message_complete'  => '',
            'send'              => [
                'type' => 'email'
            ],
            'data'              => $additionalData
        ];

        $this->httpClient->request('POST', 'register/lead', [
            'form_params' => $data
        ]);
    }
}