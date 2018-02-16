<?php
namespace CodeBot;

use PHPUnit\Framework\TestCase;

class GetStartedButtonTest extends TestCase
{
    public function testAddGetStartedButton()
    {
        $pageAccessToken = 'AQUI_VAI_SEU_ACCESS_TOKEN';
        $data = (new GetStartedButton())->add('Iniciar');
        $callSendApi = new CallSendApi($pageAccessToken);
        $result = $callSendApi->make($data, CallSendApi::URL_PROFILE);

        $this->assertTrue(is_string($result));
    }

    public function testRemoveGetStartedButton()
    {
        $pageAccessToken = 'AQUI_VAI_SEU_ACCESS_TOKEN';
        $data = (new GetStartedButton())->remove();
        $callSendApi = new CallSendApi($pageAccessToken);
        $result = $callSendApi->make($data, CallSendApi::URL_PROFILE, 'DELETE');

        $this->assertTrue(is_string($result));
    }
}