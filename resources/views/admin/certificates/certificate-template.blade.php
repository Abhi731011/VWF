<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate of Appreciation</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Open+Sans:wght@300;400;600&display=swap');
        
        body {
            margin: 0;
            padding: 0;
            font-family: 'Open Sans', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .certificate-container {
            width: 800px;
            height: 600px;
            background: {{ $design->background_color ?? '#ffffff' }};
            border: {{ $design->border_width ?? 3 }}px solid {{ $design->border_color ?? '#000000' }};
            position: relative;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        
        .certificate-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: transparent;
            pointer-events: none;
            z-index: 1;
        }
        
        .header {
            text-align: center;
            padding: 40px 60px 20px;
            position: relative;
            z-index: 2;
        }
        
        .logo {
            width: 120px;
            height: auto;
            margin-bottom: 20px;
            filter: drop-shadow(0 4px 8px rgba(0,0,0,0.1));
        }
        
        .organization-name {
            font-family: 'Playfair Display', serif;
            font-size: {{ $design->organization_font_size ?? 18 }}px;
            color: {{ $design->organization_color ?? '#000000' }};
            margin-bottom: 30px;
            font-weight: 600;
            letter-spacing: 1px;
        }
        
        .certificate-title {
            font-family: 'Playfair Display', serif;
            font-size: {{ $design->title_font_size ?? 36 }}px;
            color: {{ $design->title_color ?? '#000000' }};
            margin-bottom: 40px;
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }
        
        .main-content {
            text-align: center;
            padding: 0 60px;
            position: relative;
            z-index: 10;
            min-height: 300px;
        }
        
        .presentation-text {
            font-size: 18px;
            color: {{ $design->text_color ?? '#000000' }};
            margin-bottom: 30px;
            line-height: 1.6;
            position: relative;
            z-index: 3;
        }
        
        .recipient-name {
            font-family: 'Playfair Display', serif;
            font-size: {{ $design->name_font_size ?? 28 }}px;
            color: {{ $design->title_color ?? '#000000' }};
            font-weight: 700;
            margin: 30px 0;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
            border-bottom: 2px solid {{ $design->border_color ?? '#000000' }};
            padding-bottom: 10px;
            display: inline-block;
            position: relative;
            z-index: 3;
        }
        
        .recipient-image {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 3px solid {{ $design->border_color ?? '#000000' }};
            margin: 20px auto;
            display: block;
            object-fit: cover;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        
        .appreciation-text {
            font-size: 18px;
            color: #000000 !important;
            margin: 25px 0;
            line-height: 1.8;
            font-style: italic;
            text-align: center;
            padding: 15px 20px;
            position: relative;
            z-index: 10;
            font-weight: 600;
            background: rgba(255,255,255,0.9);
            border-radius: 8px;
            border: 2px solid rgba(0,0,0,0.1);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .days-together {
            font-size: 20px;
            color: #000000 !important;
            margin: 25px 0;
            font-weight: 700;
            text-align: center;
            position: relative;
            z-index: 10;
            padding: 15px 20px;
            background: rgba(0,0,0,0.1);
            border-radius: 8px;
            border: 2px solid rgba(0,0,0,0.2);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .footer {
            position: absolute;
            bottom: 40px;
            left: 60px;
            right: 60px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            z-index: 2;
        }
        
        .date-section {
            text-align: left;
        }
        
        .date-label {
            font-size: 14px;
            color: {{ $design->text_color ?? '#000000' }};
            margin-bottom: 5px;
        }
        
        .date-value {
            font-size: 16px;
            color: {{ $design->text_color ?? '#000000' }};
            font-weight: 600;
        }
        
        .signature-section {
            text-align: right;
        }
        
        .signature-image {
            width: 80px;
            height: auto;
            margin-bottom: 10px;
        }
        
        .signature-name {
            font-size: {{ $design->signature_font_size ?? 16 }}px;
            color: {{ $design->text_color ?? '#000000' }};
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .signature-title {
            font-size: 14px;
            color: {{ $design->text_color ?? '#000000' }};
        }
        
        .decorative-elements {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            pointer-events: none;
            z-index: 1;
        }
        
        .corner-decoration {
            position: absolute;
            width: 60px;
            height: 60px;
            border: 2px solid {{ $design->border_color ?? '#000000' }};
        }
        
        .corner-decoration.top-left {
            top: 20px;
            left: 20px;
            border-right: none;
            border-bottom: none;
        }
        
        .corner-decoration.top-right {
            top: 20px;
            right: 20px;
            border-left: none;
            border-bottom: none;
        }
        
        .corner-decoration.bottom-left {
            bottom: 20px;
            left: 20px;
            border-right: none;
            border-top: none;
        }
        
        .corner-decoration.bottom-right {
            bottom: 20px;
            right: 20px;
            border-left: none;
            border-top: none;
        }
        
        .side-decoration {
            position: absolute;
            width: 2px;
            height: 100px;
            background: {{ $design->border_color ?? '#000000' }};
            top: 50%;
            transform: translateY(-50%);
        }
        
        .side-decoration.left {
            left: 40px;
        }
        
        .side-decoration.right {
            right: 40px;
        }
        
        .side-decoration::before,
        .side-decoration::after {
            content: '';
            position: absolute;
            width: 8px;
            height: 8px;
            background: {{ $design->border_color ?? '#000000' }};
            border-radius: 50%;
            left: 50%;
            transform: translateX(-50%);
        }
        
        .side-decoration::before {
            top: -20px;
        }
        
        .side-decoration::after {
            bottom: -20px;
        }
        
        .certificate-id {
            font-size: 14px;
            color: {{ $design->text_color ?? '#000000' }};
            margin: 20px 0;
            padding: 10px;
            background: rgba(0,0,0,0.05);
            border-radius: 5px;
            text-align: center;
            font-weight: 600;
            position: relative;
            z-index: 3;
        }
        
        {!! $design->custom_css ?? '' !!}
    </style>
</head>
<body>
    <div class="certificate-container">
        <div class="decorative-elements">
            <div class="corner-decoration top-left"></div>
            <div class="corner-decoration top-right"></div>
            <div class="corner-decoration bottom-left"></div>
            <div class="corner-decoration bottom-right"></div>
            <div class="side-decoration left"></div>
            <div class="side-decoration right"></div>
        </div>
        
        <div class="header">
            <img src="{{ $logoUrl }}" alt="Organization Logo" class="logo">
            <div class="organization-name">{{ $design->organization_name ?? 'Vaishvik Welfare Foundation' }}</div>
            <div class="certificate-title">Certificate of Appreciation</div>
        </div>
        
        <div class="main-content">
            <div class="presentation-text">
                This is to certify that
            </div>
            
            @if($certificateRequest->image_path)
            <img src="{{ $userImageUrl }}" alt="{{ $certificateRequest->full_name }}" class="recipient-image">
            @endif
            
            <div class="recipient-name">{{ $certificateRequest->full_name }}</div>
            
            @if($daysTogether >= 180) {{-- 6+ months --}}
            <div class="appreciation-text">
                has demonstrated exceptional leadership, unwavering commitment, and outstanding service to our community for over six months. Through their visionary leadership, innovative initiatives, and compassionate actions, they have become a cornerstone of our organization's success and made a profound impact on countless lives.
            </div>
            
            <div class="appreciation-text">
                Their exemplary mentorship, strategic thinking, and tireless efforts in community development have inspired countless others to join our noble cause. They have consistently demonstrated exceptional integrity, deep empathy, and an unwavering commitment to social justice, embodying the highest ideals of humanitarian service.
            </div>
            
            <div class="appreciation-text">
                As a recognized leader within our community, they have played a pivotal role in shaping our organization's future direction. Their ability to inspire, motivate, and guide others has created a ripple effect of positive change that extends far beyond our immediate community.
            </div>
            
            <div class="days-together">
                Celebrating {{ $daysTogether }} days of exceptional leadership, shared vision, and transformative impact in building a better tomorrow for all.
            </div>
            
            <div class="appreciation-text">
                We express our deepest gratitude for their remarkable leadership and unwavering dedication. Their legacy of service will continue to inspire future generations of volunteers and community leaders. We are truly honored to have them as a distinguished leader in our extended family and look forward to many more years of collaboration in our shared mission of creating a more compassionate and just world.
            </div>
            
            @elseif($daysTogether >= 90) {{-- 3+ months --}}
            <div class="appreciation-text">
                has demonstrated outstanding dedication, remarkable commitment, and exceptional service to our community for over three months. Through their innovative contributions, compassionate actions, and tireless efforts, they have become an integral part of our organization's mission and made a significant impact on many lives.
            </div>
            
            <div class="appreciation-text">
                Their exemplary work ethic, collaborative spirit, and commitment to excellence have inspired others to contribute more meaningfully to our cause. They have consistently demonstrated integrity, empathy, and a deep understanding of our organization's values and mission.
            </div>
            
            <div class="appreciation-text">
                Their ability to work effectively with diverse teams and their willingness to take on challenging responsibilities have made them a valuable asset to our community. They have shown remarkable growth and development in their role as a dedicated volunteer.
            </div>
            
            <div class="days-together">
                Celebrating {{ $daysTogether }} days of dedicated service, shared commitment, and meaningful impact in building a better tomorrow for all.
            </div>
            
            <div class="appreciation-text">
                We express our heartfelt gratitude for their outstanding contributions and continued dedication. Their commitment to our cause has made a lasting difference, and we are proud to have them as a valued member of our community. We look forward to continued collaboration in our shared mission of creating positive change.
            </div>
            
            @elseif($daysTogether >= 30) {{-- 1+ months --}}
            <div class="appreciation-text">
                has demonstrated commendable dedication, strong commitment, and valuable service to our community for over one month. Through their enthusiastic participation, thoughtful contributions, and genuine care for others, they have made a positive impact on our organization and the lives of those we serve.
            </div>
            
            <div class="appreciation-text">
                Their willingness to learn, adapt, and contribute meaningfully to our mission has been truly inspiring. They have shown great potential and a genuine desire to make a difference in the community, demonstrating the core values that define our organization.
            </div>
            
            <div class="appreciation-text">
                Their positive attitude, reliability, and eagerness to help have made them a welcome addition to our volunteer family. They have embraced our mission with enthusiasm and have shown promising growth in their understanding of community service.
            </div>
            
            <div class="days-together">
                Celebrating {{ $daysTogether }} days of dedicated service, learning, and growing together in our mission to make a positive difference.
            </div>
            
            <div class="appreciation-text">
                We express our sincere appreciation for their valuable contributions and growing commitment to our cause. Their dedication and enthusiasm are truly appreciated, and we are excited to see their continued growth and impact in our community. We look forward to their continued participation in our shared mission.
            </div>
            
            @else {{-- Less than 1 month --}}
            <div class="appreciation-text">
                has demonstrated genuine interest, enthusiasm, and commitment to our community mission. Through their early contributions and willingness to learn, they have shown great promise and a sincere desire to make a positive impact on the lives of others.
            </div>
            
            <div class="appreciation-text">
                Their positive attitude, eagerness to contribute, and openness to learning have made them a valuable addition to our volunteer community. They have embraced our values and mission with enthusiasm, showing the potential for significant future contributions.
            </div>
            
            <div class="days-together">
                Celebrating {{ $daysTogether }} days of enthusiastic participation and growing commitment to our shared mission.
            </div>
            
            <div class="appreciation-text">
                We express our appreciation for their early contributions and commitment to our cause. Their enthusiasm and dedication are truly valued, and we look forward to their continued growth and increased impact in our community. We are excited to support their journey as they become an even more integral part of our mission.
            </div>
            @endif
            
            <div class="certificate-id">
                <strong>Certificate ID:</strong> {{ $certificateRequest->certificate_id }}
            </div>
        </div>
        
        <div class="footer">
            <div class="date-section">
                <div class="date-label">Date of Issue:</div>
                <div class="date-value">{{ now()->format('F d, Y') }}</div>
            </div>
            
            <div class="signature-section">
                @if($design->signature_image)
                <img src="{{ asset('storage/' . $design->signature_image) }}" alt="Signature" class="signature-image">
                @endif
                @if($design->signature_name)
                <div class="signature-name">{{ $design->signature_name }}</div>
                @endif
                @if($design->signature_title)
                <div class="signature-title">{{ $design->signature_title }}</div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
