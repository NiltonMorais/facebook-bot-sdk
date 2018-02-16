<?php

namespace CodeBot;

use PHPUnit\Framework\TestCase;
use CodeBot\Build\Solid;

class BotTest extends TestCase
{
    private $pageAccessToken = 'EAAcL1nhyAg4BAEDwMUNYwG1nkyMglzKFskdVXHxZCaxV9L8KInC1EiJwCCCmx5nv88gI8YdlBfTvNaViBaNuEPrFc8iuXoRQmv9l5TfpDl8NDipbMB9JqvC7KoZAfWul1uBqkl6hB6alz7ShYKw8PGf6XxZCascZAMQzZCF73kgZDZD';
   
    public function testAddMenu()
    {
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

        $bot = Solid::factory();
        Solid::setPageAccessToken($this->pageAccessToken);
        $bot->addMenu('default',false, $call_to_actions);
    }
   
    public function testRemoveMenu()
    {
        $bot = Solid::factory();
        Solid::setPageAccessToken($this->pageAccessToken);
        $bot->removeMenu();
    }
    public function testAddGetStartedButton()
    {
        $bot = Solid::factory();
        Solid::setPageAccessToken($this->pageAccessToken);
        $bot->addGetStartedButton('iniciar');
    }
   
    public function testRemoveGetStartedButton()
    {
        $bot = Solid::factory();
        Solid::setPageAccessToken($this->pageAccessToken);
        $bot->removeGetStartedButton();
    }
}