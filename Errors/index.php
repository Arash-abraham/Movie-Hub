<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Forbidden</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #0e0d0d, #ced6d6);
            font-family: Arial, sans-serif;
        }
        .container {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            text-align: center;
            max-width: 400px;
            animation: fadeIn 0.5s ease-in-out;
        }
        h1 {
            font-size: 6rem;
            color: #ff4444;
            margin: 0;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
        }
        h2 {
            font-size: 1.75rem;
            color: #333;
            margin-bottom: 1rem;
        }
        p {
            color: #666;
            margin-bottom: 2rem;
        }
        .btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            background-color: #4ecdc4;
            color: white;
            text-decoration: none;
            border-radius: 25px;
            font-weight: bold;
            transition: background-color 0.3s, transform 0.2s;
        }
        .btn:hover {
            background-color: #45b7b0;
            transform: translateY(-2px);
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>403</h1>
        <h2>Forbidden!</h2>
        <p>Sorry, you don’t have permission to access this page.</p>
        <a href="http://localhost/MVC/" class="btn">Back to Home</a>
    </div>
</body>
</html>
<?php
    header("HTTP/1.1 403 Forbidden");
    exit;
?>
