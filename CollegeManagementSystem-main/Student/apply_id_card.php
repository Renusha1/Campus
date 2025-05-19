<?php
session_start();
if (!isset($_SESSION["name"])) {
    header("Location: StudentLogin.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Normally, insert into DB. Simulating success message here.
    $success = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Apply for ID Card</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-8">
    <h1 class="text-3xl font-bold mb-6">Apply for ID Card</h1>

    <?php if (!empty($success)): ?>
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">Your application has been submitted!</div>
    <?php endif; ?>

    <form method="POST" class="bg-white p-6 rounded shadow w-full max-w-md">
        <div class="mb-4">
            <label class="block mb-1 font-medium">Full Name</label>
            <input type="text" name="fullname" class="w-full border rounded px-3 py-2" required
                value="<?= htmlspecialchars($_SESSION["name"]) ?>" />
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium">Reason for New ID</label>
            <textarea name="reason" class="w-full border rounded px-3 py-2" required></textarea>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Submit
            Application</button>
    </form>
</body>

</html>