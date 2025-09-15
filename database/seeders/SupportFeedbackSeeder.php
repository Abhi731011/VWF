<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SupportFeedback;
use App\Models\User;

class SupportFeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the first user or create one if none exists
        $user = User::first();
        if (!$user) {
            $user = User::create([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => bcrypt('password'),
            ]);
        }

        // Create sample support feedback entries
        $supportFeedbacks = [
            [
                'user_id' => $user->id,
                'type' => 'support',
                'subject' => 'Unable to access my account',
                'message' => 'I am having trouble logging into my account. I keep getting an error message when I try to log in.',
                'priority' => 'high',
                'category' => 'Account Issues',
                'status' => 'open',
                'admin_response' => null,
                'resolved_at' => null,
            ],
            [
                'user_id' => $user->id,
                'type' => 'feedback',
                'subject' => 'Great website design',
                'message' => 'I really love the new design of the website. The user interface is much more intuitive now.',
                'priority' => 'low',
                'category' => 'General Feedback',
                'status' => 'resolved',
                'admin_response' => 'Thank you for your positive feedback! We appreciate your kind words.',
                'resolved_at' => now()->subDays(2),
            ],
            [
                'user_id' => $user->id,
                'type' => 'bug_report',
                'subject' => 'Payment form not working',
                'message' => 'When I try to make a donation, the payment form shows an error and does not process the payment.',
                'priority' => 'urgent',
                'category' => 'Payment Issues',
                'status' => 'in_progress',
                'admin_response' => 'We are investigating this issue. Our technical team is working on a fix.',
                'resolved_at' => null,
            ],
            [
                'user_id' => $user->id,
                'type' => 'feature_request',
                'subject' => 'Add dark mode option',
                'message' => 'It would be great if you could add a dark mode option to the website. This would be very helpful for users who prefer dark themes.',
                'priority' => 'medium',
                'category' => 'Feature Request',
                'status' => 'open',
                'admin_response' => null,
                'resolved_at' => null,
            ],
            [
                'user_id' => $user->id,
                'type' => 'support',
                'subject' => 'Password reset not working',
                'message' => 'I tried to reset my password but I did not receive the reset email. Please help.',
                'priority' => 'high',
                'category' => 'Account Issues',
                'status' => 'closed',
                'admin_response' => 'Password reset functionality has been fixed. Please try again.',
                'resolved_at' => now()->subDays(1),
            ],
        ];

        foreach ($supportFeedbacks as $feedback) {
            SupportFeedback::create($feedback);
        }
    }
}