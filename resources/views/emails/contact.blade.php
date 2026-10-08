<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
</head>
<body style="font-family:Arial,Helvetica,sans-serif;color:#1f2937;">
    <h2 style="color:#4f46e5;">New Contact Message</h2>
    <p><strong>Name:</strong> {{ $message->name }}</p>
    <p><strong>Email:</strong> {{ $message->email }}</p>
    <p><strong>Phone:</strong> {{ $message->phone ?: '—' }}</p>
    <p><strong>Subject:</strong> {{ $message->subject ?: '—' }}</p>
    <hr>
    <p style="white-space:pre-line;">{{ $message->message }}</p>
</body>
</html>
