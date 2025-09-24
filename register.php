<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $gender = $_POST['gender'];
    $hobbies = isset($_POST['hobbies']) ? implode(",", $_POST['hobbies']) : "";
    $country = $_POST['country'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        echo "<script>
            alert('Error: Passwords do not match!');
            window.history.back();
        </script>";
        exit;
    }

    // Check if username already exists
    $userExists = false;
    if (file_exists("users.txt")) {
        $users = file("users.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if ($users !== false) {
            foreach ($users as $user) {
                $userData = explode("|", $user);
                if (isset($userData[0]) && $userData[0] == $username) {
                    $userExists = true;
                    break;
                }
            }
        }
    }

    if ($userExists) {
        echo "<script>
            alert('Error: Username already exists!');
            window.history.back();
        </script>";
        exit;
    }

    // Save user info (username|password|fullname|email|gender|hobbies|country)
    $data = $username . "|" . $password . "|" . $fullname . "|" . $email . "|" . $gender . "|" . $hobbies . "|" . $country . "\n";
    
    if (file_put_contents("users.txt", $data, FILE_APPEND | LOCK_EX) !== false) {
        echo "<script>
            alert('Registration successful! Redirecting to login page...');
            window.location.href = 'login.html';
        </script>";
    } else {
        echo "<script>
            alert('Error: Could not save registration data. Please try again.');
            window.history.back();
        </script>";
    }
}
?>
