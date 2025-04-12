<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Not Found</title>
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
        <h1>404</h1>
        <h2>Not Found!</h2>
        <?php
            if(isset($error_message)) {
                $tagA = '<a href="http://localhost/MVC/" class="btn">Back to Home</a>';
                if($error_message == 'file_not_found') {
                    print '<p>Sorry, This page does not exist.</p>';
                    print $tagA;
                    exit;
                }
                if($error_message == 'class_not_found') {
                    print '<p>Sorry, This class does not exist.</p>';
                    print $tagA;
                    exit;
                }
                if($error_message == 'parameter_not_found') {
                    print '<p>Sorry, This parameter does not exist.</p>';
                    print $tagA;
                    exit;
                }
                if($error_message == 'method_not_found') {
                    print '<p>Sorry, This method does not exist.</p>';
                    print $tagA;
                    exit;
                }
                if($error_message == 'view_not_found') {
                    print '<p>Sorry, This view does not exist.</p>';
                    print $tagA;
                    exit;
                }
            }
            else {
                print '<p>Sorry, This page does not exist.</p>';
            }
        ?>
    </div>
</body>
</html>
