<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $divisions = array(
            array('id' => '1', 'name' => 'Chattagram', 'bn_name' => 'চট্টগ্রাম'),
            array('id' => '2', 'name' => 'Rajshahi', 'bn_name' => 'রাজশাহী'),
            array('id' => '3', 'name' => 'Khulna', 'bn_name' => 'খুলনা'),
            array('id' => '4', 'name' => 'Barisal', 'bn_name' => 'বরিশাল'),
            array('id' => '5', 'name' => 'Sylhet', 'bn_name' => 'সিলেট'),
            array('id' => '6', 'name' => 'Dhaka', 'bn_name' => 'ঢাকা'),
            array('id' => '7', 'name' => 'Rangpur', 'bn_name' => 'রংপুর'),
            array('id' => '8', 'name' => 'Mymensingh', 'bn_name' => 'ময়মনসিংহ')
        );

        DB::table('divisions')->insert($divisions);

    }
}
