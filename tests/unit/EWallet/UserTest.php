<?php


use GuzzleHttp\Client;
use Necronru\Payture\EWallet\EWallet;
use Necronru\Payture\EWallet\User\Command\CheckCommand;
use Necronru\Payture\EWallet\User\Command\DeleteCommand;
use Necronru\Payture\EWallet\User\Command\RegisterCommand;
use Necronru\Payture\EWallet\User\Command\UpdateCommand;

class UserTest extends \Codeception\Test\Unit
{
    /**
     * @var EWallet
     */
    private $service;

    protected function _before()
    {
        $this->service = new EWallet(new Client(['base_uri' => $_ENV['PAYTURE_API']]), $_ENV['PAYTURE_TERMINAL_ID'], $_ENV['PAYTURE_TERMINAL_PASSWORD']);
    }

    public function testRegister()
    {
        $user = [uniqid('unit_test_') . '@ya.ru', '2645363', '79999999999'];

        $response = $this->service
            ->user()->register(new RegisterCommand($user[0], $user[1], $user[2]));

        static::assertEquals('True', $response->Success);
        static::assertEquals($user[0], $response->VWUserLgn);

        return $user;
    }

    /**
     * @depends testRegister
     * @param $user
     */
    public function testUpdate($user)
    {
        $response = $this->service
            ->user()->update(new UpdateCommand($user[0], $user[1], '79999999991'));

        static::assertEquals('True', $response->Success);
        static::assertEquals($user[0], $response->VWUserLgn);

        return $user;
    }

    /**
     * @depends testRegister
     * @param $user
     */
    public function testCheck($user)
    {
        $response = $this->service->user()->check(new CheckCommand($user[0], $user[1]));

        static::assertEquals('True', $response->Success);
        static::assertEquals($user[0], $response->VWUserLgn);

        return $user;
    }

    /**
     * @depends testCheck
     * @param $user
     */
    public function testDelete($user)
    {
        $response = $this->service
            ->user()->delete(new DeleteCommand($user[0]));

        static::assertEquals('True', $response->Success);
        static::assertEquals($user[0], $response->VWUserLgn);

        return $user;
    }
}