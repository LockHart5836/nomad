<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmed</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
        }
        .email-header {
            background: linear-gradient(135deg, #a41e34, #d63447);
            color: white;
            padding: 2rem;
            text-align: center;
        }
        .email-header h1 {
            margin: 0;
            font-size: 1.8rem;
        }
        .email-body {
            padding: 2rem;
        }
        .success-icon {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        .success-icon .checkmark {
            width: 80px;
            height: 80px;
            background: #22c55e;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            color: white;
        }
        .booking-details {
            background: #f8f9fa;
            border-radius: .5rem;
            padding: 1.5rem;
            margin: 1.5rem 0;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: .75rem 0;
            border-bottom: 1px solid #e9ecef;
        }
        .detail-row:last-child {
            border-bottom: none;
        }
        .detail-label {
            font-weight: 600;
            color: #495057;
        }
        .detail-value {
            color: #212529;
        }
        .highlight {
            color: #a41e34;
            font-weight: 700;
            font-size: 1.1rem;
        }
        .info-box {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 1rem;
            margin: 1.5rem 0;
            border-radius: .25rem;
        }
        .info-box h3 {
            margin: 0 0 .5rem 0;
            font-size: 1rem;
            color: #856404;
        }
        .info-box p {
            margin: .25rem 0;
            color: #856404;
            font-size: .9rem;
        }
        .email-footer {
            background: #212529;
            color: #adb5bd;
            padding: 1.5rem;
            text-align: center;
            font-size: .9rem;
        }
        .email-footer a {
            color: #d63447;
            text-decoration: none;
        }
        .button {
            display: inline-block;
            padding: .75rem 1.5rem;
            background: linear-gradient(135deg, #a41e34, #d63447);
            color: white;
            text-decoration: none;
            border-radius: .5rem;
            margin: 1rem 0;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="email-header">
            <h1>🚗 StacyGarage</h1>
            <p style="margin: .5rem 0 0 0;">Your trusted car rental service</p>
        </div>

        <!-- Body -->
        <div class="email-body">
            <!-- Success Icon -->
            <div class="success-icon">
                <div class="checkmark">✓</div>
            </div>

            <h2 style="text-align: center; color: #212529; margin-bottom: 1rem;">Booking Confirmed!</h2>
            <p style="text-align: center; color: #6c757d; font-size: 1rem;">
                Hi <strong>{{ $booking->customer_name }}</strong>, great news! Your booking has been approved.
            </p>

            <!-- Booking Details -->
            <div class="booking-details">
                <h3 style="margin: 0 0 1rem 0; color: #a41e34;">Booking Information</h3>
                
                <div class="detail-row">
                    <span class="detail-label">Reference Number:</span>
                    <span class="detail-value"><strong>#{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</strong></span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Vehicle:</span>
                    <span class="detail-value"><strong>{{ $booking->car->name }}</strong></span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Pick-up Date:</span>
                    <span class="detail-value">{{ \Carbon\Carbon::parse($booking->start_date)->format('F d, Y') }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Return Date:</span>
                    <span class="detail-value">{{ \Carbon\Carbon::parse($booking->end_date)->format('F d, Y') }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Duration:</span>
                    <span class="detail-value">{{ $booking->total_days }} day(s)</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Total Amount:</span>
                    <span class="highlight">₱{{ number_format($booking->total_price, 2) }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Status:</span>
                    <span style="color: #22c55e; font-weight: 600;">✓ Confirmed</span>
                </div>
            </div>

            <!-- Contact Information -->
            @if($booking->customer_phone)
            <div class="detail-row" style="background: #f8f9fa; padding: .75rem; border-radius: .25rem;">
                <span class="detail-label">Your Contact:</span>
                <span class="detail-value">{{ $booking->customer_phone }}</span>
            </div>
            @endif

            <!-- Important Information -->
            <div class="info-box">
                <h3>📋 What's Next?</h3>
                <p>✓ Your booking is now confirmed and ready</p>
                <p>✓ Please arrive 15 minutes before your pickup time</p>
                <p>✓ Bring a valid driver's license and ID</p>
                <p>✓ Payment can be made upon pickup</p>
            </div>

            @if($booking->notes)
            <div style="background: #e7f3ff; border-left: 4px solid #0d6efd; padding: 1rem; margin: 1rem 0; border-radius: .25rem;">
                <h4 style="margin: 0 0 .5rem 0; color: #084298;">Your Notes:</h4>
                <p style="margin: 0; color: #084298;">{{ $booking->notes }}</p>
            </div>
            @endif

            <!-- Call to Action -->
            <div style="text-align: center; margin: 2rem 0;">
                <p style="color: #6c757d;">Have questions? We're here to help!</p>
                <a href="mailto:support@stacygarage.com" class="button">Contact Support</a>
            </div>
        </div>

        <!-- Footer -->
        <div class="email-footer">
            <p><strong>StacyGarage</strong> - Your trusted car rental partner</p>
            <p style="margin: .5rem 0;">
                📍 Location: StacyGarage Office | 📞 Phone: (123) 456-7890<br>
                📧 Email: <a href="mailto:info@stacygarage.com">info@stacygarage.com</a>
            </p>
            <p style="margin-top: 1rem; font-size: .85rem; color: #868e96;">
                This is an automated confirmation email. Please do not reply to this message.
            </p>
        </div>
    </div>
</body>
</html>
