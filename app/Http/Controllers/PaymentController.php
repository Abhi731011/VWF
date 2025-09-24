<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Models\Project;
use App\Models\LandingDonation;

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
            'message' => 'nullable|string|max:1000',
            'referral_volunteer_id' => 'nullable|string|max:255',
        ]);

        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

        $project = null;
        if ($request->project_id) {
            $project = Project::find($request->project_id);
        }

        // Create landing donation record
        $donation = LandingDonation::create([
            'project_id' => $request->project_id,
            'donor_name' => $request->donor_name,
            'donor_email' => $request->donor_email,
            'donor_phone' => $request->donor_phone,
            'amount' => $request->amount,
            'currency' => 'INR',
            'message' => $request->message,
            'referral_volunteer_id' => $request->referral_volunteer_id,
            'is_anonymous' => empty($request->donor_name) && empty($request->donor_email),
            'status' => 'pending',
        ]);

        $orderData = [
            'receipt' => 'landing_donation_' . $donation->id,
            'amount' => $request->amount * 100, // Convert to paise
            'currency' => 'INR',
            'notes' => [
                'donation_id' => $donation->id,
                'donor_name' => $request->donor_name ?? 'Anonymous',
                'donor_email' => $request->donor_email ?? 'anonymous@donor.com',
                'donor_phone' => $request->donor_phone ?? 'N/A',
                'project_id' => $request->project_id,
                'project_title' => $project ? $project->title : 'General Donation',
                'referral_volunteer_id' => $request->referral_volunteer_id,
            ]
        ];

        try {
            $razorpayOrder = $api->order->create($orderData);
            
            // Update donation with order ID
            $donation->update(['razorpay_order_id' => $razorpayOrder['id']]);
            
            return response()->json([
                'success' => true,
                'order_id' => $razorpayOrder['id'],
                'amount' => $request->amount,
                'currency' => 'INR',
                'key' => config('services.razorpay.key'),
                'project' => $project,
                'donation_id' => $donation->id,
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

            // Find the donation record
            $donation = LandingDonation::where('razorpay_order_id', $request->razorpay_order_id)->first();
            
            if ($donation) {
                // Update donation with payment details
                $donation->update([
                    'razorpay_payment_id' => $request->razorpay_payment_id,
                    'razorpay_signature' => $request->razorpay_signature,
                    'status' => 'completed',
                    'payment_details' => $attributes,
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Payment successful! Thank you for your donation.',
                    'payment_id' => $request->razorpay_payment_id,
                    'donation_id' => $donation->id,
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Donation record not found.'
                ], 404);
            }

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
