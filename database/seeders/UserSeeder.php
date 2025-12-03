<?php

namespace Database\Seeders;

use App\Infrastructure\Persistence\Models\UserModel;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'external_id' => 1,
                'first_name' => 'Emily',
                'last_name' => 'Johnson',
                'email' => 'emily.johnson@example.com',
                'phone' => '+81 965-431-3024',
                'birth_date' => '1996-05-30',
                'image' => 'https://dummyjson.com/icon/emilys/128',
                'address' => json_encode([
                    'address' => '626 Main Street',
                    'city' => 'Phoenix',
                    'state' => 'Mississippi',
                    'state_code' => 'MS',
                    'postal_code' => '29112',
                    'coordinates' => [
                        'lat' => -77.16213,
                        'lng' => -92.084824,
                    ],
                    'country' => 'United States',
                ]),
            ],
            [
                'external_id' => 2,
                'first_name' => 'Michael',
                'last_name' => 'Brown',
                'email' => 'michael.brown@example.com',
                'phone' => '+1 234-567-8901',
                'birth_date' => '1995-03-15',
                'image' => 'https://dummyjson.com/icon/michaelb/128',
                'address' => json_encode([
                    'address' => '1234 Oak Avenue',
                    'city' => 'New York',
                    'state' => 'New York',
                    'state_code' => 'NY',
                    'postal_code' => '10001',
                    'coordinates' => [
                        'lat' => 40.7128,
                        'lng' => -74.0060,
                    ],
                    'country' => 'United States',
                ]),
            ],
            [
                'external_id' => 3,
                'first_name' => 'Sarah',
                'last_name' => 'Davis',
                'email' => 'sarah.davis@example.com',
                'phone' => '+1 555-987-6543',
                'birth_date' => '1998-07-22',
                'image' => 'https://dummyjson.com/icon/sarahd/128',
                'address' => json_encode([
                    'address' => '567 Elm Street',
                    'city' => 'Los Angeles',
                    'state' => 'California',
                    'state_code' => 'CA',
                    'postal_code' => '90001',
                    'coordinates' => [
                        'lat' => 34.0522,
                        'lng' => -118.2437,
                    ],
                    'country' => 'United States',
                ]),
            ],
            [
                'external_id' => 4,
                'first_name' => 'James',
                'last_name' => 'Wilson',
                'email' => 'james.wilson@example.com',
                'phone' => '+1 777-123-4567',
                'birth_date' => '1994-11-08',
                'image' => 'https://dummyjson.com/icon/jamesw/128',
                'address' => json_encode([
                    'address' => '890 Maple Road',
                    'city' => 'Chicago',
                    'state' => 'Illinois',
                    'state_code' => 'IL',
                    'postal_code' => '60601',
                    'coordinates' => [
                        'lat' => 41.8781,
                        'lng' => -87.6298,
                    ],
                    'country' => 'United States',
                ]),
            ],
            [
                'external_id' => 5,
                'first_name' => 'Jessica',
                'last_name' => 'Martinez',
                'email' => 'jessica.martinez@example.com',
                'phone' => '+1 888-456-7890',
                'birth_date' => '1997-09-14',
                'image' => 'https://dummyjson.com/icon/jessicam/128',
                'address' => json_encode([
                    'address' => '345 Pine Street',
                    'city' => 'Houston',
                    'state' => 'Texas',
                    'state_code' => 'TX',
                    'postal_code' => '77001',
                    'coordinates' => [
                        'lat' => 29.7604,
                        'lng' => -95.3698,
                    ],
                    'country' => 'United States',
                ]),
            ],
            [
                'external_id' => 6,
                'first_name' => 'Robert',
                'last_name' => 'Garcia',
                'email' => 'robert.garcia@example.com',
                'phone' => '+1 999-654-3210',
                'birth_date' => '1993-01-25',
                'image' => 'https://dummyjson.com/icon/robertg/128',
                'address' => json_encode([
                    'address' => '123 Cedar Lane',
                    'city' => 'Phoenix',
                    'state' => 'Arizona',
                    'state_code' => 'AZ',
                    'postal_code' => '85001',
                    'coordinates' => [
                        'lat' => 33.4484,
                        'lng' => -112.0742,
                    ],
                    'country' => 'United States',
                ]),
            ],
        ];

        foreach ($users as $user) {
            UserModel::create($user);
        }
    }
}
