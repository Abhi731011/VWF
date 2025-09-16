<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CertificateRequest;
use App\Models\CertificateDesign;
use App\Models\User;
use Carbon\Carbon;

class GenerateFreshCertificateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a test user with 7 months tenure
        $user = User::firstOrCreate(
            ['email' => 'testleader@example.com'],
            [
                'name' => 'Test Leader',
                'password' => bcrypt('password'),
                'created_at' => Carbon::now()->subMonths(7),
            ]
        );

        // Create a certificate request
        $request = CertificateRequest::create([
            'user_id' => $user->id,
            'full_name' => 'Test Leader',
            'email' => 'testleader@example.com',
            'phone' => '1234567890',
            'address' => '123 Test Street',
            'city' => 'Test City',
            'state' => 'TS',
            'country' => 'USA',
            'zip_code' => '12345',
            'image_path' => 'user.png',
            'admin_notes' => 'Test certificate for 7 months tenure',
            'status' => 'pending',
        ]);

        // Get the 6+ months certificate design
        $design = CertificateDesign::where('name', 'Six Months Leadership Certificate')->first();

        if ($design) {
            // Generate certificate HTML
            $daysTogether = $user->created_at->diffInDays(now());
            $userImageUrl = 'http://localhost/ngo-user/public/uploads/certificates/user.png';
            $logoUrl = asset('assets/img/Logowithname.png');
            
            $html = view('admin.certificates.certificate-template', [
                'certificateRequest' => $request,
                'design' => $design,
                'daysTogether' => $daysTogether,
                'userImageUrl' => $userImageUrl,
                'logoUrl' => $logoUrl
            ])->render();
            
            // Create certificates directory in public folder if it doesn't exist
            $publicPath = public_path('certificates');
            if (!file_exists($publicPath)) {
                mkdir($publicPath, 0755, true);
            }
            
            // Store certificate in public folder
            $filename = 'certificate_' . $request->certificate_id . '_' . time() . '.html';
            $filePath = $publicPath . '/' . $filename;
            
            file_put_contents($filePath, $html);
            
            // Update certificate request
            $request->update([
                'status' => 'approved',
                'approved_at' => now(),
                'approved_by' => 1,
                'certificate_path' => 'certificates/' . $filename,
                'certificate_design_id' => $design->id,
            ]);

            echo "Fresh certificate generated successfully!\n";
            echo "Certificate ID: " . $request->certificate_id . "\n";
            echo "File: " . $filename . "\n";
            echo "Access URL: http://localhost/ngo/certificates/" . $filename . "\n";
        } else {
            echo "Certificate design not found!\n";
        }
    }
}
