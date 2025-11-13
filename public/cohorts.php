<?php
$pageTitle = "Exam Cohorts - Estab Exam System";
include '../app/views/layouts/header.php';
include '../app/views/layouts/sidebar.php';
require_once '../app/controllers/cohortController.php';
?>

<main class="flex-1 p-8 overflow-y-auto bg-gray-50">
  <header class="mb-8 flex justify-between items-center">
    <h1 class="text-3xl font-semibold text-gray-800">Exam Cohort Management</h1>
    <button onclick="openModal()" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
      + Add New Cohort
    </button>
  </header>

  <section class="bg-white shadow-md rounded-lg p-6">
    <h2 class="text-xl font-semibold text-gray-700 mb-4">Cohort List</h2>
    <div class="overflow-x-auto">
      <table class="min-w-full border-collapse text-left">
        <thead>
          <tr class="bg-gray-100 border-b text-gray-600 text-sm uppercase">
            <th class="py-3 px-4">Cohort Name</th>
            <th class="py-3 px-4">Year</th>
            <th class="py-3 px-4">Exam Date</th>
            <th class="py-3 px-4">Pass Mark</th>
            <th class="py-3 px-4">Actions</th>
          </tr>
        </thead>
        <tbody>
  <?php foreach ($cohort->all() as $row): ?>
    <tr class="border-b hover:bg-gray-50">
      <td class="py-3 px-4 text-gray-700"><?= htmlspecialchars($row['cohort_name']) ?></td>
      <td class="py-3 px-4 text-gray-700"><?= htmlspecialchars($row['year']) ?></td>
      <td class="py-3 px-4 text-gray-700"><?= htmlspecialchars($row['exam_date']) ?></td>
      <td class="py-3 px-4 text-gray-700"><?= htmlspecialchars($row['pass_mark']) ?>%</td>
      <td class="py-3 px-4 flex space-x-3">
        <button onclick="openEditModal(<?= htmlspecialchars(json_encode($row)) ?>)" class="text-blue-600 hover:underline">Edit</button>
        <a href="?delete=<?= $row['id'] ?>" class="text-red-600 hover:underline">Delete</a>
      </td>
    </tr>
  <?php endforeach; ?>
</tbody>

      </table>
    </div>
  </section>
</main>

<!-- Modal -->
<div id="cohortModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
  <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
    <h2 class="text-xl font-semibold text-gray-800 mb-4">Add New Cohort</h2>
    <form method="POST" action="../app/controllers/cohortController.php">
      <div class="mb-3">
        <label class="block text-gray-700 text-sm mb-2">Cohort Name</label>
        <input type="text" name="cohort_name" required class="w-full border rounded px-3 py-2">
      </div>
      <div class="mb-3">
        <label class="block text-gray-700 text-sm mb-2">Year</label>
        <input type="text" name="year" required class="w-full border rounded px-3 py-2">
      </div>
      <div class="mb-3">
        <label class="block text-gray-700 text-sm mb-2">Exam Date</label>
        <input type="date" name="exam_date" required class="w-full border rounded px-3 py-2">
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 text-sm mb-2">Pass Mark (%)</label>
        <input type="number" name="pass_mark" min="0" max="100" required class="w-full border rounded px-3 py-2">
      </div>
      <div class="flex justify-end space-x-3">
        <button type="button" onclick="closeModal()" class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">Cancel</button>
        <button type="submit" name="addCohort" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Save</button>
      </div>
    </form>
  </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
  <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
    <h2 class="text-xl font-semibold text-gray-800 mb-4">Edit Cohort</h2>
    <form method="POST" action="../app/controllers/cohortController.php">
      <input type="hidden" name="id" id="edit_id">
      <div class="mb-3">
        <label class="block text-gray-700 text-sm mb-2">Cohort Name</label>
        <input type="text" name="cohort_name" id="edit_name" required class="w-full border rounded px-3 py-2">
      </div>
      <div class="mb-3">
        <label class="block text-gray-700 text-sm mb-2">Year</label>
        <input type="text" name="year" id="edit_year" required class="w-full border rounded px-3 py-2">
      </div>
      <div class="mb-3">
        <label class="block text-gray-700 text-sm mb-2">Exam Date</label>
        <input type="date" name="exam_date" id="edit_date" required class="w-full border rounded px-3 py-2">
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 text-sm mb-2">Pass Mark (%)</label>
        <input type="number" name="pass_mark" id="edit_pass" min="0" max="100" required class="w-full border rounded px-3 py-2">
      </div>
      <div class="flex justify-end space-x-3">
        <button type="button" onclick="closeEditModal()" class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">Cancel</button>
        <button type="submit" name="updateCohort" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
      </div>
    </form>
  </div>
</div>


<script>
function openModal() {
  document.getElementById('cohortModal').classList.remove('hidden');
}
function closeModal() {
  document.getElementById('cohortModal').classList.add('hidden');
}

function openEditModal(data) {
  document.getElementById('edit_id').value = data.id;
  document.getElementById('edit_name').value = data.cohort_name;
  document.getElementById('edit_year').value = data.year;
  document.getElementById('edit_date').value = data.exam_date;
  document.getElementById('edit_pass').value = data.pass_mark;
  document.getElementById('editModal').classList.remove('hidden');
}
function closeEditModal() {
  document.getElementById('editModal').classList.add('hidden');
}
</script>


<?php include '../app/views/layouts/footer.php'; ?>
