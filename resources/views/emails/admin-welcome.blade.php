<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Admin Panel</title>
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
            background-color: #007bff;
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
            color: #007bff;
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
            background-color: #007bff;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }
        .button:hover {
            background-color: #0056b3;
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
    </style>
</head>
<body>
    <div class="header">
        <h1>Welcome to Admin Panel</h1>
        <p>Your account has been created successfully!</p>
    </div>
    
    <div class="content">
        <h2>Hello {{ $name }},</h2>
        
        <p>Welcome to our NGO Admin Panel! Your administrator account has been created and you can now access the system.</p>
        
        <div class="credentials">
            <h3>Your Login Credentials</h3>
            <p><strong>Email:</strong> {{ $email }}</p>
            <p><strong>Password:</strong> {{ $password }}</p>
        </div>
        
        <div class="warning">
            <strong>Important Security Notice:</strong> Please change your password immediately after your first login for security purposes.
        </div>
        
        <p>You can access the admin panel using the following link:</p>
        <a href="{{ $login_url ?? 'http://localhost/ngo/login' }}" class="button">Login to Admin Panel</a>
        
        <h3>What you can do:</h3>
        <ul>
            <li>Manage projects and events</li>
            <li>View and respond to contact inquiries</li>
            <li>Manage packages and subscriptions</li>
            <li>Update your profile information</li>
            <li>Access comprehensive reporting tools</li>
        </ul>
        
        <p>If you have any questions or need assistance, please don't hesitate to contact our support team.</p>
        
        <p>Best regards,<br>
        NGO Management Team</p>
    </div>
    
    <div class="footer">
        <p>This is an automated message. Please do not reply to this email.</p>
        <p>&copy; {{ date('Y') }} NGO Management System. All rights reserved.</p>
    </div>
</body>
</html>
