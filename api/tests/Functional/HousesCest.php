<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use Codeception\Util\HttpCode;
use Tests\Support\FunctionalTester;
use \Codeception\Attribute\Examples;
use \Codeception\Example;

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

    #[Examples('My Home', 201)]
    #[Examples('', 422)]
    public function tryToCreateHouse(FunctionalTester $I, Example $example): void
    {
        $I->amGoingTo('POST a new house');
        $params = [
            'name' => $example[0]
        ];
        $I->sendPost(self::ROUTE, $params);
        $I->expect('response is successful');
        $I->seeResponseCodeIs($example[1]);
        $I->seeHttpHeader('content-type', 'application/ld+json; charset=utf-8');
        $I->seeResponseIsJson();
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
     **/

    public function tryToGetHouseCollection(FunctionalTester $I): void
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

    /**
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
