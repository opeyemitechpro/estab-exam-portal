<?php
$pageTitle = "Dashboard - Estab Exam System";
include 'header.php';
include 'sidebar.php';
?>

<main class="flex-1 p-8 overflow-y-auto">
  <header class="mb-8">
    <h1 class="text-3xl font-semibold text-gray-800">Estab Exam Dashboard</h1>
    <p class="text-gray-500">Cohort: <span class="font-semibold">2025/2026</span></p>
  </header>

  <!-- Summary Cards -->
  <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white shadow-md rounded-lg p-6 border-t-4 border-blue-600">
      <h3 class="text-gray-500 text-sm uppercase">Total Candidates</h3>
      <p class="text-3xl font-bold text-gray-800 mt-2">245</p>
    </div>
    <div class="bg-white shadow-md rounded-lg p-6 border-t-4 border-green-600">
      <h3 class="text-gray-500 text-sm uppercase">Passed</h3>
      <p class="text-3xl font-bold text-gray-800 mt-2">182</p>
    </div>
    <div class="bg-white shadow-md rounded-lg p-6 border-t-4 border-red-600">
      <h3 class="text-gray-500 text-sm uppercase">Failed</h3>
      <p class="text-3xl font-bold text-gray-800 mt-2">48</p>
    </div>
    <div class="bg-white shadow-md rounded-lg p-6 border-t-4 border-yellow-500">
      <h3 class="text-gray-500 text-sm uppercase">Absent</h3>
      <p class="text-3xl font-bold text-gray-800 mt-2">15</p>
    </div>
  </section>

  <!-- Chart Placeholder -->
  <section class="bg-white rounded-lg shadow-md p-6 mb-8">
    <h2 class="text-xl font-semibold text-gray-700 mb-4">Exam Performance Overview</h2>
    <div class="h-64 flex items-center justify-center text-gray-400 border-2 border-dashed rounded-lg">
      📊 Chart.js Graph Placeholder
    </div>
  </section>

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
          <tr class="border-b hover:bg-gray-50">
            <td class="py-3 px-4 text-sm text-gray-700">STAFF-001</td>
            <td class="py-3 px-4 text-sm text-gray-700">Jane Doe</td>
            <td class="py-3 px-4 text-sm text-gray-700">Administration</td>
            <td class="py-3 px-4 text-sm text-gray-700">87%</td>
            <td class="py-3 px-4 text-sm font-semibold text-green-600">Pass</td>
          </tr>
          <tr class="border-b hover:bg-gray-50">
            <td class="py-3 px-4 text-sm text-gray-700">STAFF-002</td>
            <td class="py-3 px-4 text-sm text-gray-700">John Smith</td>
            <td class="py-3 px-4 text-sm text-gray-700">Finance</td>
            <td class="py-3 px-4 text-sm text-gray-700">64%</td>
            <td class="py-3 px-4 text-sm font-semibold text-red-600">Fail</td>
          </tr>
          <tr class="border-b hover:bg-gray-50">
            <td class="py-3 px-4 text-sm text-gray-700">STAFF-003</td>
            <td class="py-3 px-4 text-sm text-gray-700">Grace Udo</td>
            <td class="py-3 px-4 text-sm text-gray-700">HR</td>
            <td class="py-3 px-4 text-sm text-gray-700">92%</td>
            <td class="py-3 px-4 text-sm font-semibold text-green-600">Pass</td>
          </tr>
        </tbody>
      </table>
    </div>
  </section>
</main>

<?php include 'footer.php'; ?>
