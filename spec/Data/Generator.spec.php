<?php

use Boosterpack\Data\Generator;
use Boosterpack\Maybe\Just;

describe("Generators", function() {

    describe("State encapsulation", function() {

        it("can be shifted multiple times without being mutated", function() {

            $list1 = new Generator(function() {
                $a = 1; while (true) yield $a++;
            });

            list($item1, $list2) = $list1->shift();
            list($item2, $list3) = $list2->shift();
            list($item3, $list4) = $list2->shift();

            list($item4) = $list3->shift();
            list($item5) = $list4->shift();

            expect($item1)
                ->not->toEqual($item2)
                ->toEqual(new Just(1));

            expect($item2)
                ->toEqual($item3)
                ->toEqual(new Just(2));

            expect($item3)
                ->not->toEqual($item4)
                ->toEqual(new Just(2));

            expect($item4)
                ->toEqual($item5)
                ->toEqual(new Just(3));
        });

        it("can be iterated multiple times", function() {

            $list = new Generator(function() {
                $a = 1; while ($a <= 20) yield $a++;
            });

            $output1 = [];
            foreach ($list as $item) {
                $output1[] = $item;
            }

            $output2 = [];
            foreach ($list as $item) {
                $output2[] = $item;
            }

            expect($output1)
                ->toEqual($output2)
                ->toHaveLength(20);
        });

    });

});