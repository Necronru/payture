<?php


namespace Necronru\Payture\Abstraction;


use Necronru\Payture\EWallet\Command\InitCommand;
use Necronru\Payture\EWallet\Command\PayCommand;
use Necronru\Payture\EWallet\Command\PayStatusCommand;
use Necronru\Payture\EWallet\Command\RefundCommand;

interface EWalletInterface
{

    /**
     * @param InitCommand $command
     * @return \Necronru\Payture\EWallet\Response\InitResponse
     *
     * @link http://payture.com/integration/api/#ewallet_init_
     */
    public function init(InitCommand $command);

    /**
     * Вернет ссылку на страницу Payture, которая в свою очередь перенаправить покупателя
     * на страницу ввода реквизитов карты (на стороне payture)
     *
     * @param PayCommand $command
     * @return string
     *
     * @link http://payture.com/integration/api/#ewallet_pay_
     */
    public function pay(PayCommand $command);

    /**
     * @param PayStatusCommand $command
     * @return \Necronru\Payture\EWallet\Response\PayStatusResponse
     *
     * @link http://payture.com/integration/api/#ewallet_paystatus_
     */
    public function payStatus(PayStatusCommand $command);

    /**
     * @param RefundCommand $command
     * @return \Necronru\Payture\EWallet\Response\RefundResponse
     * @link http://payture.com/integration/api/#ewallet_refund_
     */
    public function refund(RefundCommand $command);
}