<?php
$pageTitle = "Staff Records - Estab Exam System";
include 'header.php';
include 'sidebar.php';
?>

<main class="flex-1 p-8 overflow-y-auto">
  <h1 class="text-2xl font-semibold text-gray-800 mb-4">Staff Records</h1>

  <div class="bg-white p-6 rounded-lg shadow-md mb-6">
    <button class="bg-blue-700 hover:bg-blue-600 text-white px-4 py-2 rounded mb-4">➕ Add New Staff</button>
    <div class="overflow-x-auto">
      <table class="min-w-full border-collapse text-left">
        <thead>
          <tr class="bg-gray-100 border-b">
            <th class="py-3 px-4 text-sm font-semibold text-gray-600">Staff ID</th>
            <th class="py-3 px-4 text-sm font-semibold text-gray-600">Name</th>
            <th class="py-3 px-4 text-sm font-semibold text-gray-600">Department</th>
            <th class="py-3 px-4 text-sm font-semibold text-gray-600">Status</th>
            <th class="py-3 px-4 text-sm font-semibold text-gray-600">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr class="border-b hover:bg-gray-50">
            <td class="py-3 px-4 text-sm">STAFF-001</td>
            <td class="py-3 px-4 text-sm">Jane Doe</td>
            <td class="py-3 px-4 text-sm">Administration</td>
            <td class="py-3 px-4 text-sm text-green-600 font-semibold">Active</td>
            <td class="py-3 px-4 text-sm">
              <button class="text-blue-600 hover:underline">Edit</button> |
              <button class="text-red-600 hover:underline">Delete</button>
            </td>
          </tr>
          <tr class="border-b hover:bg-gray-50">
            <td class="py-3 px-4 text-sm">STAFF-002</td>
            <td class="py-3 px-4 text-sm">John Smith</td>
            <td class="py-3 px-4 text-sm">Finance</td>
            <td class="py-3 px-4 text-sm text-yellow-600 font-semibold">Inactive</td>
            <td class="py-3 px-4 text-sm">
              <button class="text-blue-600 hover:underline">Edit</button> |
              <button class="text-red-600 hover:underline">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</main>

<?php include 'footer.php'; ?>

