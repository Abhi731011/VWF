<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CertificateRequest;
use App\Models\User;

class CertificateRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a test user if it doesn't exist
        $user = User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt('password'),
            ]
        );

        // Create sample certificate requests
        CertificateRequest::create([
            'user_id' => $user->id,
            'full_name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '1234567890',
            'address' => '123 Main Street',
            'city' => 'New York',
            'state' => 'NY',
            'country' => 'USA',
            'zip_code' => '10001',
            'image_path' => 'assets/img/user.png',
            'admin_notes' => 'Test certificate request for demonstration',
            'status' => 'pending',
        ]);

        CertificateRequest::create([
            'user_id' => $user->id,
            'full_name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'phone' => '0987654321',
            'address' => '456 Oak Avenue',
            'city' => 'Los Angeles',
            'state' => 'CA',
            'country' => 'USA',
            'zip_code' => '90210',
            'image_path' => 'assets/img/user.png',
            'admin_notes' => 'Another test certificate request',
            'status' => 'pending',
        ]);
    }
}
