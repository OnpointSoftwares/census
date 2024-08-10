<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Digital Census Platform</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            overflow: hidden;
            background: linear-gradient(to bottom, #000, #fff, #ff0000, #fff, #008000);
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #3b3f47;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
            animation: fadeIn 1.5s ease-in-out;
            text-align: center;
        }

        header {
            text-align: center;
            margin-bottom: 20px;
        }

        header h1 {
            color: #fff;
        }

        nav {
            text-align: center;
            margin-bottom: 20px;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
        }

        nav ul li {
            display: inline-block;
            margin-right: 10px;
        }

        nav ul li a {
            text-decoration: none;
            color: #61dafb;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        nav ul li a:hover {
            background-color: #555;
        }

        .content {
            text-align: left;
        }

        .content p {
            color: #ccc;
            line-height: 1.6;
        }

        .content label {
            display: block;
            margin: 10px 0 5px;
        }

        .content input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .content button {
            width: 100%;
            padding: 10px;
            background-color: #61dafb;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .content button:hover {
            background-color: #21a1f1;
        }

        footer {
            text-align: center;
            margin-top: 50px;
            padding: 10px;
            background-color: #444;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Login</h1>
        </header>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="signup.html">Sign Up</a></li>
            </ul>
        </nav>
        <div class="content">
            <form action="login_check.php" method="post">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Login</button>
            </form>
            <?php if (isset($_GET['error']) && $_GET['error'] == '1'): ?>
    <p style="color: red;">Invalid username or password. Please try again.</p>
<?php endif; ?>

            <p>Don't have an account? <a href="signup.html" style="color: #61dafb;">Sign up here</a>.</p>
        </div>
        <footer>
            <p>&copy; 2024 Digital Census Platform. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>
