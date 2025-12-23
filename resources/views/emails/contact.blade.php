<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #2A2A2A;
            color: #FCFAF0;
            padding: 20px;
            text-align: center;
        }
        .content {
            padding: 30px;
            background-color: #f9f9f9;
        }
        .info {
            background-color: white;
            padding: 15px;
            margin: 10px 0;
            border-left: 4px solid #2A2A2A;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Nuovo messaggio per SXL Arch</h2>
        </div>
        <div class="content">
            <div class="info">
                <strong>Da:</strong> {{ $first_name }} {{ $last_name }}
            </div>
            <div class="info">
                <strong>Email:</strong> {{ $email }}
            </div>
            <div class="info">
                <strong>Messaggio:</strong> {{ $user_message }}
            </div>
        </div>
    </div>
</body>
</html>