<?php

namespace CodeBot;

class Bot
{
    private $senderId;
    private $pageAccessToken;

    public function __construct(string $senderId, string $pageAccessToken)
    {
        $this->senderId = $senderId;
        $this->pageAccessToken = $pageAccessToken;
    }

    public function setSenderId(string $senderId)
    {
        $this->senderId = $senderId;
        return $this;
    }

    public function setPageAccessToken(string $pageAccessToken)
    {
        $this->pageAccessToken = $pageAccessToken;
        return $this;
    }

    public function load($class, $namespace)
    {
        $class = ucfirst($class);
        $class = $namespace.'\\'.$class;
        return new $class($this->senderId);
    }

    private function callSendApi(array $message, string $url = null,$method = 'POST'):string
    {
        $callSendApi = new CallSendApi($this->pageAccessToken);
        return $callSendApi->make($message, $url, $method);
    }
    
}