<?php


namespace Necronru\Payture\EWallet\Payment;


use Necronru\Payture\EWallet\Payment\Command\InitCommand;
use Necronru\Payture\EWallet\Payment\Command\PayCommand;
use Necronru\Payture\EWallet\Payment\Command\PayStatusCommand;
use Necronru\Payture\EWallet\Payment\Command\RefundCommand;

interface PaymentServiceInterface
{
    /**
     * @param InitCommand $command
     * @return \Necronru\Payture\EWallet\Payment\Response\InitResponse
     *
     * @link http://payture.com/integration/api/#ewallet_init_
     */
    public function init(InitCommand $command);

    /**
     * Вернет ссылку и SessionId на страницу Payture, которая в свою очередь перенаправит покупателя
     * на страницу ввода реквизитов карты (на стороне eWallet)
     *
     * @param PayCommand $command
     * @return string
     *
     * @link http://payture.com/integration/api/#ewallet_pay_
     */
    public function pay(PayCommand $command);

    /**
     * @param PayStatusCommand $command
     * @return \Necronru\Payture\EWallet\Payment\Response\PayStatusResponse
     *
     * @link http://payture.com/integration/api/#ewallet_paystatus_
     */
    public function payStatus(PayStatusCommand $command);

    /**
     * @param RefundCommand $command
     * @return \Necronru\Payture\EWallet\Payment\Response\RefundResponse
     *
     * @link http://payture.com/integration/api/#ewallet_refund_
     */
    public function refund(RefundCommand $command);

    /**
     * @link http://payture.com/integration/api/#ewallet_sendcode_
     */
    public function sendCode();

    /**
     * @link http://payture.com/integration/api/#ewallet_unblock_
     */
    public function unblock();

    /**
     * @link http://payture.com/integration/api/#ewallet_charge_
     */
    public function charge();

}