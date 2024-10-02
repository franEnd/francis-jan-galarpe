<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = htmlspecialchars($_POST['contact-name']);
    $phone = htmlspecialchars($_POST['contact-phone']);
    $email = htmlspecialchars($_POST['contact-email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['contact-message']);
    
    // Your email address where the form data will be sent
    $to = "francisjangalarpe@gmail.com"; // Replace with your Gmail address
    
    // Create email subject and body
    $email_subject = "New Contact Form Submission: " . $subject;
    $email_body = "You have received a new message from the contact form.\n\n".
                  "Name: $name\n".
                  "Phone: $phone\n".
                  "Email: $email\n".
                  "Subject: $subject\n\n".
                  "Message:\n$message\n";
    
    // Email headers
    $headers = "From: $email\n";
    $headers .= "Reply-To: $email";
    
    // Send the email
    if (mail($to, $email_subject, $email_body, $headers)) {
        // Redirect to a thank-you page or show success message
        echo "Message sent successfully!";
    } else {
        // Show an error message if the email couldn't be sent
        echo "Sorry, something went wrong. Please try again.";
    }
}
?>
