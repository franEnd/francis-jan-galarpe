<?php
// Include PHPMailer library
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST['contact-name'] ?? '';
    $phone = $_POST['contact-phone'] ?? '';
    $email = $_POST['contact-email'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $message = $_POST['contact-message'] ?? '';

    // Check if all fields are filled
    if(empty($name) || empty($phone) || empty($email) || empty($subject) || empty($message)) {
        die("All fields are required.");
    }

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();                                 // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';                // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                          // Enable SMTP authentication
        $mail->Username = 'francisjangalarpe@gmail.com';     // SMTP username
        $mail->Password = 'ybnoseadshit@101';        // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
        $mail->Port = 587;                              // TCP port to connect to

        // Recipients
        $mail->setFrom('francisjangalarpe@gmail.com', 'Your Name');
        $mail->addAddress('francisjangalarpe@gmail.com');    // Add a recipient

        // Content
        $mail->isHTML(false);                           // Set email format to plain text
        $mail->Subject = "New contact form submission: " . $subject;
        $mail->Body    = "You have received a new message from your website's contact form.\n\n" .
                         "Name: $name\n" .
                         "Phone: $phone\n" .
                         "Email: $email\n\n" .
                         "Message:\n$message";

        // Send email
        if ($mail->send()) {
            echo "Message sent successfully!";
        } else {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Invalid request method.";
}
?>
