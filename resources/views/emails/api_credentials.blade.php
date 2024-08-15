<!DOCTYPE html>
<html>
<head>
    <title>Your API Access Credentials</title>
</head>
<body>
    <h1>API Access Credentials</h1>
    <p>Dear {{ $apiAccessRequest->first_name }},</p>
    <p>Thank you for your request. Here are your API credentials:</p>
    <ul>
        <li><strong>API Key:</strong> {{ $api_key }}</li>
        <li><strong>API Secret:</strong> {{ $api_secret }}</li>
    </ul>
    <p>Please keep these credentials secure.</p>
    <p>Best regards,<br>TIKERAMA</p>
</body>
</html>
