<?php

namespace CodeBot\TemplatesMessage;

use PHPUnit\Framework\TestCase;
use CodeBot\Element\Product;
use CodeBot\Element\Button;

class GenericTemplateTest extends TestCase
{
    public function testListWithThreeProducts()
    {
        $button1 = new Button('web_url', null, 'https://angular.io/');
        $button2 = new Button('web_url', null, 'https://vuejs.org/');

        $product1 = new Product('Produto 1','https://angular.io/assets/images/logos/angular/angular.svg','Curso de Angular', $button1);
        $product2 = new Product('Produto 2','https://vuejs.org/images/logo.png','Curso de VueJS', $button2);

        $template = new GenericTemplate(1234);
        $template->add($product1);
        $template->add($product2);

        $actual = $template->message('qwe');

        $expected = [
            'recipient' => [
                'id' => 1234
            ],
            'message' => [
                'attachment' => [
                    'type' => 'template',
                    'payload' => [
                        'template_type' => 'generic',
                        'buttons' => [
                            [
                                'title' => 'Produto 1',
                                'subtitle' => 'Curso de Angular',
                                'image_url' => 'https://angular.io/assets/images/logos/angular/angular.svg',
                                'default_action' => [
                                    'type' => 'web_url',
                                    'url' => 'https://angular.io/',
                                ]
                            ],
                            [
                                'title' => 'Produto 2',
                                'subtitle' => 'Curso de VueJS',
                                'image_url' => 'https://vuejs.org/images/logo.png',
                                'default_action' => [
                                    'type' => 'web_url',       
                                    'url' => 'https://vuejs.org/',       
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $this->assertEquals($expected, $actual);
    }
}