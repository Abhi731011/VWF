<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CertificateRequest;

class UpdateCertificateIdsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $requests = CertificateRequest::whereNull('certificate_id')->get();
        
        foreach ($requests as $request) {
            $request->certificate_id = CertificateRequest::generateCertificateId();
            $request->save();
        }
        
        echo "Updated " . $requests->count() . " certificate requests with IDs.\n";
    }
}
