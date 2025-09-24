<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CertificateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class CertificateRequestController extends Controller
{
    /**
     * Display a listing of certificate requests.
     */
    public function index(Request $request)
    {
        $query = CertificateRequest::with(['user', 'approvedBy', 'rejectedBy']);

        // Apply filters
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('full_name')) {
            $query->where('full_name', 'like', '%' . $request->full_name . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        $certificateRequests = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.certificates.index', compact('certificateRequests'));
    }

    /**
     * Display the specified certificate request.
     */
    public function show(CertificateRequest $certificateRequest)
    {
        $certificateRequest->load(['user', 'approvedBy', 'rejectedBy']);
        
        return view('admin.certificates.show', compact('certificateRequest'));
    }

    /**
     * Approve a certificate request.
     */
    public function approve(Request $request, CertificateRequest $certificateRequest)
    {
        $request->validate([
            'certificate_file' => 'required|file|mimes:pdf|max:10240', // 10MB max
        ]);

        // Generate certificate ID if not exists
        if (empty($certificateRequest->certificate_id)) {
            $certificateRequest->certificate_id = CertificateRequest::generateCertificateId();
        }
        
        // Handle PDF upload
        if ($request->hasFile('certificate_file')) {
            $file = $request->file('certificate_file');
            
            // Create certificates directory in public folder if it doesn't exist
            $publicPath = public_path('certificates');
            if (!file_exists($publicPath)) {
                mkdir($publicPath, 0755, true);
            }
            
            // Generate unique filename
            $filename = 'certificate_' . $certificateRequest->certificate_id . '_' . time() . '.pdf';
            $filePath = $publicPath . '/' . $filename;
            
            // Move uploaded file to public folder
            $file->move($publicPath, $filename);
            
            // Update certificate request
            $certificateRequest->update([
                'status' => 'approved',
                'approved_at' => now(),
                'approved_by' => auth()->id(),
                'certificate_path' => 'certificates/' . $filename,
            ]);

            // Send approval email with certificate
            $this->sendApprovalEmail($certificateRequest);

            return redirect()->route('admin.certificates.show', $certificateRequest)
                ->with('success', 'Certificate request approved successfully and certificate sent via email.');
        }

        return redirect()->back()->with('error', 'Failed to upload certificate file.');
    }

    /**
     * Reject a certificate request.
     */
    public function reject(Request $request, CertificateRequest $certificateRequest)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:1000',
        ]);

        $certificateRequest->update([
            'status' => 'rejected',
            'rejected_at' => now(),
            'rejected_by' => auth()->id(),
            'rejection_reason' => $request->rejection_reason,
        ]);

        // Send rejection email
        $this->sendRejectionEmail($certificateRequest);

        return redirect()->route('admin.certificates.show', $certificateRequest)
            ->with('success', 'Certificate request rejected and notification sent via email.');
    }


    /**
     * Send approval email with certificate.
     */
    private function sendApprovalEmail(CertificateRequest $certificateRequest)
    {
        $data = [
            'name' => $certificateRequest->full_name,
            'request_id' => $certificateRequest->request_id,
            'certificate_path' => $certificateRequest->certificate_path,
            'certificate_id' => $certificateRequest->certificate_id,
        ];

        Mail::send('emails.certificate-approved', $data, function ($message) use ($certificateRequest) {
            $message->to($certificateRequest->email, $certificateRequest->full_name)
                    ->subject('Certificate of Appreciation - Approved');
            
            // Attach the certificate PDF if it exists
            if ($certificateRequest->certificate_path && file_exists(public_path($certificateRequest->certificate_path))) {
                $message->attach(public_path($certificateRequest->certificate_path), [
                    'as' => 'Certificate_of_Appreciation.pdf',
                    'mime' => 'application/pdf',
                ]);
            }
        });
    }

    /**
     * Send rejection email.
     */
    private function sendRejectionEmail(CertificateRequest $certificateRequest)
    {
        $data = [
            'name' => $certificateRequest->full_name,
            'rejection_reason' => $certificateRequest->rejection_reason,
        ];

        Mail::send('emails.certificate-rejected', $data, function ($message) use ($certificateRequest) {
            $message->to($certificateRequest->email, $certificateRequest->full_name)
                    ->subject('Certificate Request - Update');
        });
    }
}
