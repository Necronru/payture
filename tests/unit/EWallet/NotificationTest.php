<?php


use GuzzleHttp\Client;
use Necronru\Payture\EWallet\EWallet;
use Necronru\Payture\EWallet\Notification\Command as NotificationCommand;

class NotificationTest extends \Codeception\Test\Unit
{
    /**
     * @var EWallet
     */
    private $service;

    protected function _before()
    {
        $this->service = new EWallet(new Client(['base_uri' => $_ENV['PAYTURE_API']]), $_ENV['PAYTURE_TERMINAL_ID'], $_ENV['PAYTURE_TERMINAL_PASSWORD']);
    }

    public function notificationProvider()
    {
        return [
            [
                'className' => NotificationCommand\CustomerAddSuccess::class,
                'data' => [
                    'VWUserLgn' =>  'payture.tester@gmail.com',
                    'PhoneNumber' =>  '79265351604',
                    'CardNumber' =>  '411111xxxxxx1112',
                    'TransactionDate' =>  '26.01.2016 17:08:20',
                    'IsAlfa' =>  'False',
                    'CardName' =>  '411111xxxxxx1112',
                    'CardHolder' =>  'ivan ivanov',
                    'CardId' =>  '15227c4a-d352-4191-8c3d-b331e9a9e57d',
                    'SessionId' =>  '89a02546-daf5-41c7-805d-5439a95c432d',
                    'DateTime' =>  '635894248576845703',
                    'Success' =>  'True',
                    'Notification' =>  'CustomerAddSuccess',
                    'MerchantContract' =>  'Arrows1'
                ]
            ],
            [
                'className' => NotificationCommand\CustomerAddFail::class,
                'data' => [
                    'VWUserLgn' => 'payture.tester@gmail.com',
                    'PhoneNumber' => '79265351604',
                    'TransactionDate' => '27.01.2016 10:39:41',
                    'Success' => 'False',
                    'ErrCode' => 'WRONG_PARAMS',
                    'Notification' => 'CustomerAddFail',
                    'MerchantContract' => 'Arrows1',
                ]
            ],
            [
                'className' => NotificationCommand\CustomerPaySuccess::class,
                'data' => [
                    'Notification' => 'CustomerPaySuccess',
                    'VWUserLgn' => 'payture.tester@gmail.com',
                    'CardId' => '15227c4a-d352-4191-8c3d-b331e9a9e57d',
                    'OrderId' => 'da0b3a87-602f-40c4-83d7-3d88fd1151f2',
                    'Amount' => '300',
                    'ConfirmCode' => '10',
                    'ExternalMerchantOrderId' => 'da0b3a87-602f-40c4-83d7-3d88fd1151f2',
                    'IP' => '109.73.11.168',
                    'Is3DS' => 'False',
                    'IsAFAuthorize' => 'False',
                    'IsSecureCodeByPhone' => 'False',
                    'TransactionDate' => '26.01.2016 17:42:43',
                    'SessionId' => '4788156e-48bc-4103-96fb-2f32f5d65e6c',
                    'CardNumber' => '411111xxxxxx1112',
                    'DateTime' => '63589426953052734',
                ]
            ],
            [
                'className' => NotificationCommand\CustomerRefundSuccess::class,
                'data' => [
                    'OrderId' => '805be31d-5f08-4a03-b7d1-adbaf82ec913',
                    'NewAmount' => '0',
                    'TransactionDate' => '01/26/2016 18:40:25',
                    'Success' => 'True',
                    'Notification' => 'CustomerRefundSuccess',
                    'MerchantContract' => 'Arrows1',
                ]
            ],
            [
                'className' => NotificationCommand\CustomerRefundFail::class,
                'data' => [
                    'OrderId' => 'd751e605-2f24-4917-ae95-c2a57e3e5769',
                    'Amount' => '700',
                    'TransactionDate' => '19.02.2016 10:58:44',
                    'Success' => 'False',
                    'ErrCode' => 'AMOUNT_ERROR',
                    'Notification' => 'CustomerRefundFail',
                    'MerchantContract' => 'Arrows1',
                ]
            ],
            [
                'className' => NotificationCommand\CustomerSendCode::class,
                'data' => [
                    'Email' => 'test@example.com',
                    'OrderId' => '333444555',
                    'Amount' => '300',
                    'TransactionDate' => '27.01.2016 10:27:03',
                    'Notification' => 'CustomerSendCode',
                    'MerchantContract' => 'Arrows1',
                ]
            ],
        ];
    }

    /**
     * @dataProvider notificationProvider
     *
     * @param string $className
     * @param array $data
     * 
     * @group notification
     */
    public function testNotificationConvert($className, $data)
    {
        $notification = $this->service->notification()->convert($data);

        static::assertInstanceOf($className, $notification);
        static::assertNotEmpty($notification);
    }
}