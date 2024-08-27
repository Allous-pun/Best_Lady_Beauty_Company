<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $username = $_POST['username'] ?? '';
    $fullname = $_POST['fullname'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Validate form data
    if ($password !== $confirm_password) {
        echo json_encode(['success' => false, 'message' => 'Passwords do not match.']);
        exit;
    }

    // Here you would add code to insert the user into your database
    // For example, using PDO or MySQLi to execute an INSERT statement

    // Assuming user creation is successful
    echo json_encode(['success' => true, 'message' => 'User created successfully.']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css"> <!-- Updated path -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> <!-- FontAwesome -->
    <title>Sign Up</title>
    <style>
        /* Inline styles for simplicity */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            margin-top: 50px;
            margin-bottom: 50px;
        }
        .signup-container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 300px;
            text-align: center;
        }
        .signup-container h1 {
            margin-bottom: 20px;
        }
        .signup-container p {
            margin: 10px 0;
        }
        .signup-container a {
            color: #007bff;
            text-decoration: none;
        }
        .signup-container a:hover {
            text-decoration: underline;
        }
        .signup-container form {
            display: flex;
            flex-direction: column;
        }
        .signup-container label {
            margin: 10px 0 5px;
            text-align: left;
        }
        .signup-container input {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .signup-container button {
            padding: 10px;
            background-color: pink;
            border: none;
            border-radius: 4px;
            color: #fff;
            cursor: pointer;
        }
        .signup-container button:hover {
            background-color: #e6a8b4;
        }
        #response {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="signup-container">
        <h1>Sign Up</h1>
        <p>Already have an account? <a href="?page=login">Login</a></p>
        
        <form id="signupForm" action="signup.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
    
            <label for="fullname">Full Name:</label>
            <input type="text" id="fullname" name="fullname" required>
    
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
    
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
    
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
    
            <button type="submit">Sign Up</button>
        </form>

        <div id="response"></div> <!-- For displaying messages -->
    </div>

    <script>
        document.getElementById('signupForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            var form = this;
            var username = document.getElementById('username').value;
            var fullname = document.getElementById('fullname').value;
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;
            var confirmPassword = document.getElementById('confirm_password').value;
            var responseDiv = document.getElementById('response');

            // Basic client-side validation
            if (password !== confirmPassword) {
                responseDiv.innerText = 'Passwords do not match.';
                return;
            }

            var formData = new FormData(form);

            fetch('signup.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Redirect to dashboard
                    window.location.href = '/index.php?page=dashboard';
                } else {
                    responseDiv.innerText = 'An error occurred: ' + data.message;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                responseDiv.innerText = 'An error occurred. Please try again.';
            });
        });
    </script>
</body>
</html>
