<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate Approved</title>
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
        .button {
            display: inline-block;
            background: #28a745;
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
        <h1>🎉 Congratulations!</h1>
        <h2>Your Certificate Request Has Been Approved</h2>
    </div>
    
    <div class="content">
        <p>Dear {{ $name }},</p>
        
        <p>We are delighted to inform you that your certificate request has been <strong>approved</strong>!</p>
        
        <p>Your certificate of appreciation has been generated and is ready for download. This certificate recognizes your valuable contributions to our community and your commitment to making a positive impact.</p>
        
        <p><strong>Request ID:</strong> {{ $request_id ?? 'N/A' }}</p>
        <p><strong>Certificate ID:</strong> {{ $certificate_id ?? 'N/A' }}</p>
        
        <p>You can view and download your certificate by clicking the button below:</p>
        
        <div style="text-align: center;">
            <a href="{{ asset($certificate_path) }}" class="button" target="_blank">
                📜 View Your Certificate
            </a>
        </div>
        
        <p>We sincerely appreciate your dedication and look forward to continued collaboration in our shared mission of service and compassion.</p>
        
        <p>If you have any questions or need assistance, please don't hesitate to contact us.</p>
        
        <p>Best regards,<br>
        <strong>Vaishvik Welfare Foundation Team</strong></p>
    </div>
    
    <div class="footer">
        <p>This is an automated message. Please do not reply to this email.</p>
        <p>© {{ date('Y') }} Vaishvik Welfare Foundation. All rights reserved.</p>
    </div>
</body>
</html>
