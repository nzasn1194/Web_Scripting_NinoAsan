<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $found = false;
    $userFullName = "";

    // Check if users.txt file exists
    if (file_exists("users.txt")) {
        $users = file("users.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        
        if ($users !== false) {
            foreach ($users as $user) {
                $userData = explode("|", $user);
                if (isset($userData[0]) && isset($userData[1]) && isset($userData[2])) {
                    $savedUser = $userData[0];
                    $savedPass = $userData[1];
                    $savedFullName = $userData[2];
                    
                    if ($username == $savedUser && $password == $savedPass) {
                        $found = true;
                        $userFullName = $savedFullName;
                        break;
                    }
                }
            }
        }
    }

    if ($found) {
        echo "<!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <title>Login Success</title>
            <link rel='stylesheet' href='style.css'>
        </head>
        <body>
            <div class='form-container'>
                <h2>Welcome!</h2>
                <p style='text-align: center; color: #333; font-size: 18px;'>
                    Hello, <strong>$userFullName</strong>!<br>
                    You have successfully logged in.
                </p>
                <div style='text-align: center; margin-top: 20px;'>
                    <a href='login.html' style='color: #667eea; text-decoration: none; font-weight: 600;'>← Back to Login</a>
                </div>
            </div>
            <script>
                alert('Welcome, $userFullName! Login successful!');
            </script>
        </body>
        </html>";
    } else {
        echo "<script>
            alert('Invalid username or password!');
            window.history.back();
        </script>";
    }
}
?>
