<?php


namespace Necronru\Payture\Enum;


use Necronru\Payture\Abstraction\AbstractEnum;

class ErrorCode extends AbstractEnum
{
    /**
     * Операция выполнена без ошибок
     */
    const NONE = 'NONE';

    /**
     * Доступ с текущего IP или по указанным параметрам запрещен
     */
    const ACCESS_DENIED = 'ACCESS_DENIED';

    /**
     * Неверно указана сумма транзакции
     */
    const AMOUNT_ERROR = 'AMOUNT_ERROR';

    /**
     * Сумма транзакции превышает доступный остаток средств на выбранном счете
     */
    const AMOUNT_EXCEED = 'AMOUNT_EXCEED';

    /**
     * Сумма транзакции превышает доступный остаток средств на выбранном счете
     */
    const AMOUNT_EXCEED_BALANCE = 'AMOUNT_EXCEED_BALANCE';

    /**
     * Данный API не разрешен к использованию
     */
    const API_NOT_ALLOWED = 'API_NOT_ALLOWED';

    /**
     * Ошибка возникла при передаче данных в МПС
     */
    const COMMUNICATE_ERROR = 'COMMUNICATE_ERROR';

    /**
     * Номер заказа уже использовался ранее
     */
    const DUPLICATE_ORDER_ID = 'DUPLICATE_ORDER_ID';

    /**
     * Карта уже зарегистрирована
     */
    const DUPLICATE_CARD = 'DUPLICATE_CARD';

    /**
     * Пользователь уже зарегистрирован
     */
    const DUPLICATE_USER = 'DUPLICATE_USER';

    /**
     * Ошибка процессинга
     */
    const EMPTY_RESPONSE = 'EMPTY_RESPONSE';

    /**
     * Неверный формат переданных данных
     */
    const FORMAT_ERROR = 'FORMAT_ERROR';

    /**
     * Недопустимая транзакция согласно настройкам антифродового фильтра
     */
    const FRAUD_ERROR = 'FRAUD_ERROR';

    /**
     * Превышен лимит по карте(BINу, маске) согласно настройкам антифродового фильтра
     */
    const FRAUD_ERROR_BIN_LIMIT = 'FRAUD_ERROR_BIN_LIMIT';

    /**
     * Страна данного BINа находится в черном списке или не находится в списке допустимых стран
     */
    const FRAUD_ERROR_BLACKLIST_BANKCOUNTRY = 'FRAUD_ERROR_BLACKLIST_BANKCOUNTRY';

    /**
     * Аэропорт находится в черном списке
     */
    const FRAUD_ERROR_BLACKLIST_AEROPORT = 'FRAUD_ERROR_BLACKLIST_AEROPORT';

    /**
     * Страна данного IP находится в черном списке или не находится в списке допустимых стран
     */
    const FRAUD_ERROR_BLACKLIST_USERCOUNTRY = 'FRAUD_ERROR_BLACKLIST_USERCOUNTRY';

    /**
     * Номер карты(BIN, маска) внесен в черный список антифродового фильтра
     */
    const FRAUD_ERROR_CRITICAL_CARD = 'FRAUD_ERROR_CRITICAL_CARD';

    /**
     * IP-адрес внесен в черный список антифродового фильтра
     */
    const FRAUD_ERROR_CRITICAL_CUSTOMER = 'FRAUD_ERROR_CRITICAL_CUSTOMER';

    /**
     * Попытка выполнения недопустимой операции для текущего состояния платежа
     */
    const ILLEGAL_ORDER_STATE = 'ILLEGAL_ORDER_STATE';

    /**
     * Неправильный формат транзакции с точки зрения сети
     */
    const INTERNAL_ERROR = 'INTERNAL_ERROR';

    /**
     * Неправильный формат транзакции с точки зрения сети
     */
    const INVALID_FORMAT = 'INVALID_FORMAT';

    /**
     * Владелец карты пытается выполнить транзакцию, которая для него не разрешена банком-эмитентом, либо произошла внутренняя ошибка эмитента
     */
    const ISSUER_BLOCKED_CARD = 'ISSUER_BLOCKED_CARD';

    /**
     * Банк-эмитент запретил интернет транзакции по карте
     */
    const ISSUER_CARD_FAIL = 'ISSUER_CARD_FAIL';

    /**
     * Владелец карты пытается выполнить транзакцию, которая для него не разрешена банком-эмитентом, либо внутренняя ошибка эмитента
     */
    const ISSUER_FAIL = 'ISSUER_FAIL';

    /**
     * Предпринята попытка, превышающая ограничения банка-эмитента на сумму или количество операций в определенный промежуток времени
     */
    const ISSUER_LIMIT_FAIL = 'ISSUER_LIMIT_FAIL';

    /**
     * Предпринята попытка выполнить транзакцию на сумму, превышающую (дневной) лимит, заданный банком-эмитентом
     */
    const ISSUER_LIMIT_AMOUNT_FAIL = 'ISSUER_LIMIT_AMOUNT_FAIL';

