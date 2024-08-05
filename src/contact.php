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
            <h1 class="mt-10 pt-20 text-center text-8xl font-bold">Contact Us</h1>
        </section>
        <section class="parent">
            <div class="text-center bg-blue-950 container">
                <form action="index.php" method="post" class="grid grid-cols-1 form_class">
                    <Label class="text-4xl font-bold p-10 text-white">Email</Label>
                    <div class="text-center"><input type="email" name="email" class="email-input"></div>

                    <label class="text-4xl font-bold p-10 text-white">Message</label>
                    <div class="text-center"><input type="text" name="message" class="msg-input"></div>
                    <div class="button_class">
                    <button type="submit" name="submit" class="button_top send_button">Send</button></div>

                </form>
            </div>
        </section>
    </main>


</body>

</html>