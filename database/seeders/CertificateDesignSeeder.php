<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CertificateDesign;

class CertificateDesignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CertificateDesign::create([
            'name' => 'Default Certificate Design',
            'description' => 'Beautiful default certificate design with elegant styling',
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
            'border_width' => 3,
            'font_family' => 'serif',
            'title_font_size' => 36,
            'name_font_size' => 28,
            'organization_font_size' => 18,
            'signature_font_size' => 16,
            'custom_css' => '',
            'is_active' => true,
            'is_default' => true,
        ]);
    }
}
