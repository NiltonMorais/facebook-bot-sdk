<?php

namespace CodeBot\TemplatesMessage;

use PHPUnit\Framework\TestCase;
use CodeBot\Element\Button;

class ButtonsTemplateTest extends TestCase
{
    public function testReturnWithButtonInArrayFormat()
    {
        $recipientId = 1234;
        $type = 'postback';
        $message = 'Exemplo de template com botões..';
        $title = 'Uma resposta do bot';
        $payload = "Resposta";

        $buttonsTemplate = new ButtonsTemplate($recipientId);
        $buttonsTemplate->add(new Button($type,$title,$payload));
        $actual = $buttonsTemplate->message($message);

        $expected = [
            'recipient' => [
                'id' => $recipientId
            ],
            'message' => [
                'attachment' => [
                    'type' => 'template',
                    'payload' => [
                        'template_type' => 'button',
                        'text' => $message,
                        'buttons' => [
                            [
                                'type' => $type,
                                'title' => $title,
                                'payload' => $payload,
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $this->assertEquals($expected, $actual);
    }
}