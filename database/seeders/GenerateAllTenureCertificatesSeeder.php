<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CertificateRequest;
use App\Models\CertificateDesign;
use App\Models\User;
use Carbon\Carbon;

class GenerateAllTenureCertificatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->generateCertificate('1 Month User', 'test1month@example.com', Carbon::now()->subDays(45), 'One Month Dedication Certificate');
        $this->generateCertificate('3 Month User', 'test3month@example.com', Carbon::now()->subDays(120), 'Three Months Excellence Certificate');
        $this->generateCertificate('6 Month User', 'test6month@example.com', Carbon::now()->subDays(200), 'Six Months Leadership Certificate');
        
        echo "All tenure certificates generated successfully!\n";
    }

    private function generateCertificate($name, $email, $createdAt, $designName)
    {
        // Create a test user
        $user = User::firstOrCreate(
            ['email' => $email],
            [
                'name' => $name,
                'password' => bcrypt('password'),
                'created_at' => $createdAt,
            ]
        );

        // Create a certificate request
        $request = CertificateRequest::create([
            'user_id' => $user->id,
            'full_name' => $name,
            'email' => $email,
            'phone' => '1234567890',
            'address' => '123 Test Street',
            'city' => 'Test City',
            'state' => 'TS',
            'country' => 'USA',
            'zip_code' => '12345',
            'image_path' => 'user.png',
            'admin_notes' => 'Test certificate for ' . $designName,
            'status' => 'pending',
        ]);

        // Get the certificate design
        $design = CertificateDesign::where('name', $designName)->first();

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

            echo "Generated: " . $name . " - " . $filename . "\n";
        }
    }
}
