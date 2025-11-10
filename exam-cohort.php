<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examination Cohort Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
    <body class="bg-gray-100 font-sans">
  <!-- Sidebar -->
  <div class="flex h-screen">
    <aside class="w-64 bg-blue-900 text-white flex flex-col">
      <div class="p-6 text-2xl font-bold border-b border-blue-800">
        🏛️ Estab Exam Dashboard
      </div>
      <nav class="flex-1 p-4 space-y-2">
        <a href="#" class="block py-2.5 px-4 rounded hover:bg-blue-700">Dashboard</a>
        <a href="#" class="block py-2.5 px-4 rounded hover:bg-blue-700">Staff Records</a>
        <a href="#" class="block py-2.5 px-4 rounded hover:bg-blue-700">Exam Cohorts</a>
        <a href="#" class="block py-2.5 px-4 rounded hover:bg-blue-700">Score Upload</a>
        <a href="#" class="block py-2.5 px-4 rounded hover:bg-blue-700">Reports</a>
        <a href="#" class="block py-2.5 px-4 rounded hover:bg-blue-700">Settings</a>
      </nav>
      <div class="p-4 border-t border-blue-800">
        <button class="w-full bg-blue-700 hover:bg-blue-600 py-2 rounded">Logout</button>
      </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8">
      <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Manage Exam Cohorts</h1>
        <button id="openModal" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 shadow">
          + Add New Cohort
        </button>
      </div>

      <!-- Table -->
      <div class="bg-white rounded-lg shadow overflow-x-auto">
        <table class="min-w-full text-left border-collapse">
          <thead class="bg-blue-600 text-white">
            <tr class="bg-gray-100 border-b">
              <th class="py-3 px-4 text-gray-600 font-medium">Cohort Name</th>
              <th class="py-3 px-4 text-gray-600 font-medium">Year</th>
              <th class="py-3 px-4 text-gray-600 font-medium">Exam Date</th>
              <th class="py-3 px-4 text-gray-600 font-medium">Pass Mark</th>
              <th class="py-3 px-4 text-gray-600 font-medium text-center">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr class="border-b hover:bg-gray-50">
              <td class="py-3 px-4">Cohort A</td>
              <td class="py-3 px-4">2025/2026</td>
              <td class="py-3 px-4">2025-08-10</td>
              <td class="py-3 px-4">50%</td>
              <td class="py-3 px-4 text-center space-x-2">
                <button class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded">Edit</button>
                <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">Delete</button>
              </td>
            </tr>
            <tr class="border-b hover:bg-gray-50">
              <td class="py-3 px-4">Cohort B</td>
              <td class="py-3 px-4">2024/2025</td>
              <td class="py-3 px-4">2024-12-14</td>
              <td class="py-3 px-4">60%</td>
              <td class="py-3 px-4 text-center space-x-2">
                <button class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded">Edit</button>
                <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">Delete</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </main>
  </div>

  <!-- Modal -->
  <div id="cohortModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg">
      <h2 class="text-xl font-semibold mb-4">Add New Cohort</h2>
      <form class="space-y-4">
        <div>
          <label class="block text-gray-700 mb-1">Cohort Name</label>
          <input type="text" placeholder="e.g. Cohort 2025"
            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200" required />
        </div>
        <div>
          <label class="block text-gray-700 mb-1">Year</label>
          <input type="text" placeholder="2025/2026"
            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200" required />
        </div>
        <div>
          <label class="block text-gray-700 mb-1">Exam Date</label>
          <input type="date"
            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200" required />
        </div>
        <div>
          <label class="block text-gray-700 mb-1">Pass Mark (%)</label>
          <input type="number" placeholder="50"
            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200" required />
        </div>
        <div class="flex justify-end space-x-3 mt-4">
          <button type="button" id="closeModal"
            class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">Cancel</button>
          <button type="submit"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Save</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Java Script for Modal -->
  <script>
    const openModal = document.getElementById('openModal');
    const closeModal = document.getElementById('closeModal');
    const cohortModal = document.getElementById('cohortModal');

    openModal.addEventListener('click', () => cohortModal.classList.remove('hidden'));
    closeModal.addEventListener('click', () => cohortModal.classList.add('hidden'));

    window.addEventListener('click', (e) => {
      if (e.target === cohortModal) {
        cohortModal.classList.add('hidden');
      }
    });
  </script>
</body>
</html>