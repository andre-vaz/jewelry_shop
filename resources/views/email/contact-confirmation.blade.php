<!-- resources/views/email/contact-confirmation.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You for Contacting Us</title>
</head>
<body>
    <p>Hi {{ $name }},</p>

    <p>Thank you for reaching out to us! We've received your message and will get back to you shortly.</p>

    <p>Best regards,<br>
    The {{ config('app.name') }} Team</p>
</body>
</html>
