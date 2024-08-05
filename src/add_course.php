

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add Courses</title>
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
            <h1 class="mt-10 pt-20 text-center text-8xl font-bold">Add Courses</h1>
        </section>

        <section class="parent">
            <div class="text-center bg-blue-950 container" style="height: 42rem;">
                <form action="add_course.php" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 form_class">
                    <Label class="text-4xl font-bold p-10 text-white">Name</Label>
                    <div class="text-center"><input type="text" name="name" class="email-input"></div>

                    <label class="text-4xl font-bold p-10 text-white">Image</label>
                    <div style="color: white; margin:0 auto; width:50%;" class="text-center"><input type="file" name="image" class="msg-input"></div>
                    <div class="button_class">
                    <Label class="text-4xl font-bold p-0 text-white" style="margin-bottom: 2rem;"   >Price</Label>
                    <div class="text-center" style="margin-top: 2rem;"><input type="number" name="price" class="email-input"></div>
                    <button type="submit" name="submit" class="button_top send_button" style="margin: 0 auto; width:50%; margin-top:2rem;">Submit</button></div>

                </form>
            </div>
        </section>
    </main>
</body>

</html>

<?php
    include("database.php");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $name = $_POST["name"];
        $filename = $_FILES["image"]["name"];
        $price = $_POST["price"];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $allowedTypes = array("jpg","jpeg","png");
        $tempName = $_FILES["image"]["tmp_name"];
        $targetPath =  "../assets/uploads/".$filename;
        if(in_array($ext, $allowedTypes)){
            if(move_uploaded_file($tempName,$targetPath)){
                $query = "INSERT INTO courses (course_name,image,price) VALUES ('$name','$filename','$price')";
                if($conn->query($query) === TRUE){
                    echo '<script>alert("Course added succesfully")</script>';
                    header("Location:courses.php");

                }
                else{
                    echo '<script>alert("Something is wrong")</script>';
                }
            }
            else{
                echo '<script>alert("Invalid file")</script>';

            }
        }
    }
?>