<?php

namespace Necronru\Payture\Abstraction;

abstract class AbstractEnum
{
    /**
     * Хеш с названиями элементов перечисления на русском языке
     * Не обязателен для перегрузки
     * @var array
     */
    protected static $titles = [];

    /**
     * Возвращает хэш вида key => value,
     * где key - название константы в перечислении,
     * а value - значение константы в перечислении
     * @return array
     */
    public static function getItems()
    {
        return (new \ReflectionClass(static::class))->getConstants();
    }

    /**
     * Возвращает хэш вида key => value,
     * где key - значение константы в перечислении,
     * а value - русское название константы в перечислении
     * @return array
     */
    public static function getTitles()
    {
        return static::$titles;
    }

    public static function contains($value)
    {
        return in_array($value, static::getItems());
    }

    /**
     * @param $value
     * @return string
     */
    public static function getTitle($value)
    {
        return (array_key_exists($value, static::getTitles())) ? static::getTitles()[$value] : '';
    }
}