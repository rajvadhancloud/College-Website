<?php
session_start();
?>

<?php


include("database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['username']) || empty($_POST['password'])) {
        echo '<script>alert("please fill out fields")</script>';
    } else {
        $username = ($_POST['username']);
        $pass = ($_POST['password']);


        $sql = "SELECT * FROM admin WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {

            $row = mysqli_fetch_assoc($result);
            $password = $row["password"];
            $user_id = $row["id"];
            if (password_verify("$pass", $password)) {
                $_SESSION["username"] = $username;
                $_SESSION["user_id"] = $user_id;
                echo '<script>alert("Successfully login")</script>';
                // echo "succesfully login";
            } else {
                echo '<script>alert("wrong password")</script>';
                echo "wrong password";
            }
        } else {
            echo '<script>alert("Wrong username")</script>';

            // echo "wrong username";
        }
    }
}

// Close the connection
$conn->close();
?>

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
            <h1 class="mt-10 pt-20 text-center text-8xl font-bold">Login</h1>
        </section>
        <?php
        if (!isset($_SESSION["username"])) {
            echo '
            <section class="parent">
            <div class="text-center bg-blue-950 container">
                <form action="signin.php" method="POST" class="grid grid-cols-1 form_class">
                    <Label class="text-4xl font-bold p-10 text-white">Username</Label>
                    <div class="text-center"><input type="text" name="username" class="email-input"></div>

                    <label class="text-4xl font-bold p-10 text-white">Password</label>
                    <div class="text-center"><input type="password" name="password" class="email-input"></div>
                    <div class="button_class">
                        <button type="submit" name="submit" class="button_top send_button">login</button>
                    </div>
                    <p class="text-4xl login_text">New user ? <a href="signup.php">signup</a></p>
                </form>
            </div>
        </section>';
        } else {
            echo '<div class="logout_btn"><a href="session_destroy.php"><button class="button_top">Logout</button></a></div>
            <section>
            <div class="user_data">Hello! ' . $_SESSION["username"]  . ' </div>
        </section>';
        }
        ?>

    </main>
</body>

</html>