    /**
     * Превышен лимит на число транзакций: клиент выполнил максимально разрешенное число транзакций в течение лимитного цикла и пытается провести еще одну
     */
    const ISSUER_LIMIT_COUNT_FAIL = 'ISSUER_LIMIT_COUNT_FAIL';

    /**
     * Нет связи с банком эмитентом
     */
    const ISSUER_TIMEOUT = 'ISSUER_TIMEOUT';

    /**
     * Время или количество попыток, отведенное для ввода данных, исчерпано
     */
    const LIMIT_EXCHAUST = 'LIMIT_EXCHAUST';

    /**
     * Превышен лимит Магазина или транзакции запрещены Магазину
     */
    const MERCHANT_RESTRICTION = 'MERCHANT_RESTRICTION';

    /**
     * Отказ эмитента проводить транзакцию. Чаще всего возникает при запретах наложенных на карту
     */
    const NOT_ALLOWED = 'NOT_ALLOWED';

    /**
     * Действие запрещено
     */
    const OPERATION_NOT_ALLOWED = 'OPERATION_NOT_ALLOWED';

    /**
     * Не найдена транзакция
     */
    const ORDER_NOT_FOUND = 'ORDER_NOT_FOUND';

    /**
     * Время платежа (сессии) истекло
     */
    const ORDER_TIME_OUT = 'ORDER_TIME_OUT';

    /**
     * Ошибка функционирования системы, имеющая общий характер. Фиксируется платежной сетью или банком-эмитентом
     */
    const PROCESSING_ERROR = 'PROCESSING_ERROR';

    /**
     * Таймаут в процессинге
     */
    const PROCESSING_TIME_OUT = 'PROCESSING_TIME_OUT';

    /**
     * Изменение суммы авторизации не может быть выполнено
     */
    const REAUTH_NOT_ALOWED = 'REAUTH_NOT_ALOWED';

    /**
     * Возврат не может быть выполнен
     */
    const REFUND_NOT_ALOWED = 'REFUND_NOT_ALOWED';

    /**
     * Отказ шлюза в выполнении операции
     */
    const REFUSAL_BY_GATE = 'REFUSAL_BY_GATE';

    /**
     * Превышено допустимое число попыток произвести возврат (Refund)
     */
    const RETRY_LIMIT_EXCEEDED = 'RETRY_LIMIT_EXCEEDED';

    /**
     * Невозможно выполнить 3DS транзакцию
     */
    const THREE_DS_FAIL = 'THREE_DS_FAIL';

    /**
     * Срок действия транзакции был превышен к моменту ввода данных карты
     */
    const THREE_DS_TIME_OUT = 'THREE_DS_TIME_OUT';

    /**
     * Пользователь не найден
     */
    const USER_NOT_FOUND = 'USER_NOT_FOUND';

    /**
     * Сумма меньше минимального или больше максимального допустимого значения
     */
    const WRONG_AMOUNT = 'WRONG_AMOUNT';

    /**
     * Введены неверные параметры карты
     */
    const WRONG_CARD_INFO = 'WRONG_CARD_INFO';

    /**
     * Неверный номер карты
     */
    const WRONG_CARD_PAN = 'WRONG_CARD_PAN';

    /**
     * Неверный номер карты
     */
    const WRONG_PAN = 'WRONG_PAN';

    /**
     * Недопустимое имя держателя карты
     */
    const WRONG_CARDHOLDER_NAME = 'WRONG_CARDHOLDER_NAME';

    /**
     * Неверный набор или формат параметров
     */
    const WRONG_PARAMS = 'WRONG_PARAMS';

    /**
     * Некорректный параметр PayInfo (неправильно сформирован или нарушена криптограмма)
     */
    const WRONG_PAY_INFO = 'WRONG_PAY_INFO';

    /**
     * Неверный код активации
     */
    const WRONG_AUTH_CODE = 'WRONG_AUTH_CODE';

    /**
     * Переданы неверные параметры карты, либо карта в недопустимом состоянии
     */
    const WRONG_CARD = 'WRONG_CARD';

    /**
     * Неверный код подтверждения
     */
    const WRONG_CONFIRM_CODE = 'WRONG_CONFIRM_CODE';

    /**
     * Пользователь с такими параметрами не найден
     */
    const WRONG_USER_PARAMS = 'WRONG_USER_PARAMS';

