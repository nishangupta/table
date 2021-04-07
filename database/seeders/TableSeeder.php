<?php

namespace Database\Seeders;

use App\Models\Food;
use App\Models\Menu;
use App\Models\Table;
use App\Models\TableType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [
                'title'=>'Simple',
            ],
        ];

        foreach($items as $item){
            TableType::create(['title'=>$item['title']]);
        }


        $items = [
            [
                'title'=>'Table1',
                'chair'=>'4',
                'status'=>'open',
            ],
            [
                'title'=>'Table2',
                'chair'=>'4',
                'status'=>'open',
            ],
            [
                'title'=>'Table3',
                'chair'=>'4',
                'status'=>'open',
            ],
            [
                'title'=>'Table4',
                'chair'=>'4',
                'status'=>'open',
            ],
            [
                'title'=>'Table5',
                'chair'=>'4',
                'status'=>'open',
            ],
        ];

        foreach($items as $item){
            Table::create([
                'title'=>$item['title'],
                'chair'=>$item['chair'],
                'status'=>$item['status'],
                'table_type_id'=>1,
            ]);
        }


        Menu::create([
            'title'=>'Fast Food',
        ]);

        //foods
        $items = [
            [
                'title'=>'Momo',
                'price'=>'200',
            ],
            [
                'title'=>'Chowmein',
                'price'=>'300',
            ],
            [
                'title'=>'Pizza',
                'price'=>'300',
            ],
        ];

        foreach($items as $item){
            Food::create([
                'title'=>$item['title'],
                'price'=>$item['price'],
                'menu_id'=>1,
            ]);
        }

    }
}
