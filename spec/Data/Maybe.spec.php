<?php

use Boosterpack\Data\Generator;
use function Boosterpack\maybe;
use Boosterpack\Maybe\Just;
use Boosterpack\Maybe\Nothing;

describe("Maybe", function() {

    it("can be created from a function", function() {
        expect(maybe(null))->toBeAnInstanceOf(Nothing::class);
        expect(maybe(1)->orValue(null)->extract())->toEqual(1);
        expect(maybe(0)->orValue(null)->extract())->toEqual(0);
        expect(maybe(false)->orValue(null)->extract())->toEqual(false);
        expect(maybe(-1)->orValue(null)->extract())->toEqual(-1);
    });

});