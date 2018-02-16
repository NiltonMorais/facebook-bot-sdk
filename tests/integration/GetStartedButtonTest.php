<?php
namespace CodeBot;

use PHPUnit\Framework\TestCase;

class GetStartedButtonTest extends TestCase
{
    public function testAddGetStartedButton()
    {
        $pageAccessToken = 'EAAcL1nhyAg4BAEDwMUNYwG1nkyMglzKFskdVXHxZCaxV9L8KInC1EiJwCCCmx5nv88gI8YdlBfTvNaViBaNuEPrFc8iuXoRQmv9l5TfpDl8NDipbMB9JqvC7KoZAfWul1uBqkl6hB6alz7ShYKw8PGf6XxZCascZAMQzZCF73kgZDZD';
        $data = (new GetStartedButton())->add('Iniciar');
        $callSendApi = new CallSendApi($pageAccessToken);
        $result = $callSendApi->make($data, CallSendApi::URL_PROFILE);

        $this->assertTrue(is_string($result));
    }
}