<?php


namespace Necronru\Payture\EWallet\Payment;


use Necronru\Payture\EWallet\Payment\Command\ChargeCommand;
use Necronru\Payture\EWallet\Payment\Command\InitCommand;
use Necronru\Payture\EWallet\Payment\Command\PayCommand;
use Necronru\Payture\EWallet\Payment\Command\PayStatusCommand;
use Necronru\Payture\EWallet\Payment\Command\RefundCommand;
use Necronru\Payture\EWallet\Payment\Command\UnblockCommand;

interface PaymentServiceInterface
{
    /**
     * Запрос инициализации платежа. Выполняется перед перенаправлением Пользователя на страницу платежного шлюза Payture для ввода данных карты.
     *
     * @param InitCommand $command
     * @return \Necronru\Payture\EWallet\Payment\Response\InitResponse
     *
     * @link http://payture.com/integration/api/#ewallet_init_
     */
    public function init(InitCommand $command);

    /**
     * Вернет ссылку на страницу оплаты (на стороне Payture).
     *
     * @param string $sessionId
     * @return string
     *
     * @link http://payture.com/integration/api/#ewallet_pay_payture-side_
     */
    public function getPayLink($sessionId);

    /**
     * @param PayStatusCommand $command
     * @return \Necronru\Payture\EWallet\Payment\Response\PayStatusResponse
     *
     * @link http://payture.com/integration/api/#ewallet_paystatus_
     */
    public function payStatus(PayStatusCommand $command);

    /**
     * Этот запрос используется для возврата денежных средств, списанных командой Pay или Charge, на карту покупателя.
     * Результатом обработки запроса является возврат (полный или частичный) списанных денежных средств на карту покупателя.
     * Основанием для возврата средств, как правило, является отказ покупателя от купленного товара/услуги, либо неоказание услуги ТСП.
     * Возврат средств может сопровождаться потерями для ТСП ввиду наличия комиссий третьей стороны за проведение операции возврата денежных средств или иных условий платежа.
     * Внимание: для успешного списания необходимо, чтобы на момент исполнения запроса платеж имел статус Charged.
     *
     * @param RefundCommand $command
     * @return \Necronru\Payture\EWallet\Payment\Response\RefundResponse
     *
     * @link http://payture.com/integration/api/#ewallet_refund_
     */
    public function refund(RefundCommand $command);

    /**
     * Запрос SendCode выполняется перед командой проведения платежа для дополнительной аутентификации держателя карты (Покупателя).
     * Результатом запроса является генерация кода подтверждения. Таким образом, при проведении платежа Покупателю потребуется указать только CVC2/CVV2 и код подтверждения.
     * Код подтверждения – случайная последовательность из 6 символов, высылаемая шлюзом Payture на номер мобильного телефона Покупателя.
     * Код подтверждения формируется для коллекции параметров VWUserLgn, CardId (опционально), OrderId(опционально). Выполнение запроса с повторяющимися значениями параметров ведет к отправке Покупателю нового кода.
     * Отправленный код действителен в течение 30 минут, либо до момента повторного запроса кода подтверждения; затем он удаляется из системы. Код, успешно подтвержденный Покупателем при проведения платежа, также удаляется из системы.
     *
     * @link http://payture.com/integration/api/#ewallet_sendcode_
     */
    public function sendCode();

    /**
     * Запрос позволяет полностью снять блокирование денежных средств, заблокированных на карте Пользователя командой Pay.
     * Выполняется в рамках двухстадийной схемы проведения платежа.
     * Результатом обработки запроса является полная разблокировка средств, заблокированных на карте Пользователя.
     * Внимание: для успешной разблокировки необходимо, чтобы на момент исполнения запроса платеж имел статус Authorized.
     *
     * @link http://payture.com/integration/api/#ewallet_unblock_
     * @param UnblockCommand $command
     * @return \Necronru\Payture\EWallet\Payment\Response\UnblockResponse
     */
    public function unblock(UnblockCommand $command);

    /**
     * Запрос используется для списания денежных средств с карты покупателя, предварительно заблокированных командой Pay.
     * Выполняется в рамках двухстадийной схемы проведения платежа.
     * Внимание: для успешного списания необходимо, чтобы на момент исполнения запроса платеж имел статус Authorized.
     *
     * @param ChargeCommand $command
     * @return \Necronru\Payture\EWallet\Payment\Response\ChargeResponse
     *
     * @link http://payture.com/integration/api/#ewallet_charge_
     */
    public function charge(ChargeCommand $command);
}