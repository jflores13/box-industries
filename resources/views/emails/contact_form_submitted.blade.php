<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Form Submission</title>
</head>
<body>
    <h2>New Contact Form Submission</h2>

    <p><strong>Name:</strong> {{ $payload['first_name'] ?? '' }} {{ $payload['last_name'] ?? '' }}</p>
    <p><strong>Email:</strong> {{ $payload['email'] ?? '' }}</p>
    <p><strong>Company:</strong> {{ $payload['company'] ?? '' }}</p>
    <p><strong>Language:</strong> {{ strtoupper($payload['lang'] ?? '') }}</p>

    <hr>

    <p><strong>Message:</strong></p>
    <p style="white-space: pre-wrap;">{{ $payload['message'] ?? '' }}</p>
</body>
</html>


