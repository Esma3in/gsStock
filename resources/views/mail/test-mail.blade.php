<!-- resources/views/emails/welcome.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Our Platform!</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #007bff;
            text-align: center;
        }

        p {
            margin-bottom: 15px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            color: #777;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #28a745;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome, {{ $name }}!</h1>

        <p>Thank you for joining our platform. We're excited to have you on board!</p>

        <p>We offer a wide range of products to satisfy your needs. </p>

        <p>Feel free to <a href="/" class="button">Explore our products</a> and discover all the amazing features we have to offer.</p>

        <p>If you have any questions, please don't hesitate to contact us at support@example.com.</p>

        <div class="footer">
            © {{ date('Y') }} Your Company Name. All rights reserved.
        </div>
    </div>
</body>
</html>0