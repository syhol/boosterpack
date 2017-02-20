<?php

use Boosterpack\Data\CachedGenerator;
use Boosterpack\Data\Generator;
use Boosterpack\Data\Vector;
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
            $item4 = $list3->head();
            $item5 = $list4->head();

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

            $output1 = $output2 = [];
            foreach ($list as $item) $output1[] = $item;
            foreach ($list as $item) $output2[] = $item;

            expect($output1)
                ->toEqual($output2)
                ->toHaveLength(20);
        });

        it("can be iterated within an iteration of itself", function() {

            $list = new Generator(function() {
                $a = 1; while ($a <= 3) yield $a++;
            });

            $output = [];
            foreach ($list as $level1) {
                foreach ($list as $level2) {
                    $output[] = $level1 + $level2;
                }
            }

            expect($output)
                ->toEqual([2, 3, 4, 3, 4, 5, 4, 5, 6])
                ->toHaveLength(9);
        });

        it("has functional parity with CacheGenerator", function() {

            $fib = function() {
                $i = 0;
                $k = 1; //first fibonacci value
                yield $k;
                while(true)
                {
                    $k = $i + $k;
                    $i = $k - $i;
                    yield $k;
                }
            };

            $nocache = new Generator($fib);
            $cached = CachedGenerator::fromGenerator($fib);

            $nocachedResults = $nocache->drop(50)
                ->map(function($a) { return "this is $a."; })
                ->bind(function($a) { return [$a, 'or is it?']; })
                ->tail()
                ->unshift('This is foobar.')
                ->take(5);

            $cachedResults = $cached->drop(50)
                ->map(function($a) { return "this is $a."; })
                ->bind(function($a) { return [$a, 'or is it?']; })
                ->tail()
                ->unshift('This is foobar.')
                ->take(5);

            expect($nocachedResults->toArray())
                ->toEqual($cachedResults->toArray())
                ->toEqual([
                    'This is foobar.',
                    'or is it?',
                    'this is 32951280099.',
                    'or is it?',
                    'this is 53316291173.',
                ]);
        });
    });

    describe("->drop", function() {

        it("can drop items", function() {

            $list1 = new Generator(function() {
                $a = 1; while (true) yield $a++;
            });

            $list1 = $list1->drop(5);
            $list2 = $list1->tail();
            $list3 = $list2->tail();

            expect($list1->head()->orValue(null)->extract())
                ->toEqual(6);

            expect($list2->head()->orValue(null)->extract())
                ->toEqual(7);

            expect($list3->head()->orValue(null)->extract())
                ->toEqual(8);
        });
    });

    describe("->take", function() {

        it("can drop then take items", function() {

            $list1 = new Generator(function() {
                $a = 1; while (true) yield $a++;
            });

            expect($list1->drop(5)->take(3)->toArray())
                ->toEqual([6, 7, 8]);
        });

        it("can take then drop items", function() {
            
            $list1 = new Generator(function() {
                $a = 1; while (true) yield $a++;
            });

            expect($list1->take(10)->drop(4)->toArray())
                ->toEqual([5, 6, 7, 8, 9, 10]);
        });
    });

    describe("Cached Generators", function() {


        it("can take then drop items", function() {

            $list1 = new Generator(function() {
                $a = 1; while (true) yield $a++;
            });

            expect($list1->take(10)->drop(4)->toArray())
                ->toEqual([5, 6, 7, 8, 9, 10]);
        });

        it("compares Generator with CachedGenerator with memorizedGenrator", function() {

            $func = function() {
                $a = 1; while ($a <= 20) {
                    echo "test $a";
                    yield $a++;
                }
            };

            $generator = new Generator($func);
            $cached = CachedGenerator::fromGenerator($func);
            $memorized = \Boosterpack\memorizeGenerator($func);

            expect([$generator, 'head'])->toEcho('test 1');
            expect([$generator, 'head'])->toEcho('test 1');

            expect([$cached, 'head'])->toEcho('test 1');
            expect([$cached, 'head'])->not->toEcho('test 1');

            expect([$memorized, 'head'])->toEcho('test 1');
            expect([$memorized, 'head'])->not->toEcho('test 1');
        });

        it("memorizedGenrator is all the things", function() {

            $currentIteration = 0;
            $func = function() use(&$currentIteration) {
                $a = 1; while ($a <= 20) {
                    $currentIteration++;
                    yield $a++;
                }
            };

            $memorized = \Boosterpack\memorizeGenerator($func);

            expect($currentIteration)->toEqual(0);
            expect($memorized->head()->orValue(null)->extract())->toEqual(1);
            expect($currentIteration)->toEqual(1);
            expect($memorized->tail()->head()->orValue(null)->extract())->toEqual(2);
            expect($currentIteration)->toEqual(2);
            expect($memorized->take(2)->toArray())->toEqual([1, 2]);
            expect($currentIteration)->toEqual(2);

            expect($memorized->take(5)->toArray())->toEqual([1, 2, 3, 4, 5]);
            expect($currentIteration)->toEqual(5);
            expect($memorized->drop(3)->take(5)->toArray())->toEqual([4, 5, 6, 7, 8]);
            expect($currentIteration)->toEqual(8);
        });
    });
});
