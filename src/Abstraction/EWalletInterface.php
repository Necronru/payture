<?php


namespace Necronru\Payture\Abstraction;


use Necronru\Payture\EWallet\Command\GetCardListCommand;
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
     * @return \Necronru\Payture\EWallet\Response\PayStatusResponse
     *
     * @link http://payture.com/integration/api/#ewallet_paystatus_
     */
    public function payStatus(PayStatusCommand $command);

    /**
     * @param RefundCommand $command
     * @return \Necronru\Payture\EWallet\Response\RefundResponse
     *
     * @link http://payture.com/integration/api/#ewallet_refund_
     */
    public function refund(RefundCommand $command);

    /**
     * @param GetCardListCommand $command
     * @return \Necronru\Payture\EWallet\Response\GetCardList\GetList
     * @link http://payture.com/integration/api/#ewallet_ewallet-cards_getlist_
     */
    public function cartList(GetCardListCommand $command);
}