<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = array(
            array('category_name' => 'IT/Telecommunication', 'category_slug' => 'it-telecommunication'),
            array('category_name' => 'Accounting/Finance', 'category_slug' => 'accounting-finance'),
            array('category_name' => 'Marketing/Sales', 'category_slug' => 'marketing-sales'),
            array('category_name' => 'Law/Legal', 'category_slug' => 'law-legal'),
            array('category_name' => 'Design/Creative', 'category_slug' => 'design-creative'),
        );

        DB::table('categories')->insert($categories);
    }
}
