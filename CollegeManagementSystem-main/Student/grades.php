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
    <title>Grades</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-8">
    <h1 class="text-3xl font-bold mb-6">Your Grades</h1>
    <table class="min-w-full bg-white rounded shadow overflow-hidden">
        <thead>
            <tr class="bg-gray-200 text-left text-gray-700 font-semibold">
                <th class="p-4">Course</th>
                <th class="p-4">Grade</th>
            </tr>
        </thead>
        <tbody>
            <tr class="border-b">
                <td class="p-4">Mathematics</td>
                <td class="p-4">A</td>
            </tr>
            <tr class="border-b">
                <td class="p-4">Physics</td>
                <td class="p-4">B+</td>
            </tr>
            <!-- Add more rows as needed -->
        </tbody>
    </table>
</body>

</html>