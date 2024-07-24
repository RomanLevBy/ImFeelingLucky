<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8"/>
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    />
    <title>Registration Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f3f3;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .main {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            padding: 20px;
            width: 500px;
            margin-bottom: 20px;
            font-size: 25px;
        }

        .main .link {
            color: #c10101;
        }
    </style>
</head>
<body>
<div class="main">
    Here is a <a class="link" href="{{ route('link.show', ['hash' => $link->hash]) }}">lucky link</a> !
</div>
</body>
</html>
