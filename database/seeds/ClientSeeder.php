<?php

use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'kyle',
                'address' => 'bentig',
                'phone' => '09876543212',
                'capitalization' => 30000,
                'loan' => 20000
            ],
            [
                'name' => 'crhistian',
                'address' => 'ulbujna',
                'phone' => '09867567881',
                'capitalization' => 90000,
                'loan' => 500000
            ],
            [
                'name' => 'cambangay',
                'address' => 'catmonan',
                'phone' => '0231212344',
                'capitalization' => 60000,
                'loan' => 1200000
            ],
        ];

        foreach($data as $client) {
            \App\Client::create($client);
        }
    }
}
