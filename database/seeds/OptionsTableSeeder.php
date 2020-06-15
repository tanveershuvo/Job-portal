<?php

use Illuminate\Database\Seeder;

class OptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('options')->insert([
            1 => array(
                'option_key' => 'stripe_test_secret_key',
                'option_value' => '',
            ),
            2 => array(
                'option_key' => 'stripe_test_publishable_key',
                'option_value' => '',
            ),
            3 => array(
                'option_key' => 'stripe_live_secret_key',
                'option_value' => '',
            ),
            6 => array(
                'option_key' => 'stripe_live_publishable_key',
                'option_value' => '',
            ),
            7 => array(
                'option_key' => 'date_format',
                'option_value' => 'd/m/Y',
            ),
            8 => array(
                'option_key' => 'default_timezone',
                'option_value' => 'Asia/Dhaka',
            ),
            9 => array(
                'option_key' => 'date_format_custom',
                'option_value' => 'd/m/Y',
            ),
            10 => array(
                'option_key' => 'site_title',
                'option_value' => 'JobPortal',
            ),
            11 => array(
                'option_key' => 'email_address',
                'option_value' => 'tanveershuvos@gmail.com',
            ),
            12 => array(
                'option_key' => 'time_format',
                'option_value' => 'g:i A',
            ),
            13 => array(
                'option_key' => 'time_format_custom',
                'option_value' => 'g:i A',
            ),
            14 => array(
                'option_key' => 'paypal_receiver_email',
                'option_value' => 'tanveershuvos@gmail.com',
            ),
            15 => array(
                'option_key' => 'enable_paypal_sandbox',
                'option_value' => '1',
            ),
            16 => array(
                'option_key' => 'site_name',
                'option_value' => 'Job Portal',
            ),
            17 => array(
                'option_key' => 'default_storage',
                'option_value' => 'public',
            ),
            18 => array(
                'option_key' => 'fb_app_id',
                'option_value' => '691549344753724',
            ),
            19 => array(
                'option_key' => 'fb_app_secret',
                'option_value' => '73af4de3753b43301337036f2b43b775',
            ),
            20 => array(
                'option_key' => 'google_client_id',
                'option_value' => '',
            ),
            21 => array(
                'option_key' => 'google_client_secret',
                'option_value' => '',
            ),
            22 => array(
                'option_key' => 'facebook_url',
                'option_value' => 'https://facebook.com/',
            ),
            23 => array(
                'option_key' => 'linked_in_url',
                'option_value' => '#',
            ),
            24 => array(
                'option_key' => 'google_plus_url',
                'option_value' => '#',
            ),
            25 => array(
                'option_key' => 'github_url',
                'option_value' => '#',
            ),
            26 => array(
                'option_key' => 'site_email_address',
                'option_value' => 'info@customer.com ',
            ),
            27 => array(
                'option_key' => 'currency_sign',
                'option_value' => 'BDT',
            ),
            28 => array(
                'option_key' => 'meta_description',
                'option_value' => 'meta_description',
            ),
            29 => array(
                'option_key' => 'git_app_id',
                'option_value' => '3175cc2e90653c96453f',
            ),
            30 => array(
                'option_key' => 'git_app_secret',
                'option_value' => 'a6e9fd7f261b27636efafdfc999b950feac2cd54',
            ),

        ]);
    }
}
