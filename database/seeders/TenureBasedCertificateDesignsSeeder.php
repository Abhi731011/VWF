<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CertificateDesign;

class TenureBasedCertificateDesignsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1 Month+ Certificate Design
        CertificateDesign::create([
            'name' => 'One Month Dedication Certificate',
            'description' => 'Certificate for users with 1+ months of service',
            'organization_name' => 'Vaishvik Welfare Foundation',
            'organization_logo' => null,
            'signature_image' => null,
            'signature_name' => 'Director',
            'signature_title' => 'Vaishvik Welfare Foundation',
            'background_color' => '#f8f9fa',
            'border_color' => '#28a745',
            'text_color' => '#212529',
            'title_color' => '#28a745',
            'organization_color' => '#28a745',
            'border_width' => 4,
            'font_family' => 'serif',
            'title_font_size' => 32,
            'name_font_size' => 26,
            'organization_font_size' => 16,
            'signature_font_size' => 14,
            'custom_css' => '
                .certificate-container {
                    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
                }
                .certificate-title {
                    color: #28a745;
                    text-shadow: 2px 2px 4px rgba(40, 167, 69, 0.3);
                }
                .recipient-name {
                    color: #28a745;
                    border-bottom: 3px solid #28a745;
                }
            ',
            'is_active' => true,
            'is_default' => false,
        ]);

        // 3 Months+ Certificate Design
        CertificateDesign::create([
            'name' => 'Three Months Excellence Certificate',
            'description' => 'Certificate for users with 3+ months of outstanding service',
            'organization_name' => 'Vaishvik Welfare Foundation',
            'organization_logo' => null,
            'signature_image' => null,
            'signature_name' => 'Director',
            'signature_title' => 'Vaishvik Welfare Foundation',
            'background_color' => '#fff3cd',
            'border_color' => '#ffc107',
            'text_color' => '#212529',
            'title_color' => '#ffc107',
            'organization_color' => '#ffc107',
            'border_width' => 5,
            'font_family' => 'serif',
            'title_font_size' => 36,
            'name_font_size' => 28,
            'organization_font_size' => 18,
            'signature_font_size' => 16,
            'custom_css' => '
                .certificate-container {
                    background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);
                }
                .certificate-title {
                    color: #ffc107;
                    text-shadow: 2px 2px 4px rgba(255, 193, 7, 0.4);
                }
                .recipient-name {
                    color: #ffc107;
                    border-bottom: 3px solid #ffc107;
                }
                .corner-decoration {
                    border-color: #ffc107;
                }
                .side-decoration {
                    background: #ffc107;
                }
            ',
            'is_active' => true,
            'is_default' => false,
        ]);

        // 6 Months+ Certificate Design
        CertificateDesign::create([
            'name' => 'Six Months Leadership Certificate',
            'description' => 'Certificate for users with 6+ months of exceptional leadership and service',
            'organization_name' => 'Vaishvik Welfare Foundation',
            'organization_logo' => null,
            'signature_image' => null,
            'signature_name' => 'Director',
            'signature_title' => 'Vaishvik Welfare Foundation',
            'background_color' => '#d1ecf1',
            'border_color' => '#17a2b8',
            'text_color' => '#212529',
            'title_color' => '#17a2b8',
            'organization_color' => '#17a2b8',
            'border_width' => 6,
            'font_family' => 'serif',
            'title_font_size' => 40,
            'name_font_size' => 30,
            'organization_font_size' => 20,
            'signature_font_size' => 18,
            'custom_css' => '
                .certificate-container {
                    background: linear-gradient(135deg, #d1ecf1 0%, #bee5eb 100%);
                }
                .certificate-title {
                    color: #17a2b8;
                    text-shadow: 3px 3px 6px rgba(23, 162, 184, 0.4);
                }
                .recipient-name {
                    color: #17a2b8;
                    border-bottom: 4px solid #17a2b8;
                }
                .corner-decoration {
                    border-color: #17a2b8;
                    border-width: 3px;
                }
                .side-decoration {
                    background: #17a2b8;
                    width: 3px;
                }
                .certificate-id {
                    background: rgba(23, 162, 184, 0.1);
                    border: 1px solid #17a2b8;
                }
            ',
            'is_active' => true,
            'is_default' => false,
        ]);

        echo "Created 3 tenure-based certificate designs successfully!\n";
    }
}
