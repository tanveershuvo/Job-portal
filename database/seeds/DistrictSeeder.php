<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $districts = array(
            array('id' => '1', 'division_id' => '1', 'name' => 'Comilla', 'bn_name' => 'কুমিল্লা'),
            array('id' => '2', 'division_id' => '1', 'name' => 'Feni', 'bn_name' => 'ফেনী'),
            array('id' => '3', 'division_id' => '1', 'name' => 'Brahmanbaria', 'bn_name' => 'ব্রাহ্মণবাড়িয়া'),
            array('id' => '4', 'division_id' => '1', 'name' => 'Rangamati', 'bn_name' => 'রাঙ্গামাটি'),
            array('id' => '5', 'division_id' => '1', 'name' => 'Noakhali', 'bn_name' => 'নোয়াখালী'),
            array('id' => '6', 'division_id' => '1', 'name' => 'Chandpur', 'bn_name' => 'চাঁদপুর'),
            array('id' => '7', 'division_id' => '1', 'name' => 'Lakshmipur', 'bn_name' => 'লক্ষ্মীপুর'),
            array('id' => '8', 'division_id' => '1', 'name' => 'Chattogram', 'bn_name' => 'চট্টগ্রাম'),
            array('id' => '9', 'division_id' => '1', 'name' => 'Coxsbazar', 'bn_name' => 'কক্সবাজার'),
            array('id' => '10', 'division_id' => '1', 'name' => 'Khagrachhari', 'bn_name' => 'খাগড়াছড়ি'),
            array('id' => '11', 'division_id' => '1', 'name' => 'Bandarban', 'bn_name' => 'বান্দরবান'),
            array('id' => '12', 'division_id' => '2', 'name' => 'Sirajganj', 'bn_name' => 'সিরাজগঞ্জ'),
            array('id' => '13', 'division_id' => '2', 'name' => 'Pabna', 'bn_name' => 'পাবনা'),
            array('id' => '14', 'division_id' => '2', 'name' => 'Bogura', 'bn_name' => 'বগুড়া'),
            array('id' => '15', 'division_id' => '2', 'name' => 'Rajshahi', 'bn_name' => 'রাজশাহী'),
            array('id' => '16', 'division_id' => '2', 'name' => 'Natore', 'bn_name' => 'নাটোর'),
            array('id' => '17', 'division_id' => '2', 'name' => 'Joypurhat', 'bn_name' => 'জয়পুরহাট'),
            array('id' => '18', 'division_id' => '2', 'name' => 'Chapainawabganj', 'bn_name' => 'চাঁপাইনবাবগঞ্জ'),
            array('id' => '19', 'division_id' => '2', 'name' => 'Naogaon', 'bn_name' => 'নওগাঁ'),
            array('id' => '20', 'division_id' => '3', 'name' => 'Jashore', 'bn_name' => 'যশোর'),
            array('id' => '21', 'division_id' => '3', 'name' => 'Satkhira', 'bn_name' => 'সাতক্ষীরা'),
            array('id' => '22', 'division_id' => '3', 'name' => 'Meherpur', 'bn_name' => 'মেহেরপুর'),
            array('id' => '23', 'division_id' => '3', 'name' => 'Narail', 'bn_name' => 'নড়াইল'),
            array('id' => '24', 'division_id' => '3', 'name' => 'Chuadanga', 'bn_name' => 'চুয়াডাঙ্গা'),
            array('id' => '25', 'division_id' => '3', 'name' => 'Kushtia', 'bn_name' => 'কুষ্টিয়া'),
            array('id' => '26', 'division_id' => '3', 'name' => 'Magura', 'bn_name' => 'মাগুরা'),
            array('id' => '27', 'division_id' => '3', 'name' => 'Khulna', 'bn_name' => 'খুলনা'),
            array('id' => '28', 'division_id' => '3', 'name' => 'Bagerhat', 'bn_name' => 'বাগেরহাট'),
            array('id' => '29', 'division_id' => '3', 'name' => 'Jhenaidah', 'bn_name' => 'ঝিনাইদহ'),
            array('id' => '30', 'division_id' => '4', 'name' => 'Jhalakathi', 'bn_name' => 'ঝালকাঠি'),
            array('id' => '31', 'division_id' => '4', 'name' => 'Patuakhali', 'bn_name' => 'পটুয়াখালী'),
            array('id' => '32', 'division_id' => '4', 'name' => 'Pirojpur', 'bn_name' => 'পিরোজপুর'),
            array('id' => '33', 'division_id' => '4', 'name' => 'Barisal', 'bn_name' => 'বরিশাল'),
            array('id' => '34', 'division_id' => '4', 'name' => 'Bhola', 'bn_name' => 'ভোলা'),
            array('id' => '35', 'division_id' => '4', 'name' => 'Barguna', 'bn_name' => 'বরগুনা'),
            array('id' => '36', 'division_id' => '5', 'name' => 'Sylhet', 'bn_name' => 'সিলেট'),
            array('id' => '37', 'division_id' => '5', 'name' => 'Moulvibazar', 'bn_name' => 'মৌলভীবাজার'),
            array('id' => '38', 'division_id' => '5', 'name' => 'Habiganj', 'bn_name' => 'হবিগঞ্জ'),
            array('id' => '39', 'division_id' => '5', 'name' => 'Sunamganj', 'bn_name' => 'সুনামগঞ্জ'),
            array('id' => '40', 'division_id' => '6', 'name' => 'Narsingdi', 'bn_name' => 'নরসিংদী'),
            array('id' => '41', 'division_id' => '6', 'name' => 'Gazipur', 'bn_name' => 'গাজীপুর'),
            array('id' => '42', 'division_id' => '6', 'name' => 'Shariatpur', 'bn_name' => 'শরীয়তপুর'),
            array('id' => '43', 'division_id' => '6', 'name' => 'Narayanganj', 'bn_name' => 'নারায়ণগঞ্জ'),
            array('id' => '44', 'division_id' => '6', 'name' => 'Tangail', 'bn_name' => 'টাঙ্গাইল'),
            array('id' => '45', 'division_id' => '6', 'name' => 'Kishoreganj', 'bn_name' => 'কিশোরগঞ্জ'),
            array('id' => '46', 'division_id' => '6', 'name' => 'Manikganj', 'bn_name' => 'মানিকগঞ্জ'),
            array('id' => '47', 'division_id' => '6', 'name' => 'Dhaka', 'bn_name' => 'ঢাকা'),
            array('id' => '48', 'division_id' => '6', 'name' => 'Munshiganj', 'bn_name' => 'মুন্সিগঞ্জ'),
            array('id' => '49', 'division_id' => '6', 'name' => 'Rajbari', 'bn_name' => 'রাজবাড়ী'),
            array('id' => '50', 'division_id' => '6', 'name' => 'Madaripur', 'bn_name' => 'মাদারীপুর'),
            array('id' => '51', 'division_id' => '6', 'name' => 'Gopalganj', 'bn_name' => 'গোপালগঞ্জ'),
            array('id' => '52', 'division_id' => '6', 'name' => 'Faridpur', 'bn_name' => 'ফরিদপুর'),
            array('id' => '53', 'division_id' => '7', 'name' => 'Panchagarh', 'bn_name' => 'পঞ্চগড়'),
            array('id' => '54', 'division_id' => '7', 'name' => 'Dinajpur', 'bn_name' => 'দিনাজপুর'),
            array('id' => '55', 'division_id' => '7', 'name' => 'Lalmonirhat', 'bn_name' => 'লালমনিরহাট'),
            array('id' => '56', 'division_id' => '7', 'name' => 'Nilphamari', 'bn_name' => 'নীলফামারী'),
            array('id' => '57', 'division_id' => '7', 'name' => 'Gaibandha', 'bn_name' => 'গাইবান্ধা'),
            array('id' => '58', 'division_id' => '7', 'name' => 'Thakurgaon', 'bn_name' => 'ঠাকুরগাঁও'),
            array('id' => '59', 'division_id' => '7', 'name' => 'Rangpur', 'bn_name' => 'রংপুর'),
            array('id' => '60', 'division_id' => '7', 'name' => 'Kurigram', 'bn_name' => 'কুড়িগ্রাম'),
            array('id' => '61', 'division_id' => '8', 'name' => 'Sherpur', 'bn_name' => 'শেরপুর'),
            array('id' => '62', 'division_id' => '8', 'name' => 'Mymensingh', 'bn_name' => 'ময়মনসিংহ'),
            array('id' => '63', 'division_id' => '8', 'name' => 'Jamalpur', 'bn_name' => 'জামালপুর'),
            array('id' => '64', 'division_id' => '8', 'name' => 'Netrokona', 'bn_name' => 'নেত্রকোণা')
        );

        DB::table('districts')->insert($districts);
    }
}
