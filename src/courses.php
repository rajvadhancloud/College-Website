<?php
session_start();
include("database.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course_id = $_POST["course_id"];
    $user_id = $_SESSION["user_id"];

    $sql = "SELECT course_id FROM user_courses WHERE user_id = ?";

    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die('Prepare failed: ' . $conn->error);
    }

    $stmt->bind_param("i", $user_id);

    $stmt->execute();

    $result = $stmt->get_result();

    $course_ids = [];
    while ($row = $result->fetch_assoc()) {
        $course_ids[] = $row['course_id'];
    }

    $stmt->close();

    if (in_array($course_id, $course_ids)) {
        echo '<script>alert("course already purchased")</script>';
    } else {
        $sql = "INSERT INTO user_courses (user_id, course_id, purchase_date) VALUES (?, ?, NOW())";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die('Prepare failed: ' . $conn->error);
        }
        $stmt->bind_param("ii", $_SESSION["user_id"], $course_id);
        if ($stmt->execute()) {
            echo '<script>alert("' . $course_id . ' course purchased succesfully")</script>';
        } else {
            echo '<script>alert("' . $stmt->error . ' error occured")</script>';
        }

        $stmt->close();
    }
}
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
            <h1 class="mt-10 pt-20 text-center text-8xl font-bold">Courses We Offer</h1>
        </section>



        <?php
        if (isset($_SESSION["username"])) {
            include("database.php");
            $query = "SELECT * FROM courses";
            $result = mysqli_query($conn, $query);
            if ($_SESSION["username"] == "raj") {
                echo '<section>
                <div class="add_btn"><a href="add_course.php"><button class="button_top">Add Courses</button></a></div>
                </section>';
            } else {
                echo '<section>
                <div class="add_btn"><a href="purchased_courses.php"><button class="button_top">Purchased Courses</button></a></div>
                </section>';
            }
            echo '<section>
            <div class="flex justify-around pt-20">';
            if ($result->num_rows > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    $course_id = $row["id"];
                    $name = $row["course_name"];
                    $fileName = $row["image"];
                    $price = $row["price"];
                    $imageUrl = "../assets/uploads/" . $fileName;
                    echo '<div>
                    <form id="textForm" action = "courses.php" method = "POST" >
                    <p class="p-10 text-4xl font-semibold" name="course_name" id="course_name">' . $name . '</p>
                    <input type="hidden" id="hiddenField" name="course_id" value="' . $course_id . '">
                    <img src=' . $imageUrl . ' class="h-72 p-2 pl-6">
                    <div class="flex justify-around pt-10">
                        <p class="text-4xl font-bold">$' . $price . '/-</p>
                        <button type="submit" name = "submit" class="button_top">Buy Now</button>
                    </div>
                    </form>
                    </div>';
                }
            }
            echo '</div>
            </section>';
        } else {
            echo '<section>
            <div class="user_data">Please login to view courses</div>
        </section>';
        }
        ?>


    </main>
</body>

</html>