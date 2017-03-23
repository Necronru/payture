<?php


namespace Necronru\Payture\Enum;


use Necronru\Payture\Abstraction\AbstractEnum;

/**
 * Class TransactionStatus
 * @package Necronru\Payture\Enum
 *
 * @link http://payture.com/integration/api/#transaction-statuses_
 */
class TransactionStatus extends AbstractEnum
{
    // fixme: недокументированный статус
    const SESSION_INITED = 'Session_Inited';

    const STATUS_NEW                = 'New';
    const STATUS_PRE_AUTHORIZED_3DS = 'PreAuthorized3DS';
    const STATUS_PRE_AUTHORIZED_AF  = 'PreAuthorizedAF';
    const STATUS_AUTHORIZED         = 'Authorized';
    const STATUS_VOIDED             = 'Voided';
    const STATUS_CHARGED            = 'Charged';
    const STATUS_REFUNDED           = 'Refunded';
    const STATUS_FORWARDED          = 'Forwarded';
    const STATUS_REJECTED_TERMINAL  = 'Rejected(Terminal)';
    const STATUS_ERROR              = 'Error';

    public static $titles = [
        self::SESSION_INITED => 'Сессия установлена',

        self::STATUS_NEW => 'Платеж зарегистрирован в шлюзе, но его обработка в процессинге не начата',
        self::STATUS_PRE_AUTHORIZED_3DS => 'Пользователь начал аутентификацию по протоколу 3D Secure, на этом операции по платежу завершились',
        self::STATUS_PRE_AUTHORIZED_AF => 'Пользователь начал аутентификацию с помощью сервиса AntiFraud, на этом операции по платежу завершились',
        self::STATUS_AUTHORIZED => 'Средства заблокированы, но не списаны (2-х стадийный платеж)',
        self::STATUS_VOIDED => 'Средства на карте были заблокированы и разблокированы (2-х стадийный платеж)',
        self::STATUS_CHARGED => 'Денежные средства списаны с карты Пользователя, платёж завершен успешно',
        self::STATUS_REFUNDED => 'Успешно произведен полный возврат денежных средств на карту Пользователя',
        self::STATUS_FORWARDED => 'Платеж был перенаправлен на терминал, указанный в скобках',
        self::STATUS_REJECTED_TERMINAL => 'Последняя операция по платежу отклонена',
        self::STATUS_ERROR => 'Последняя операция по платежу завершена с ошибкой',
    ];

}