    public static $titles = [
        self::NONE => 'Операция выполнена без ошибок',
        self::ACCESS_DENIED => 'Доступ с текущего IP или по указанным параметрам запрещен',
        self::AMOUNT_ERROR => 'Неверно указана сумма транзакции',
        self::AMOUNT_EXCEED => 'Сумма транзакции превышает доступный остаток средств на выбранном счете',
        self::AMOUNT_EXCEED_BALANCE => 'Сумма транзакции превышает доступный остаток средств на выбранном счете',
        self::API_NOT_ALLOWED => 'Данный API не разрешен к использованию',
        self::COMMUNICATE_ERROR => 'Ошибка возникла при передаче данных в МПС',
        self::DUPLICATE_ORDER_ID => 'Номер заказа уже использовался ранее',
        self::DUPLICATE_CARD => 'Карта уже зарегистрирована',
        self::DUPLICATE_USER => 'Пользователь уже зарегистрирован',
        self::EMPTY_RESPONSE => 'Ошибка процессинга',
        self::FORMAT_ERROR => 'Неверный формат переданных данных',
        self::FRAUD_ERROR => 'Недопустимая транзакция согласно настройкам антифродового фильтра',
        self::FRAUD_ERROR_BIN_LIMIT => 'Превышен лимит по карте(BINу, маске) согласно настройкам антифродового фильтра',
        self::FRAUD_ERROR_BLACKLIST_BANKCOUNTRY => 'Страна данного BINа находится в черном списке или не находится в списке допустимых стран',
        self::FRAUD_ERROR_BLACKLIST_AEROPORT => 'Аэропорт находится в черном списке',
        self::FRAUD_ERROR_BLACKLIST_USERCOUNTRY => 'Страна данного IP находится в черном списке или не находится в списке допустимых стран',
        self::FRAUD_ERROR_CRITICAL_CARD => 'Номер карты(BIN, маска) внесен в черный список антифродового фильтра',
        self::FRAUD_ERROR_CRITICAL_CUSTOMER => 'IP-адрес внесен в черный список антифродового фильтра',
        self::ILLEGAL_ORDER_STATE => 'Попытка выполнения недопустимой операции для текущего состояния платежа',
        self::INTERNAL_ERROR => 'Неправильный формат транзакции с точки зрения сети',
        self::INVALID_FORMAT => 'Неправильный формат транзакции с точки зрения сети',
        self::ISSUER_BLOCKED_CARD => 'Владелец карты пытается выполнить транзакцию, которая для него не разрешена банком-эмитентом, либо произошла внутренняя ошибка эмитента',
        self::ISSUER_CARD_FAIL => 'Банк-эмитент запретил интернет транзакции по карте',
        self::ISSUER_FAIL => 'Владелец карты пытается выполнить транзакцию, которая для него не разрешена банком-эмитентом, либо внутренняя ошибка эмитента',
        self::ISSUER_LIMIT_FAIL => 'Предпринята попытка, превышающая ограничения банка-эмитента на сумму или количество операций в определенный промежуток времени',
        self::ISSUER_LIMIT_AMOUNT_FAIL => 'Предпринята попытка выполнить транзакцию на сумму, превышающую (дневной) лимит, заданный банком-эмитентом',
        self::ISSUER_LIMIT_COUNT_FAIL => 'Превышен лимит на число транзакций: клиент выполнил максимально разрешенное число транзакций в течение лимитного цикла и пытается провести еще одну',
        self::ISSUER_TIMEOUT => 'Нет связи с банком эмитентом',
        self::LIMIT_EXCHAUST => 'Время или количество попыток, отведенное для ввода данных, исчерпано',
        self::MERCHANT_RESTRICTION => 'Превышен лимит Магазина или транзакции запрещены Магазину',
        self::NOT_ALLOWED => 'Отказ эмитента проводить транзакцию. Чаще всего возникает при запретах наложенных на карту',
        self::OPERATION_NOT_ALLOWED => 'Действие запрещено',
        self::ORDER_NOT_FOUND => 'Не найдена транзакция',
        self::ORDER_TIME_OUT => 'Время платежа (сессии) истекло',
        self::PROCESSING_ERROR => 'Ошибка функционирования системы, имеющая общий характер. Фиксируется платежной сетью или банком-эмитентом',
        self::PROCESSING_TIME_OUT => 'Таймаут в процессинге',
        self::REAUTH_NOT_ALOWED => 'Изменение суммы авторизации не может быть выполнено',
        self::REFUND_NOT_ALOWED => 'Возврат не может быть выполнен',
        self::REFUSAL_BY_GATE => 'Отказ шлюза в выполнении операции',
        self::RETRY_LIMIT_EXCEEDED => 'Превышено допустимое число попыток произвести возврат (Refund)',
        self::THREE_DS_FAIL => 'Невозможно выполнить 3DS транзакцию',
        self::THREE_DS_TIME_OUT => 'Срок действия транзакции был превышен к моменту ввода данных карты',
        self::USER_NOT_FOUND => 'Пользователь не найден',
        self::WRONG_AMOUNT => 'Сумма меньше минимального или больше максимального допустимого значения',
        self::WRONG_CARD_INFO => 'Введены неверные параметры карты',
        self::WRONG_CARD_PAN => 'Неверный номер карты',
        self::WRONG_PAN => 'Неверный номер карты',
        self::WRONG_CARDHOLDER_NAME => 'Недопустимое имя держателя карты',
        self::WRONG_PARAMS => 'Неверный набор или формат параметров',
        self::WRONG_PAY_INFO => 'Некорректный параметр PayInfo (неправильно сформирован или нарушена криптограмма)',
        self::WRONG_AUTH_CODE => 'Неверный код активации',
        self::WRONG_CARD => 'Переданы неверные параметры карты, либо карта в недопустимом состоянии',
        self::WRONG_CONFIRM_CODE => 'Неверный код подтверждения',
        self::WRONG_USER_PARAMS => 'Пользователь с такими параметрами не найден',
    ];
}