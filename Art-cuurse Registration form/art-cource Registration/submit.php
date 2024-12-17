<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['fullname']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $course = htmlspecialchars($_POST['course']);
    $dob = htmlspecialchars($_POST['dob']);
    $experience = htmlspecialchars($_POST['experience']);
    $comments = htmlspecialchars($_POST['comments']);


    if (empty($name) || empty($email) || empty($phone) || empty($course) || empty($dob) || empty($experience)) {
        echo "All fields are required!";
        exit;
    }

    
    $servername = "localhost";
    $username = "root"; 
    $password = "";     
    $dbname = "registration_db";


    $conn = new mysqli($servername, $username, $password, $dbname);

    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $stmt = $conn->prepare("INSERT INTO registrations (fullname, email, phone, course, dob, experience, comments) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $name, $email, $phone, $course, $dob, $experience, $comments);

    if ($stmt->execute()) {
        echo "<h2>Registration Successful!</h2>";
        echo "<p><strong>Name:</strong> $name</p>";
        echo "<p><strong>Email:</strong> $email</p>";
        echo "<p><strong>Phone:</strong> $phone</p>";
        echo "<p><strong>Course:</strong> $course</p>";
        echo "<p><strong>Date of Birth:</strong> $dob</p>";
        echo "<p><strong>Experience Level:</strong> $experience</p>";
        echo "<p><strong>Comments:</strong> $comments</p>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
