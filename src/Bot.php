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

    public function message(string $type, string $message)
    {
        $type = $this->load($type, 'CodeBot\Message');
        $message = $type->message($message);
        return $this->callSendApi($message);
    }

    public function template(string $type, string $message, array $elements, array $config = [])
    {
        $type = $this->load($type."Template", 'CodeBot\TemplatesMessage');

        foreach($config as $method => $params){
            call_user_func_array([$type, $method], $params);
        }

        foreach($elements as $element){
            $type->add($elements);
        }

        $message = $type->message($message);
        return $this->callSendApi($message);
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