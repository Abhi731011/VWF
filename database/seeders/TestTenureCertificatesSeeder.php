<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CertificateRequest;
use App\Models\User;
use Carbon\Carbon;

class TestTenureCertificatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create test users with different tenures
        
        // 6+ months user
        $user6Months = User::firstOrCreate(
            ['email' => 'leader@example.com'],
            [
                'name' => 'Community Leader',
                'password' => bcrypt('password'),
                'created_at' => Carbon::now()->subMonths(7), // 7 months ago
            ]
        );

        // 3+ months user
        $user3Months = User::firstOrCreate(
            ['email' => 'volunteer@example.com'],
            [
                'name' => 'Dedicated Volunteer',
                'password' => bcrypt('password'),
                'created_at' => Carbon::now()->subMonths(4), // 4 months ago
            ]
        );

        // 1+ month user
        $user1Month = User::firstOrCreate(
            ['email' => 'newcomer@example.com'],
            [
                'name' => 'New Community Member',
                'password' => bcrypt('password'),
                'created_at' => Carbon::now()->subDays(45), // 45 days ago
            ]
        );

        // Create certificate requests for each tenure
        CertificateRequest::create([
            'user_id' => $user6Months->id,
            'full_name' => 'Community Leader',
            'email' => 'leader@example.com',
            'phone' => '1111111111',
            'address' => '123 Leadership Lane',
            'city' => 'New York',
            'state' => 'NY',
            'country' => 'USA',
            'zip_code' => '10001',
            'image_path' => 'user.png',
            'admin_notes' => 'Exceptional leader with 7 months of service',
            'status' => 'pending',
        ]);

        CertificateRequest::create([
            'user_id' => $user3Months->id,
            'full_name' => 'Dedicated Volunteer',
            'email' => 'volunteer@example.com',
            'phone' => '2222222222',
            'address' => '456 Service Street',
            'city' => 'Los Angeles',
            'state' => 'CA',
            'country' => 'USA',
            'zip_code' => '90210',
            'image_path' => 'user.png',
            'admin_notes' => 'Outstanding volunteer with 4 months of service',
            'status' => 'pending',
        ]);

        CertificateRequest::create([
            'user_id' => $user1Month->id,
            'full_name' => 'New Community Member',
            'email' => 'newcomer@example.com',
            'phone' => '3333333333',
            'address' => '789 Growth Avenue',
            'city' => 'Chicago',
            'state' => 'IL',
            'country' => 'USA',
            'zip_code' => '60601',
            'image_path' => 'user.png',
            'admin_notes' => 'Promising new member with 45 days of service',
            'status' => 'pending',
        ]);

        echo "Created test certificate requests for different tenures:\n";
        echo "- 6+ months: Community Leader (7 months)\n";
        echo "- 3+ months: Dedicated Volunteer (4 months)\n";
        echo "- 1+ month: New Community Member (45 days)\n";
    }
}
