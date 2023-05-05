<?php

declare(strict_types=1);

namespace App\Tests\Functional\Api;

use \Codeception\Attribute\DataProvider;
use \Codeception\Example;
use Tests\Support\FunctionalTester;

class HousesCest
{

    public const ROUTE = '/houses';

    private string $iri;

    public function _before(FunctionalTester $I): void
    {
        $I->am('API_USER');
        $I->haveHttpHeader('accept', 'application/ld+json');
        $I->haveHttpHeader('Content-Type', 'application/ld+json');
    }

    #[DataProvider('houseProvider')]
    public function tryToCreateHouseSuccessful(FunctionalTester $I, Example $example): void
    {
        $I->amGoingTo('POST a new house ' . $example['condition']);
        $params = [
            'name' => $example['name']
        ];

        if(!empty($example['address'])) {
           $params['address'] = $example['address'];
        }

        if(!empty($example['geo'])) {
            $params['geo'] = $example['geo'];
        }

        $I->sendPost(self::ROUTE, $params);
        $I->expect('response is expected');
        $I->seeResponseCodeIs($example['code']);
        $I->seeHttpHeader('content-type', 'application/ld+json; charset=utf-8');
        $I->seeResponseIsJson();

        $I->seeResponseMatchesJsonType(
            [
                '@id' => 'string'
            ]
        );

        $I->seeResponseContainsJson([
            'name' => $example['name'],
            '@type' => 'https://schema.org/House'
        ]);

        if (!empty($example['address'])) {
            /**
            $I->seeResponseMatchesJsonType([
                'address' => 'array'
            ]); **/

            $I->seeResponseContainsJson([
                'address' => $example['address']
            ]);
        }

        if (!empty($example['geo'])) {
            /**
            $I->seeResponseMatchesJsonType(
                [
                    'geo' => 'array'
                ]
            ); **/
            $I->seeResponseContainsJson([
                'geo' => $example['geo']
            ]);
        }
    }

    public function tryToGetCollection(FunctionalTester $I): void
    {
        $I->amGoingTo('GET list of houses');
        $I->sendGet(self::ROUTE);

        $I->expect('response is successful');
        $I->seeResponseCodeIsSuccessful();
        $I->seeHttpHeader('content-type', 'application/ld+json; charset=utf-8');
        $I->seeResponseIsJson();

        $I->seeResponseContainsJson(
            [
                '@context' => '/contexts/House',
                '@id' => self::ROUTE,
                '@type' => 'hydra:Collection'
            ]
        );
    }

    protected function houseProvider(): array
    {
        return [
            [
                'condition' => 'with empty address and geo coordinates',
                'name' => 'My Home',
                'code' => 201,
                'address' => [],
                'geo' => []
            ],
            [
                'condition' => 'with postal address',
                'name' => 'My Home',
                'code' => 201,
                'geo' => [],
                'address' => [
                    'addressCountry' => 'DE',
                    'addressRegion' => 'NRW',
                    'postalCode' => '53949',
                    'addressLocality' => 'Dahlem',
                    'streetAddress' => 'Bahnhofstraße 24'
                ]
            ],
            [
                'condition' => 'with geo coordinates',
                'name' => 'My Home',
                'code' => 201,
                'address' => [],
                'geo' => [
                    'latitude' => 50.415330,
                    'longitude' => 6.557540
                ]
            ]
        ];
    }

    /**
     * public function tryToGetHouse(FunctionalTester $I): void
     * {
     * $I->amGoingTo('GET a house');
     * $I->sendGet($this->iri);
     *
     * $I->expect('response is successful');
     * $I->seeResponseCodeIsSuccessful();
     * $I->seeHttpHeader('content-type', 'application/ld+json; charset=utf-8');
     * $I->seeResponseIsJson();
     *
* $I->expect('response matches json content');
     * $I->seeResponseContainsJson(
     * [
     * '@context' => '/contexts/House',
     * '@id' => $this->iri,
     * '@type' => 'https://schema.org/House'
     * ]
     * );
     *
     * $I->expect('response matches json type');
     * $I->seeResponseMatchesJsonType(
     * [
     * 'name' => 'string'
     * ]
     * );
     * }

    * public function tryToDeleteHouse(FunctionalTester $I): void
    * {
        * $I->amGoingTo('DELETE a house');
     * $I->sendDelete($this->iri);
     *
     * $I->expect('HTTP Status Code ' . HttpCode::NO_CONTENT . ' (NO_CONTENT)');
     * $I->seeResponseCodeIs(HttpCode::NO_CONTENT);
     *
     * $I->sendGet($this->iri);
     * $I->seeResponseCodeIs(HttpCode::NOT_FOUND);
     *
     * unset($this->iri);
    * }
    **/
}
