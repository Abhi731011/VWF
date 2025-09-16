<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CertificateRequest;
use App\Models\CertificateDesign;
use App\Models\User;
use Carbon\Carbon;

class SuperSimpleCertificateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a test user with 7 months tenure
        $user = User::firstOrCreate(
            ['email' => 'testsimple@example.com'],
            [
                'name' => 'Test Simple User',
                'password' => bcrypt('password'),
                'created_at' => Carbon::now()->subMonths(7),
            ]
        );

        // Create a certificate request
        $request = CertificateRequest::create([
            'user_id' => $user->id,
            'full_name' => 'Test Simple User',
            'email' => 'testsimple@example.com',
            'phone' => '1234567890',
            'address' => '123 Test Street',
            'city' => 'Test City',
            'state' => 'TS',
            'country' => 'USA',
            'zip_code' => '12345',
            'image_path' => 'user.png',
            'admin_notes' => 'Super simple certificate for maximum visibility',
            'status' => 'pending',
        ]);

        // Create a super simple certificate design
        $design = CertificateDesign::create([
            'name' => 'Super Simple Certificate',
            'description' => 'Super simple certificate with maximum text visibility',
            'organization_name' => 'Vaishvik Welfare Foundation',
            'organization_logo' => null,
            'signature_image' => null,
            'signature_name' => 'Director',
            'signature_title' => 'Vaishvik Welfare Foundation',
            'background_color' => '#ffffff',
            'border_color' => '#000000',
            'text_color' => '#000000',
            'title_color' => '#000000',
            'organization_color' => '#000000',
            'border_width' => 4,
            'font_family' => 'serif',
            'title_font_size' => 36,
            'name_font_size' => 28,
            'organization_font_size' => 18,
            'signature_font_size' => 16,
            'custom_css' => '
                .certificate-container {
                    background: #ffffff !important;
                }
                .appreciation-text {
                    color: #000000 !important;
                    font-weight: 700 !important;
                    background: #ffff00 !important;
                    padding: 20px !important;
                    border-radius: 10px !important;
                    margin: 20px 0 !important;
                    border: 3px solid #000000 !important;
                    font-size: 20px !important;
                }
                .days-together {
                    color: #000000 !important;
                    font-weight: 800 !important;
                    background: #00ff00 !important;
                    padding: 20px !important;
                    border-radius: 10px !important;
                    border: 3px solid #000000 !important;
                    font-size: 22px !important;
                }
                .main-content {
                    background: rgba(255,255,255,0.95) !important;
                    border-radius: 10px !important;
                    margin: 20px !important;
                    padding: 20px !important;
                }
            ',
            'is_active' => true,
            'is_default' => false,
        ]);

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

        echo "Super simple certificate generated successfully!\n";
        echo "Certificate ID: " . $request->certificate_id . "\n";
        echo "File: " . $filename . "\n";
        echo "Access URL: http://localhost/ngo/certificates/" . $filename . "\n";
    }
}
