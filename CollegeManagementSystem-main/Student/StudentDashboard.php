<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
if (!isset($_SESSION["name"])) {
  header("Location: StudentLogin.php");
  exit();
}

// Dashboard sections with real links
$sections = [
  [
    'title' => 'Fee Payment',
    'content' => "Your current fee balance: <strong>$500</strong>",
    'link' => 'FeePayment.php',
    'btnText' => 'Pay Fees Now'
  ],
  [
    'title' => 'Apply for ID Card',
    'content' => 'Need a new ID card? Apply for it below:',
    'link' => 'apply_id_card.php',
    'btnText' => 'Apply for ID Card'
  ],
  [
    'title' => 'My Courses',
    'content' => 'Manage and view your enrolled courses here.',
    'link' => 'my_courses.php',
    'btnText' => 'View Courses'
  ],
  [
    'title' => 'Timetable',
    'content' => 'Check your class schedule and plan your day accordingly.',
    'link' => 'timetable.php',
    'btnText' => 'View Timetable'
  ],
  [
    'title' => 'Grades',
    'content' => 'Review your grades and academic performance.',
    'link' => 'grades.php',
    'btnText' => 'View Grades'
  ],
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Student Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-cover bg-no-repeat bg-center min-h-screen"
  style="background-image: url('../images/CollegeManagementSystemPic1.jpg');">

  <!-- Overlay for content readability -->
  <div class="bg-black bg-opacity-50 min-h-screen flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-black bg-opacity-60 text-white flex flex-col justify-center items-center p-6">
      <h1 class="text-3xl font-bold mb-10 text-center">Student Dashboard</h1>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8 overflow-y-auto">

      <!-- Top Bar -->
      <div class="flex items-center justify-between bg-white bg-opacity-90 p-4 rounded-lg shadow mb-8">
        <h2 class="text-xl font-semibold">Welcome, <?= htmlspecialchars($_SESSION["name"], ENT_QUOTES, 'UTF-8') ?>!</h2>
        <button class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-full transition"
          onclick="window.location.href='StudentLogout.php'">Logout</button>
      </div>

      <!-- Section Cards -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($sections as $sec): ?>
          <div class="bg-white rounded-xl shadow-lg p-6 transition hover:shadow-2xl">
            <h3 class="text-xl font-semibold mb-2"><?= $sec['title'] ?></h3>
            <p class="mb-4"><?= $sec['content'] ?></p>
            <a href="<?= htmlspecialchars($sec['link']) ?>"
              class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-full transition">
              <?= $sec['btnText'] ?>
            </a>
          </div>
        <?php endforeach; ?>
      </div>

      <!-- Footer -->
      <footer class="mt-12 text-center text-gray-300">
        &copy; 2025 College Management System. All rights reserved.
      </footer>

    </main>
  </div>

  <!-- Optional JS for welcome message -->
  <script>
    function updateWelcomeMessage() {
      const username = '<?= htmlspecialchars($_SESSION["name"], ENT_QUOTES, 'UTF-8') ?>';
      document.querySelector('h2').textContent = 'Welcome, ' + username + '!';
    }

    <?php if (isset($_SESSION['profile_updated']) && $_SESSION['profile_updated']): ?>
      updateWelcomeMessage();
      <?php unset($_SESSION['profile_updated']); ?>
    <?php endif; ?>
  </script>

</body>

</html>