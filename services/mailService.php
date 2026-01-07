<?php
namespace Ycode\AirBnb\Services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class MailService {
    
    public function sendBookingConfirmation($userEmail, $userName, $rentalName, $checkIn, $checkOut) {
        $mail = new PHPMailer(true);

        try {
            
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com'; // not just gmail , there are others for testing
            $mail->SMTPAuth   = true;
            $mail->Username   = 'YOUR_EMAIL';
            $mail->Password   = 'YOUR_KEY_PASSWORD'; // the key u get from eg. app passwords if using gmail
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
            $mail->Port       = 587;

            // 2. Recipients
            $mail->setFrom('no-reply@airbnb-clone.com', 'Airbnb Clone');
            $mail->addAddress($userEmail, $userName);

            // 3. Content
            $mail->isHTML(true);
            $mail->Subject = 'Booking Confirmation: ' . $rentalName;
            
            // Simple HTML email template
            $emailBody = "
                <div style='font-family: sans-serif; padding: 20px; border: 1px solid #ddd;'>
                    <h1 style='color: #E11D48;'>Booking Confirmed!</h1>
                    <p>Hi <strong>$userName</strong>,</p>
                    <p>You have successfully booked <strong>$rentalName</strong>.</p>
                    <hr>
                    <p><strong>Check-in:</strong> $checkIn</p>
                    <p><strong>Check-out:</strong> $checkOut</p>
                    <hr>
                    <p>You can view your trip details in your dashboard.</p>
                </div>
            ";

            $mail->Body = $emailBody;
            $mail->AltBody = "Hi $userName, your booking for $rentalName is confirmed from $checkIn to $checkOut.";

            $mail->send();
            return true;
        } catch (Exception $e) {
            // For debugging, you can uncomment this:
            // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            return false;
        }
    }
}