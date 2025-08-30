# Razorpay Payment Integration Setup

## Prerequisites
1. Razorpay account (sign up at https://razorpay.com)
2. Laravel application with the payment integration code

## Setup Instructions

### 1. Add Razorpay Credentials to .env file

Add the following lines to your `.env` file:

```env
# Razorpay Configuration
RAZORPAY_KEY_ID=rzp_test_YOUR_TEST_KEY_HERE
RAZORPAY_KEY_SECRET=YOUR_TEST_SECRET_HERE
```

### 2. Get Test Credentials

1. Log in to your Razorpay Dashboard
2. Go to Settings > API Keys
3. Generate a new API key pair
4. Use the test mode keys for development

### 3. Test Credentials (for development only)

For testing purposes, you can use these test credentials:

```env
RAZORPAY_KEY_ID=rzp_test_1234567890abcdef
RAZORPAY_KEY_SECRET=1234567890abcdef12345678
```

**Note:** These are test credentials and will not process real payments.

### 4. Test Card Details

Use these test card details for testing:

- **Card Number:** 4111 1111 1111 1111
- **Expiry:** Any future date (e.g., 12/25)
- **CVV:** Any 3 digits (e.g., 123)
- **Name:** Any name
- **3D Secure Password:** 1221

### 5. Features Implemented

✅ Payment Controller with Razorpay integration
✅ Donation form with project-specific donations
✅ Payment verification and success handling
✅ Updated all "Donate Now" buttons to link to payment form
✅ Quick amount selection buttons
✅ Responsive design
✅ Error handling and validation

### 6. Routes Created

- `GET /donate/{projectId?}` - Donation form page
- `POST /payment/create` - Create payment order
- `POST /payment/success` - Handle payment success

### 7. Files Modified/Created

- `app/Http/Controllers/PaymentController.php` - Payment handling
- `config/services.php` - Razorpay configuration
- `routes/web.php` - Payment routes
- `resources/views/landing/donation/form.blade.php` - Donation form
- Updated all "Donate Now" buttons in:
  - `resources/views/landing/header.blade.php`
  - `resources/views/landing/main.blade.php`
  - `resources/views/landing/causes/index.blade.php`

### 8. Testing

1. Start your Laravel application
2. Navigate to any page with "Donate Now" buttons
3. Click on "Donate Now" to open the donation form
4. Fill in the form and click "Donate Now"
5. Use the test card details above
6. Complete the payment process

### 9. Production Setup

For production:

1. Replace test credentials with live credentials
2. Update the Razorpay key in your production environment
3. Test thoroughly with small amounts first
4. Implement proper error logging
5. Add donation tracking to your database

### 10. Security Notes

- Never commit real API keys to version control
- Always use environment variables for sensitive data
- Implement proper validation and sanitization
- Use HTTPS in production
- Monitor payment logs regularly
