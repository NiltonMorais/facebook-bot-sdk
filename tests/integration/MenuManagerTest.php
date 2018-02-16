<?php
namespace CodeBot;

use PHPUnit\Framework\TestCase;

class MenuManagerTest extends TestCase
{
    public function testMakeMenu()
    {
        $menu = new MenuManager('default');

        $call_to_actions = [
            [
                'id' => 1,
                'type' => 'nested',
                'title' => 'O que eu posso fazer?',
                'parent_id' => 0,
                'value' => null,
            ],
            [
                'id' => 2,
                'type' => 'web_url',
                'title' => 'Visite nosso site',
                'parent_id' => 1,
                'value' => 'http://code.education/',
            ],
            [
                'id' => 3,
                'type' => 'web_url',
                'title' => 'School Of Net',
                'parent_id' => 1,
                'value' => 'http://schoolofnet.com/',
            ],
            [
                'id' => 3,
                'type' => 'postback',
                'title' => 'Ver opções iniciais',
                'parent_id' => 1,
                'value' => 'iniciar',
            ]
        ];

        foreach($call_to_actions as $action){
            $menu->callToAction($action['id'], $action['type'], $action['title'], $action['parent_id'], $action['value']);
        }


        $pageAccessToken = 'FACEBOOK_ACCESS_TOKEN AQUI';
        $callSendApi = new CallSendApi($pageAccessToken);
        $result = $callSendApi->make($menu->toArray(), CallSendApi::URL_PROFILE);

        $this->assertTrue(is_string($result));
    }
}