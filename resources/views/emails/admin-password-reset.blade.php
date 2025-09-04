<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset - Admin Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #dc3545;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .content {
            background-color: #f8f9fa;
            padding: 30px;
            border-radius: 0 0 8px 8px;
        }
        .credentials {
            background-color: #e9ecef;
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .credentials h3 {
            color: #dc3545;
            margin-top: 0;
        }
        .credentials p {
            margin: 10px 0;
            font-size: 16px;
        }
        .credentials strong {
            color: #dc3545;
        }
        .button {
            display: inline-block;
            background-color: #dc3545;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }
        .button:hover {
            background-color: #c82333;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            color: #6c757d;
            font-size: 14px;
        }
        .warning {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            color: #856404;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .info {
            background-color: #d1ecf1;
            border: 1px solid #bee5eb;
            color: #0c5460;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Password Reset</h1>
        <p>Your password has been reset</p>
    </div>
    
    <div class="content">
        <h2>Hello {{ $name }},</h2>
        
        <p>Your password for the NGO Admin Panel has been reset by an administrator.</p>
        
        <div class="credentials">
            <h3>Your New Login Credentials</h3>
            <p><strong>Email:</strong> {{ $email }}</p>
            <p><strong>New Password:</strong> {{ $password }}</p>
        </div>
        
        <div class="warning">
            <strong>Security Notice:</strong> For your account security, please change this password immediately after logging in.
        </div>
        
        <div class="info">
            <strong>Note:</strong> This password reset was initiated by an administrator. If you did not request this reset, please contact our support team immediately.
        </div>
        
        <p>You can access the admin panel using the following link:</p>
        <a href="{{ $login_url ?? 'http://localhost/ngo/login' }}" class="button">Login to Admin Panel</a>
        
        <h3>Steps to secure your account:</h3>
        <ol>
            <li>Login with the new credentials provided above</li>
            <li>Go to your profile settings</li>
            <li>Change your password to something secure and memorable</li>
            <li>Consider enabling two-factor authentication if available</li>
        </ol>
        
        <p>If you have any questions or concerns, please contact our support team immediately.</p>
        
        <p>Best regards,<br>
        NGO Management Team</p>
    </div>
    
    <div class="footer">
        <p>This is an automated message. Please do not reply to this email.</p>
        <p>&copy; {{ date('Y') }} NGO Management System. All rights reserved.</p>
    </div>
</body>
</html>
