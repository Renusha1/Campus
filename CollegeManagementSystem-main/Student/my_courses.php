<?php
session_start();
if (!isset($_SESSION["name"])) {
    header("Location: StudentLogin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Courses</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-8">
    <h1 class="text-3xl font-bold mb-6">Enrolled Courses</h1>
    <ul class="bg-white rounded shadow divide-y divide-gray-200">
        <li class="p-4">Mathematics</li>
        <li class="p-4">Physics</li>
        <li class="p-4">Computer Science</li>
        <!-- Add more courses as needed -->
    </ul>
</body>

</html>