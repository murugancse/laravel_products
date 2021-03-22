<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          $category = [
            [
               'name'=>'Stationary',
                'status'=>'1'
            ],
            [
               'name'=>'Electronics',
                'status'=>'1'
            ],
        ];
  
        foreach ($category as $key => $value) {
            Category::create($value);
        }
    }
}
