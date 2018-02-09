<?php

namespace CodeBot\TemplatesMessage;

use CodeBot\Element\ElementInterface;

class ReceiptTemplate implements TemplateInterface
{
    protected $products = [];
    protected $recipientId;
    protected $orderInfo;
    protected $address;
    protected $summary;
    protected $adjustments;

    public function __construct(string $recipientId)
    {
        $this->recipientId = $recipientId;
    }

    public function add(ElementInterface $element)
    {
        $this->products[] = $element->get();
    }

    public function setOrderInfo(string $recipient_name, string $order_number, string $currency, string $payment_method, string $order_url, string $timestamp)
    {
        $this->orderInfo = [
            'recipient_name' => $recipient_name,
            'order_number' => $order_number,
            'currency' => $currency,
            'payment_method' => $payment_method,
            'order_url' => $order_url,
            'timestamp' => $timestamp,
        ];
    }

    public function setAddress(string $street_1, string $street_2, string $city, string $postalcode, string $state, string $country)
    {
        $this->address = [
            'street_1' => $street_1,
            'street_2' => $street_2,
            'postalcode' => $postalcode,
            'state' => $state,
            'country' => $country,
        ];
    }

    public function setAdjustments(string $name, float $ammount)
    {
        $this->adjustments = [
            'name' => $name,
            'ammount' => $ammount,
        ];
    }

    public function setSummary(float $total_cost, float $subtotal = null, float $shipping_cost = null, float $total_tax)
    {
        $this->summary = [
            'total_cost' => $total_cost,
            'subtotal' => $subtotal,
            'shipping_cost' => $shipping_cost,
            'total_tax' => $total_tax,
        ];
    }
    public function message(string $messageText): array
    {
        if($this->orderInfo !== null){
            throw new \Exception('orderInfo is required');
        }

        if($this->summary !== null){
            throw new \Exception('summary is required');
        }

        $result = [
            'recipient' => [
                'id' => $this->recipientId
            ],
            'message' => [
                'attachment' => [
                    'type' => 'template',
                    'payload' => [
                        'template_type' => 'receipt',
                        'text' => $messageText,
                        'recipient_name' => $this->orderInfo['recipient_name'],
                        'order_number' => $this->orderInfo['order_number'],
                        'currency' => $this->orderInfo['currency'],
                        'payment_method' => $this->orderInfo['payment_method'],
                        'order_url' => $this->orderInfo['order_url'],
                        'timestamp' => $this->orderInfo['timestamp'],
                        'elements' => $this->products,
                        'summary' => $this->summary,
                    ]
                ]
            ]
        ];

        if($this->address !== null){
            $result['message']['attachment']['payload']['address'] = $this->address;
        }

        if($this->adjustments !== null){
            $result['message']['attachment']['payload']['adjustments'] = $this->address;
        }

        return $result;

    }
}