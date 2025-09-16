<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate Request Update</title>
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
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .content {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 0 0 10px 10px;
        }
        .reason-box {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 5px;
            padding: 15px;
            margin: 20px 0;
        }
        .button {
            display: inline-block;
            background: #007bff;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            color: #666;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>📋 Certificate Request Update</h1>
        <h2>Request Status Update</h2>
    </div>
    
    <div class="content">
        <p>Dear {{ $name }},</p>
        
        <p>Thank you for your interest in receiving a certificate of appreciation from Vaishvik Welfare Foundation.</p>
        
        <p>After careful review, we regret to inform you that your certificate request has been <strong>not approved</strong> at this time.</p>
        
        <div class="reason-box">
            <h4>Reason for Rejection:</h4>
            <p><em>{{ $rejection_reason }}</em></p>
        </div>
        
        <p>We encourage you to continue your involvement with our community and consider reapplying in the future when you meet the requirements.</p>
        
        <p>If you have any questions about this decision or would like to discuss your application further, please don't hesitate to contact us.</p>
        
        <div style="text-align: center;">
            <a href="{{ route('contact') }}" class="button">
                📞 Contact Us
            </a>
        </div>
        
        <p>We appreciate your understanding and continued support of our mission.</p>
        
        <p>Best regards,<br>
        <strong>Vaishvik Welfare Foundation Team</strong></p>
    </div>
    
    <div class="footer">
        <p>This is an automated message. Please do not reply to this email.</p>
        <p>© {{ date('Y') }} Vaishvik Welfare Foundation. All rights reserved.</p>
    </div>
</body>
</html>
