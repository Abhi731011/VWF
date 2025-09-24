<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CertificateRequest;

class UpdateCertificateRequestIdsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all certificate requests that don't have a request_id
        $certificateRequests = CertificateRequest::whereNull('request_id')->get();
        
        foreach ($certificateRequests as $request) {
            $request->request_id = CertificateRequest::generateRequestId();
            $request->save();
        }
        
        $this->command->info('Updated ' . $certificateRequests->count() . ' certificate requests with request IDs.');
    }
}