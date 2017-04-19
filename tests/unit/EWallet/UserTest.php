<?php


use GuzzleHttp\Client;
use Necronru\Payture\EWallet\EWallet;
use Necronru\Payture\EWallet\User\Command\CheckCommand;
use Necronru\Payture\EWallet\User\Command\DeleteCommand;
use Necronru\Payture\EWallet\User\Command\RegisterCommand;
use Necronru\Payture\EWallet\User\Command\UpdateCommand;

class UserTest extends \Codeception\Test\Unit
{
    protected $credentials = ['Merchant', '123'];
    protected $user = [];

    public function setUp()
    {
        return parent::setUp();
    }

    public function testRegister()
    {
        $user = [uniqid('unit_test_') . '@ya.ru', '2645363', '79999999999'];
        $eWallet = new EWallet(new Client(['base_uri' => 'https://sandbox2.payture.com/']), $this->credentials[0], $this->credentials[1]);

        $response = $eWallet->user()->register(new RegisterCommand($user[0], $user[1], $user[2]));

        static::assertEquals('True', $response->Success);
        static::assertEquals($user[0], $response->VWUserLgn);

        return $user;
    }

    /**
     * @depends testRegister
     */
    public function testUpdate($user)
    {
        $eWallet = new EWallet(new Client(['base_uri' => 'https://sandbox2.payture.com/']), $this->credentials[0], $this->credentials[1]);

        $response = $eWallet->user()->update(new UpdateCommand($user[0], $user[1], '79999999991'));

        static::assertEquals('True', $response->Success);
        static::assertEquals($user[0], $response->VWUserLgn);

        return $user;
    }

    /**
     * @depends testRegister
     */
    public function testCheck($user)
    {
        $eWallet = new EWallet(new Client(['base_uri' => 'https://sandbox2.payture.com/']), $this->credentials[0], $this->credentials[1]);

        $response = $eWallet->user()->check(new CheckCommand($user[0], $user[1]));

        static::assertEquals('True', $response->Success);
        static::assertEquals($user[0], $response->VWUserLgn);

        return $user;
    }

    /**
     * @depends testCheck
     */
    public function testDelete($user)
    {
        $eWallet = new EWallet(new Client(['base_uri' => 'https://sandbox2.payture.com/']), $this->credentials[0], $this->credentials[1]);

        $response = $eWallet->user()->delete(new DeleteCommand($user[0]));

        static::assertEquals('True', $response->Success);
        static::assertEquals($user[0], $response->VWUserLgn);

        return $user;
    }
}