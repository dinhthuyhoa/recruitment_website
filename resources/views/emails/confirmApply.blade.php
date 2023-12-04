<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Results</title>
</head>
<body>
    <p><strong>Dear {{ $body['candidate_name'] }},</strong></p>
    
    <p>
        @if ($body['result'] === 'Đậu ứng tuyển')
            Congratulations! Your application has been approved.
        @elseif ($body['result'] === 'Trượt ứng tuyển')
            We regret to inform you that your application has been unsuccessful.
        @endif
    </p>

    <p>{{$body['message'] }}</p>

    @if ($body['result'] === 'Trượt ứng tuyển' && !empty($recruiter))
        <p>Your application was reviewed by {{ $body['recruiter']['name'] }}.</p>
    @endif

    <p>Thank you for applying.</p>

    <p>Best regards,<br>Your Company Name</p>
</body>
</html>