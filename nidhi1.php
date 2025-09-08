<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli("localhost", "root", "anjali12345", "erp_db");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sanitize and collect inputs
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $gender = $_POST['gender'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $district = $_POST['district'];
    $address = $_POST['address'];
    $pincode = $_POST['pincode'];
    $city = $_POST['city'];
    $hobbies = $_POST['hobbies'];

    $stmt = $conn->prepare("INSERT INTO erp_db.registrations
        (first_name, last_name, dob, email, mobile, gender, country, state, district, address, pincode, city, hobbies, registered_at) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");

    $stmt->bind_param("sssssssssssss", 
        $first_name, $last_name, $dob, $email, $mobile, $gender,
        $country, $state, $district, $address, $pincode, $city, $hobbies
    );

    if ($stmt->execute()) {
        echo "Registration successful! <br><br>";
        echo "<p>THANK YOU, <b>$first_name $last_name</b>, for registering.</p>";
        echo "<a href='ERP.html'>Register Another</a>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
