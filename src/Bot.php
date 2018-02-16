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

    public function addGetStartedButton(string $postback)
    {
        $data = (new GetStartedButton())->add($postback);
        return $this->callSendApi($data, CallSendApi::URL_PROFILE);
    }

    public function removeGetStartedButton()
    {
        $data = (new GetStartedButton())->remove();
        return $this->callSendApi($data, CallSendApi::URL_PROFILE, 'DELETE');
    }

    public function addMenu(string $locale, string $composer_input_disabled, array $call_to_actions)
    {
        $menu = new MenuManager($locale, $composer_input_disabled);

        foreach($call_to_actions as $action){
            $menu->callToAction($action['id'], $action['type'], $action['title'], $action['parent_id'], $action['value']);
        }

        return $this->callSendApi($menu->toArray(),callSendApi::URL_PROFILE);
    }

    public function removeMenu()
    {
        $data = [
            'fields' => [
                'persistent_menu'
            ]
        ];

        return $this->callSendApi($data,callSendApi::URL_PROFILE, 'DELETE');
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