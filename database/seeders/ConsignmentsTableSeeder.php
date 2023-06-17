<?php

use Illuminate\Database\Seeder;
use App\Models\Consignment;

class ConsignmentsTableSeeder extends Seeder
{
    public function run()
    {
        // Define the dummy data for consignments
        $dummyConsignments = [
            [
                'company' => 'ABC Company',
                'contact' => 'John Doe',
                'addressline1' => '123 Main St',
                'addressline2' => 'Suite 456',
                'addressline3' => '',
                'city' => 'Cityville',
                'country' => 'Countryland',
            ],
            [
                'company' => 'XYZ Corporation',
                'contact' => 'Jane Smith',
                'addressline1' => '789 Park Ave',
                'addressline2' => '',
                'addressline3' => '',
                'city' => 'Townsville',
                'country' => 'Countryland',
            ],
            // Add more dummy consignments as needed
            // ...
        ];

        // Create 10 records by duplicating the dummy consignments
        for ($i = 0; $i < 10; $i++) {
            $randomIndex = array_rand($dummyConsignments);
            $consignmentData = $dummyConsignments[$randomIndex];
            Consignment::create($consignmentData);
        }
    }
}
