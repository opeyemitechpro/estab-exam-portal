<?php
$pageTitle = "Exam Cohorts - Bureau Exam System";
include 'header.php';
include 'sidebar.php';
?>

<main class="flex-1 p-8 overflow-y-auto">
  <h1 class="text-2xl font-semibold text-gray-800 mb-4">Exam Cohorts</h1>

  <div class="bg-white p-6 rounded-lg shadow-md mb-6">
    <button class="bg-green-700 hover:bg-green-600 text-white px-4 py-2 rounded mb-4">➕ Add Exam Cohort</button>
    <table class="min-w-full border-collapse text-left">
      <thead>
        <tr class="bg-gray-100 border-b">
          <th class="py-3 px-4 text-sm font-semibold text-gray-600">Cohort</th>
          <th class="py-3 px-4 text-sm font-semibold text-gray-600">Year</th>
          <th class="py-3 px-4 text-sm font-semibold text-gray-600">Exam Date</th>
          <th class="py-3 px-4 text-sm font-semibold text-gray-600">Pass Mark</th>
          <th class="py-3 px-4 text-sm font-semibold text-gray-600">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr class="border-b hover:bg-gray-50">
          <td class="py-3 px-4 text-sm">Cohort 2025</td>
          <td class="py-3 px-4 text-sm">2025/2026</td>
          <td class="py-3 px-4 text-sm">March 14, 2025</td>
          <td class="py-3 px-4 text-sm">50%</td>
          <td class="py-3 px-4 text-sm">
            <button class="text-blue-600 hover:underline">Edit</button> |
            <button class="text-red-600 hover:underline">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</main>

<?php include 'footer.php'; ?>
