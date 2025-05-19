<?php
session_start();
if (!isset($_SESSION["name"])) {
    header("Location: StudentLogin.php");
    exit();
}

// DIRECT DATABASE CONNECTION
$conn = new mysqli('localhost', 'root', '', 'Kiran');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_SESSION["name"];
$stmt = $conn->prepare("SELECT * FROM timetable WHERE student_name = ?");
$stmt->bind_param("s", $name);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Timetable</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="p-8 bg-gray-100">
    <h1 class="text-3xl font-bold mb-6">Your Class Timetable</h1>
    <table class="w-full bg-white rounded shadow">
        <thead>
            <tr class="bg-gray-200 text-left font-semibold">
                <th class="p-4">Day</th>
                <th class="p-4">9AM - 11AM</th>
                <th class="p-4">11AM - 1PM</th>
                <th class="p-4">2PM - 4PM</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr class="border-b">
                    <td class="p-4"><?= htmlspecialchars($row['day']) ?></td>
                    <td class="p-4"><?= htmlspecialchars($row['slot1']) ?></td>
                    <td class="p-4"><?= htmlspecialchars($row['slot2']) ?></td>
                    <td class="p-4"><?= htmlspecialchars($row['slot3']) ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>

</html>