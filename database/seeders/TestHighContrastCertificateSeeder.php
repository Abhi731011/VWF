<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CertificateRequest;
use App\Models\CertificateDesign;
use App\Models\User;
use Carbon\Carbon;

class TestHighContrastCertificateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a test user with 7 months tenure
        $user = User::firstOrCreate(
            ['email' => 'testcontrast@example.com'],
            [
                'name' => 'Test Contrast User',
                'password' => bcrypt('password'),
                'created_at' => Carbon::now()->subMonths(7),
            ]
        );

        // Create a certificate request
        $request = CertificateRequest::create([
            'user_id' => $user->id,
            'full_name' => 'Test Contrast User',
            'email' => 'testcontrast@example.com',
            'phone' => '1234567890',
            'address' => '123 Test Street',
            'city' => 'Test City',
            'state' => 'TS',
            'country' => 'USA',
            'zip_code' => '12345',
            'image_path' => 'user.png',
            'admin_notes' => 'Test certificate with high contrast for visibility',
            'status' => 'pending',
        ]);

        // Create a high contrast certificate design
        $design = CertificateDesign::create([
            'name' => 'High Contrast Test Certificate',
            'description' => 'High contrast certificate for testing visibility',
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
                    font-weight: 600 !important;
                    background: rgba(255,255,255,0.9) !important;
                    padding: 15px !important;
                    border-radius: 5px !important;
                    margin: 15px 0 !important;
                }
                .days-together {
                    color: #000000 !important;
                    font-weight: 700 !important;
                    background: rgba(0,0,0,0.1) !important;
                    padding: 15px !important;
                    border-radius: 5px !important;
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

        echo "High contrast certificate generated successfully!\n";
        echo "Certificate ID: " . $request->certificate_id . "\n";
        echo "File: " . $filename . "\n";
        echo "Access URL: http://localhost/ngo/certificates/" . $filename . "\n";
    }
}
