<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Models\Project;

class PaymentController extends Controller
{
    public function createPayment(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'project_id' => 'nullable|exists:projects,id',
            'donor_name' => 'nullable|string|max:255',
            'donor_email' => 'nullable|email',
            'donor_phone' => 'nullable|string|max:20',
        ]);

        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

        $project = null;
        if ($request->project_id) {
            $project = Project::find($request->project_id);
        }

        $orderData = [
            'receipt' => 'donation_' . time(),
            'amount' => $request->amount * 100, // Convert to paise
            'currency' => 'INR',
            'notes' => [
                'donor_name' => $request->donor_name ?? 'Anonymous',
                'donor_email' => $request->donor_email ?? 'anonymous@donor.com',
                'donor_phone' => $request->donor_phone ?? 'N/A',
                'project_id' => $request->project_id,
                'project_title' => $project ? $project->title : 'General Donation',
            ]
        ];

        try {
            $razorpayOrder = $api->order->create($orderData);
            
            return response()->json([
                'success' => true,
                'order_id' => $razorpayOrder['id'],
                'amount' => $request->amount,
                'currency' => 'INR',
                'key' => config('services.razorpay.key'),
                'project' => $project,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create payment order: ' . $e->getMessage()
            ], 500);
        }
    }

    public function paymentSuccess(Request $request)
    {
        $request->validate([
            'razorpay_payment_id' => 'required|string',
            'razorpay_order_id' => 'required|string',
            'razorpay_signature' => 'required|string',
        ]);

        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

        try {
            $attributes = [
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_signature' => $request->razorpay_signature,
            ];

            $api->utility->verifyPaymentSignature($attributes);

            // Payment verified successfully
            // Here you can save the donation details to your database
            // For now, we'll just return a success message

            return response()->json([
                'success' => true,
                'message' => 'Payment successful! Thank you for your donation.',
                'payment_id' => $request->razorpay_payment_id,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Payment verification failed: ' . $e->getMessage()
            ], 400);
        }
    }

    public function showDonationForm($projectId = null)
    {
        $project = null;
        if ($projectId) {
            $project = Project::find($projectId);
        }

        return view('landing.donation.form', compact('project'));
    }
}
