<?php

// ==========================
// 1. GET FORM DATA
// ==========================
$name    = $_POST['name'] ?? '';
$email   = $_POST['email'] ?? '';
$website = $_POST['website'] ?? '';
$comment = $_POST['comment'] ?? '';
$gender  = $_POST['gender'] ?? '';

// ==========================
// 2. VALIDATION (BASIC)
// ==========================
if (empty($name) || empty($email) || empty($gender)) {
    die("Required fields are missing!");
}

// ==========================
// 3. DB CONNECTION DETAILS
// ==========================
$servername = "db ip";   // DB SERVER PRIVATE IP
$username   = "root";       // DB USER (NOT root)
$password   = "Password";      // DB PASSWORD
$dbname     = "facebook";      // DATABASE NAME

// ==========================
// 4. CREATE CONNECTION
// ==========================
$conn = mysqli_connect($servername, $username, $password, $dbname);

// CHECK CONNECTION
if (!$conn) {
    die("DB Connection failed: " . mysqli_connect_error());
}

// ==========================
// 5. INSERT QUERY (SAFE)
// ==========================
$sql = "INSERT INTO users (name, email, website, comment, gender)
        VALUES (?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "sssss", $name, $email, $website, $comment, $gender);

    if (mysqli_stmt_execute($stmt)) {
        echo "✅ Data inserted successfully!";
    } else {
        echo "❌ Error inserting data: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
} else {
    echo "❌ Query preparation failed!";
}

// ==========================
// 6. CLOSE CONNECTION
// ==========================
mysqli_close($conn);

?>
