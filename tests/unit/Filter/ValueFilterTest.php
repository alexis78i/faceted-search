<?php

use PHPUnit\Framework\TestCase;
use KSamuel\FacetedSearch\Filter\ValueFilter;
use KSamuel\FacetedSearch\Index\ArrayIndex;
use KSamuel\FacetedSearch\Search;

class ValueFilterTest extends TestCase
{
    public function testSetValue()
    {
        $records = [
            1 => [
                'vendor' => 'Apple',
                'model' => 'Iphone X',
                'price' => 80999,
                'color' => 'white',
                'has_phones' => false,
                'cam_mp' => 20,
                'sale' => true,
            ],
            2 => [
                'vendor' => 'Apple',
                'model' => 'Iphone X Pro Max',
                'price' => 80999,
                'color' => 'black',
                'has_phones' => true,
                'cam_mp' => 40,
                'sale' => true,
            ],
            3 => [
                'vendor' => 'Samsung',
                'model' => 'Galaxy S20',
                'price' => 70599,
                'color' => 'yellow',
                'has_phones' => true,
                'cam_mp' => 105,
                'sale' => true,
            ],
            4 => [
                'vendor' => 'Samsung',
                'model' => 'Galaxy S20',
                'price' => 70599,
                'color' => 'black',
                'has_phones' => true,
                'cam_mp' => 105,
                'sale' => true,
            ],
            5 => [
                'vendor' => 'Samsung',
                'model' => 'Galaxy A5',
                'price' => 15000,
                'color' => 'black',
                'has_phones' => true,
                'cam_mp' => 12,
                'sale' => true,
            ],
            6 => [
                'vendor' => 'Xiaomi',
                'model' => 'MI 9',
                'price' => 26000,
                'color' => 'black',
                'has_phones' => true,
                'cam_mp' => 48,
                'sale' => false,
            ]
        ];
        $index = new ArrayIndex();

        foreach ($records as $id => $item) {
            $index->addRecord($id, $item);
        }
        $facets = new Search($index);
        $filter = new ValueFilter('vendor');
        $filter->setValue(['Test']);
        $filter2 = new ValueFilter('color');
        $filter2->setValue(['white']);
        $result = $facets->find([$filter, $filter2]);
        $this->assertEmpty($result);
    }
}