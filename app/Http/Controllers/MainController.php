<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class MainController extends Controller
{
    public function employee_sale(){

        
        $collection = collect([
            [
                'name' => 'John',
                'email' => 'john3@example.com',
                'sales' => [
                    ['customer' => 'The Blue Rabbit Company', 'order_total' => 7444],
                    ['customer' => 'Black Melon', 'order_total' => 1445],
                    ['customer' => 'Foggy Toaster', 'order_total' => 700],
                ],
            ],
            [
                'name' => 'Jane',
                'email' => 'jane8@example.com',
                'sales' => [
                    ['customer' => 'The Grey Apple Company', 'order_total' => 203],
                    ['customer' => 'Yellow Cake', 'order_total' => 8730],
                    ['customer' => 'The Piping Bull Company', 'order_total' => 3337],
                    ['customer' => 'The Cloudy Dog Company', 'order_total' => 5310],
                ],
            ],
            [
                'name' => 'Dave',
                'email' => 'dave1@example.com',
                'sales' => [
                    ['customer' => 'The Acute Toaster Company', 'order_total' => 1091],
                    ['customer' => 'Green Mobile', 'order_total' => 2370],
                ],
            ]
        ]
            );
    
            
            return $collection->map(function (array $item) {
                                return collect(['sale_value'=>collect($item['sales'])->sum('order_total'),'name'=>$item['name']]);
                            })->sortByDesc('sale_value')->first();
                         
    }

    public function rank(){
        
        $scores = collect ([
            ['score' => 76, 'team' => 'A'],
            ['score' => 62, 'team' => 'B'],
            ['score' => 82, 'team' => 'C'],
            ['score' => 86, 'team' => 'D'],
            ['score' => 91, 'team' => 'E'],
            ['score' => 67, 'team' => 'F'],
            ['score' => 67, 'team' => 'G'],
            ['score' => 82, 'team' => 'H'],
        ]);
        
        return  collect($scores)
                ->sortByDesc('score')
                ->zip(range(1, $scores->count()))
                ->map(function ($item){
                    list($score, $rank) = $item;
                        return array_merge($score, ['rank' => $rank]);
                })
                ->groupBy('score')
                ->map(function ($val){
                    $lastRank = $val->pluck('rank')->min();
                    return $val->map(function ($teamRank) use ($lastRank){
                        return array_merge($teamRank, [
                            'rank' => $lastRank,
                        ]);
                    });

                })
                ->collapse()
                ->sortBy('rank');
        

    }
}
