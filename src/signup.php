<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>College</title>
    <link href="output.css" rel="stylesheet" />
    <link href="input.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="bg-primary">
    <header>
        <nav class="flex justify-around p-4 bg-blue-950 text-white text-2xl navbar">
            <div class="hover:text-blue-200">
                <a href="home.php">Home</a>
            </div>
            <div class="hover:text-blue-200">
                <a href="courses.php"> Courses</a>
            </div>
            <div class="hover:text-blue-200">
                <a href="about.php"> About</a>
            </div>
            <div class="hover:text-blue-200">
                <a href="contact.php"> Contact US</a>
            </div>
            <div class="hover:text-blue-200">
                <a href="signin.php">Login</a>
            </div>
        </nav>
    </header>
    <main>
        <section>
            <h1 class="mt-10 pt-20 text-center text-8xl font-bold">Signup</h1>
        </section>
        <section class="parent">
            <div class="text-center bg-blue-950 container">
                <form action="signup.php" method="POST" class="grid grid-cols-1 form_class">
                    <Label class="text-4xl font-bold p-10 text-white">Username</Label>
                    <div class="text-center"><input type="text" name="username" class="email-input"></div>

                    <label class="text-4xl font-bold p-10 text-white">Password</label>
                    <div class="text-center"><input type="password" name="password" class="email-input"></div>
                    <div class="button_class">
                        <button type="submit" name="submit" class="button_top send_button">Signup</button>
                    </div>
                    <p class="text-4xl login_text">Already an user ? <a href="signin.php">login</a></p>
                </form>
            </div>
        </section>
    </main>
</body>

</html>

<?php

include("database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['username']) || empty($_POST['password'])) {
        echo '<script>alert("please fill out fields")</script>';
    } else {
        $username = ($_POST['username']);
        $pass = ($_POST['password']);

        // Hash the password for security
        $password = password_hash($pass, PASSWORD_DEFAULT);

        // Insert data into the users table
        $sql = "INSERT INTO admin (username, password) VALUES ('$username', '$password')";

        if ($conn->query($sql) === TRUE) {
            echo '<script>alert("account created succesfully")</script>';
            // echo "account created succesfully";
        } else {
            echo '<script>alert("account already exist")</script>';
        }
    }
}

// Close the connection
$conn->close();
?>