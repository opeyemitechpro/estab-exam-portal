<?php
session_start();
if (!isset($_SESSION['user'])) {
  header("Location: login.php");
  exit;
}

$pageTitle = "Dashboard - Estab Exam System";
include '../app/views/layouts/header.php';
include '../app/views/layouts/sidebar.php';
require_once '../app/models/Dashboard.php';
require_once '../app/config/database.php';

$dashboard = new Dashboard($pdo);

$totalCandidates = $dashboard->totalCandidates();
$totalPassed = $dashboard->totalPassed();
$totalFailed = $dashboard->totalFailed();
$totalAbsent = $dashboard->totalAbsent();
$recentResults = $dashboard->recentResults();
?>
<main class="flex-1 p-8 overflow-y-auto">
  <header class="mb-8">
    <h1 class="text-3xl font-semibold text-gray-800">Estab Exam Dashboard</h1>
    <p class="text-gray-500">Current Cohort: 
      <span class="font-semibold">
        <?php
          $cohort = $pdo->query("SELECT cohort_name, year FROM exam_cohorts ORDER BY id DESC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
          echo htmlspecialchars($cohort['cohort_name'] . ' (' . $cohort['year'] . ')');
        ?>
      </span>
    </p>
  </header>

  <!-- Summary Cards -->
  <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white shadow-md rounded-lg p-6 border-t-4 border-blue-600">
      <h3 class="text-gray-500 text-sm uppercase">Total Candidates</h3>
      <p class="text-3xl font-bold text-gray-800 mt-2"><?= $totalCandidates ?></p>
    </div>
    <div class="bg-white shadow-md rounded-lg p-6 border-t-4 border-green-600">
      <h3 class="text-gray-500 text-sm uppercase">Passed</h3>
      <p class="text-3xl font-bold text-gray-800 mt-2"><?= $totalPassed ?></p>
    </div>
    <div class="bg-white shadow-md rounded-lg p-6 border-t-4 border-red-600">
      <h3 class="text-gray-500 text-sm uppercase">Failed</h3>
      <p class="text-3xl font-bold text-gray-800 mt-2"><?= $totalFailed ?></p>
    </div>
    <div class="bg-white shadow-md rounded-lg p-6 border-t-4 border-yellow-500">
      <h3 class="text-gray-500 text-sm uppercase">Absent</h3>
      <p class="text-3xl font-bold text-gray-800 mt-2"><?= $totalAbsent ?></p>
    </div>
  </section>

  <!-- Chart Placeholder -->
  <!-- <section class="bg-white rounded-lg shadow-md p-6 mb-8">
    <h2 class="text-xl font-semibold text-gray-700 mb-4">Exam Performance Overview</h2>
    <canvas id="performanceChart" class="h-64"></canvas>
  </section> -->

  <!-- Recent Exam Results -->
  <section class="bg-white rounded-lg shadow-md p-6">
    <h2 class="text-xl font-semibold text-gray-700 mb-4">Recent Exam Scores</h2>
    <div class="overflow-x-auto">
      <table class="min-w-full text-left border-collapse">
        <thead>
          <tr class="bg-gray-100 border-b">
            <th class="py-3 px-4 text-sm font-semibold text-gray-600">Staff ID</th>
            <th class="py-3 px-4 text-sm font-semibold text-gray-600">Name</th>
            <th class="py-3 px-4 text-sm font-semibold text-gray-600">Department</th>
            <th class="py-3 px-4 text-sm font-semibold text-gray-600">Total Score</th>
            <th class="py-3 px-4 text-sm font-semibold text-gray-600">Status</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($recentResults as $row): ?>
          <tr class="border-b hover:bg-gray-50">
            <td class="py-3 px-4 text-sm text-gray-700"><?= htmlspecialchars($row['staff_id']) ?></td>
            <td class="py-3 px-4 text-sm text-gray-700"><?= htmlspecialchars($row['full_name']) ?></td>
            <td class="py-3 px-4 text-sm text-gray-700"><?= htmlspecialchars($row['department'] ?? '—') ?></td>
            <td class="py-3 px-4 text-sm text-gray-700"><?= htmlspecialchars($row['total_score']) ?>%</td>
            <td class="py-3 px-4 text-sm font-semibold <?= $row['status'] === 'Pass' ? 'text-green-600' : 'text-red-600' ?>">
              <?= htmlspecialchars($row['status']) ?>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </section>
</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('performanceChart');
  new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ['Passed', 'Failed', 'Absent'],
      datasets: [{
        data: [<?= $totalPassed ?>, <?= $totalFailed ?>, <?= $totalAbsent ?>],
        backgroundColor: ['#16a34a', '#dc2626', '#eab308'],
      }]
    }
  });
</script>

<?php include '../app/views/layouts/footer.php'; ?>
