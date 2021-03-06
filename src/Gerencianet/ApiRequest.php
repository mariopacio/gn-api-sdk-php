<?php

namespace Gerencianet;

use Gerencianet\Exception\AuthorizationException;

class ApiRequest
{
    private $auth;
    private $request;

    public function __construct(array $options = null)
    {
        $this->auth = new Auth($options);
        $this->request = new Request($options);
    }

    public function send($method, $route, $body)
    {
        if (!$this->auth->expires || $this->auth->expires <= time()) {
            $this->auth->authorize();
        }

        try {
            return $this->request->send($method, $route, ['json' => $body,
            'headers' => ['Authorization' => 'Bearer '.$this->auth->accessToken], ]);
        } catch (AuthorizationException $e) {
            $this->auth->authorize();

            return $this->request->send($method, $route, ['json' => $body,
            'headers' => ['Authorization' => 'Bearer '.$this->auth->accessToken], ]);
        }
    }

    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }
}
