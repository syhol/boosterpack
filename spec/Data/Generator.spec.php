<?php

use Boosterpack\Data\CachedGenerator;
use Boosterpack\Data\Generator;
use Boosterpack\Data\Vector;
use Boosterpack\Maybe\Just;
use Boosterpack\Maybe\Nothing;

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
    });

    describe("::fromEmpty", function() {

        it("returns an empty collection", function() {

            $list = Generator::fromEmpty();

            expect($list->head())
                ->toBeAnInstanceOf(Nothing::class);
        });
    });

    describe("->getEmpty", function() {

        it("returns a just with the first item in the collection", function() {

            $list = new Generator(function() {
                $a = 1; while (true) yield $a++;
            });

            expect($list->head())
                ->toBeAnInstanceOf(Just::class);

            expect($list->getEmpty()->head())
                ->toBeAnInstanceOf(Nothing::class);
        });
    });

    describe("->memorized", function() {

        it("can take then drop items", function() {

            $list1 = new Generator(function() {
                $a = 1; while (true) yield $a++;
            });

            $list2 = $list1->memorize();

            expect($list1->take(10)->drop(4)->toArray())
                ->toEqual([5, 6, 7, 8, 9, 10]);

            expect($list2->take(10)->drop(4)->toArray())
                ->toEqual([5, 6, 7, 8, 9, 10]);
        });

        it("won't run the generator when the same head is requested twice", function() {

            $generator = new Generator(function() {
                $a = 1; while ($a <= 20) {
                    echo "test $a";
                    yield $a++;
                }
            });

            $memorized = $generator->memorize();

            expect([$generator, 'head'])->toEcho('test 1');
            expect([$generator, 'head'])->toEcho('test 1');

            expect([$memorized, 'head'])->toEcho('test 1');
            expect([$memorized, 'head'])->not->toEcho('test 1');
        });

        it("only gets the next value when it needs it", function() {

            $currentIteration = 0;
            $memorized = (new Generator(function() use(&$currentIteration) {
                $a = 1; while ($a <= 20) {
                    $currentIteration++;
                    yield $a++;
                }
            }))->memorize();

            expect($currentIteration)->toEqual(0);
            expect($memorized->head()->expect('Value not found'))->toEqual(1);
            expect($currentIteration)->toEqual(1);
            expect($memorized->tail()->head()->expect('Value not found'))->toEqual(2);
            expect($currentIteration)->toEqual(2);
            expect($memorized->take(2)->toArray())->toEqual([1, 2]);
            expect($currentIteration)->toEqual(2);

            expect($memorized->take(5)->toArray())->toEqual([1, 2, 3, 4, 5]);
            expect($currentIteration)->toEqual(5);
            expect($memorized->drop(3)->take(5)->toArray())->toEqual([4, 5, 6, 7, 8]);
            expect($currentIteration)->toEqual(8);
        });

        it("has functional parity with non memorized generators", function() {

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
            $cached = $nocache->memorize();

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

    describe("->head", function() {

        it("returns a just with the first item in the collection", function() {

            $list = new Generator(function() {
                $a = 1; while (true) yield $a++;
            });

            expect($list->head())
                ->toBeAnInstanceOf(Just::class);

            expect($list->head()->expect('value not found'))
                ->toEqual(1);
        });

        it("returns a nothing from an empty collection", function() {

            $list = new Generator(function() {
                yield 1;
            });

            expect($list->tail()->head())
                ->toBeAnInstanceOf(Nothing::class);
        });
    });

    describe("->tail", function() {

        it("returns a collection with one less item", function() {

            $list = new Generator(function() {
                foreach (range(1, 3) as $a) yield $a;
            });

            expect($list->take(3)->toArray())
                ->toEqual([1, 2, 3]);

            expect($list->tail()->take(3)->toArray())
                ->toEqual([2, 3]);

            expect($list->tail()->tail()->take(3)->toArray())
                ->toEqual([3]);

            expect($list->tail()->tail()->tail()->take(3)->toArray())
                ->toEqual([]);
        });

        it("returns an empty collection when it is already empty or when it only has one", function() {

            $list = new Generator(function() {
                yield 1;
            });

            expect($list->head())
                ->toBeAnInstanceOf(Just::class);

            expect($list->tail()->head())
                ->toBeAnInstanceOf(Nothing::class);
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

            expect($list1->head()->expect('Value not found'))
                ->toEqual(6);

            expect($list2->head()->expect('Value not found'))
                ->toEqual(7);

            expect($list3->head()->expect('Value not found'))
                ->toEqual(8);
        });

        it("can drop more items than it has, and results in an empty collection", function() {

            $list = new Generator(function() {
                foreach (range(1, 5) as $a) yield $a;
            });

            expect($list->drop(3)->take(2)->toArray())
                ->toEqual([4, 5]);

            expect($list->drop(3)->head())
                ->toBeAnInstanceOf(Just::class);

            expect($list->drop(6)->take(2)->toArray())
                ->toEqual([]);

            expect($list->drop(6)->head())
                ->toBeAnInstanceOf(Nothing::class);
        });
    });

    describe("->take", function() {

        it("can drop then take items", function() {

            $list = new Generator(function() {
                $a = 1; while (true) yield $a++;
            });

            expect($list->drop(5)->take(3)->toArray())
                ->toEqual([6, 7, 8]);
        });

        it("can take then drop items", function() {

            $list = new Generator(function() {
                $a = 1; while (true) yield $a++;
            });

            expect($list->take(10)->drop(4)->toArray())
                ->toEqual([5, 6, 7, 8, 9, 10]);
        });
    });

    describe("->unshift", function() {

        it("can add items to a collection", function() {

            $list1 = new Generator(function() {
                $a = 1; while (true) yield $a++;
            });

            $list2 = $list1->unshift('foo')->unshift('bar');

            expect($list2->take(4)->toArray())
                ->toEqual(['bar', 'foo', 1, 2]);
        });

        it("can add items to an empty collection", function() {

            $list = new Generator(function() {
                yield 1;
            });

            expect($list->tail()->unshift('foo')->unshift('bar')->take(3)->toArray())
                ->toEqual(['bar', 'foo']);
        });
    });

    describe("->shift", function() {

        it("can return the head and tail on a normal generator", function() {

            $list = new Generator(function() {
                foreach (range(1, 9) as $a) yield $a;
            });

            list($head, $tail) = $list->shift();

            expect($list->head())
                ->toEqual($head)
                ->toEqual(new Just(1));

            expect($tail->take(20)->toArray())
                ->toEqual($tail->take(20)->toArray())
                ->toEqual([2,3,4,5,6,7,8,9]);
        });

        it("returns a nothing from an empty collection", function() {

            $list = new Generator(function() {
                yield 1;
            });

            list($head, $tail) = $list->tail()->shift();

            expect($head)
                ->toBeAnInstanceOf(Nothing::class);

            expect($tail->take(1)->toArray())
                ->toEqual([]);
        });
    });

    describe("->map", function() {

        it("can map values", function() {

            $list = new Generator(function() {
                foreach (range(1, 5) as $a) yield $a;
            });

            expect($list->map(function ($x) { return $x * 2; })->take(10)->toArray())
                ->toEqual([2, 4, 6, 8, 10]);
        });

        it("will not map anything if there are no values", function() {

            $list = new Generator(function() {
                yield 1;
            });

            $mapper = function ($x) { return $x * 2; };
            expect($list->tail()->map($mapper)->take(10)->toArray())
                ->toEqual([]);
        });
    });

    describe("->bind", function() {

        it("can bind values", function() {

            $list = new Generator(function() {
                foreach (range(1, 8) as $a) yield $a;
            });

            $binder = function ($x) { return $x % 2 === 0 ? [$x, $x] : []; };
            expect($list->bind($binder)->take(10)->toArray())
                ->toEqual([2, 2, 4, 4, 6, 6, 8, 8]);
        });
    });

    describe("->concat", function() {

        it("can combine two generators", function() {

            $list1 = new Generator(function() {
                foreach (range(1, 4) as $a) yield $a;
            });
            $list2 = new Generator(function() {
                foreach (range(5, 8) as $a) yield $a;
            });

            expect($list1->concat($list2)->take(10)->toArray())
                ->toEqual([1, 2, 3, 4, 5, 6, 7, 8]);
        });

        it("can combine a generator and an infinite generator", function() {

            $list1 = new Generator(function() {
                foreach (range(1, 4) as $a) yield $a;
            });
            $list2 = new Generator(function() {
                $a = 1; while (true) yield $a++;
            });

            expect($list1->concat($list2)->take(10)->toArray())
                ->toEqual([1, 2, 3, 4, 1, 2, 3, 4, 5, 6]);
        });
    });

    describe("Iteration", function() {

        it("can iterate", function () {

            $list1 = new Generator(function() {
                foreach (range(1, 4) as $a) yield $a;
            });

            $list2 = [1, 2, 3, 4];

            foreach ($list1 as $key => $item) {
                expect($item)
                    ->toEqual($list2[$key]);
            }
        });
    });
});
