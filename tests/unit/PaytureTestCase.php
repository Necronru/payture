<?php


namespace Necronru\Payture\Tests\Unit;


use PHPUnit\Framework\TestCase;

class PaytureTestCase extends TestCase
{
    public function cardProvider()
    {
        return array(
            array(
                'CardName' => '411111xxxxxx1112',
                'CardId' => '856e3a1d-6b35-4f65-a6f6-b6aa53fd42e3',
                'CardHolder' => 'Ivan Ivanov',
                'Status' => 'NotActive',
                'NoCVV' => 'true',
                'Expired' => 'false',
            ),
            array(
                'CardName' => '411111xxxxxx0031',
                'CardId' => '4942764e-a219-4556-a9e8-07f78176c6df',
                'CardHolder' => 'Ivan Ivanov',
                'Status' => 'NotActive',
                'NoCVV' => 'true',
                'Expired' => 'false',
            ),
            array(
                'CardName' => '411111xxxxxx1114',
                'CardId' => '6c9c12e3-2f8c-489a-b4d3-87c61f8a9bbf',
                'CardHolder' => 'Ivan Ivanov',
                'Status' => 'NotActive3DS',
                'NoCVV' => 'true',
                'Expired' => 'false',
            ),
            array(
                'CardName' => '461111xxxxxx1112',
                'CardId' => '4382b55e-2952-43e3-8c1d-7507ecbc8711',
                'CardHolder' => 'Ivan Ivanov',
                'Status' => 'NotActive3DS',
                'NoCVV' => 'true',
                'Expired' => 'false',
            ),
            array(
                'CardName' => '411111xxxxxx1111',
                'CardId' => '45eed080-12f7-4601-bdae-514f4b00d464',
                'CardHolder' => 'Ivan Ivanov',
                'Status' => 'NotActive3DS',
                'NoCVV' => 'true',
                'Expired' => 'false',
            ),
            array(
                'CardName' => '411111xxxxxx1113',
                'CardId' => '621d25f8-5b4d-4861-8d55-9fa934918c64',
                'CardHolder' => 'Ivan Ivanov',
                'Status' => 'NotActive3DS',
                'NoCVV' => 'true',
                'Expired' => 'false',
            ),
            array(
                'CardName' => '411111xxxxxx1111',
                'CardId' => '6817f6d2-1f02-4481-b131-91296b8a7356',
                'CardHolder' => 'Ivan Ivanov',
                'Status' => 'NotActive3DS',
                'NoCVV' => 'true',
                'Expired' => 'false',
            ),
            array(
                'CardName' => '411111xxxxxx111\\',
                'CardId' => '92d5c541-6df2-4b77-90e4-821d4b20ff38',
                'CardHolder' => 'Ivan Ivanov',
                'Status' => 'NotActive3DS',
                'NoCVV' => 'true',
                'Expired' => 'false',
            ),
            array(
                'CardName' => '411111xxxxxx1111',
                'CardId' => '6b858f93-a35c-4aa4-8f35-3cb5f973ddb4',
                'CardHolder' => 'Ivan Ivanov',
                'Status' => 'NotActive3DS',
                'NoCVV' => 'true',
                'Expired' => 'false',
            ),
        );
    }
}