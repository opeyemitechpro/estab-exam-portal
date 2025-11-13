<?php
$pageTitle = "Department Management";
include '../app/views/layouts/header.php';
include '../app/views/layouts/sidebar.php';
require_once '../app/config/database.php';
require_once '../app/models/Department.php';

$deptModel = new Department($pdo);
$departments = $deptModel->getAll();
?>

<main class="flex-1 p-8 overflow-y-auto">
  <div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-semibold text-gray-800">Department Management</h1>
    <button id="openModal" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">+ Add Department</button>
  </div>

  <div class="bg-white shadow-md rounded-lg overflow-x-auto">
    <table class="min-w-full text-left border-collapse">
      <thead>
        <tr class="bg-gray-100 border-b">
          <th class="p-3 text-sm font-semibold text-gray-600">#</th>
          <th class="p-3 text-sm font-semibold text-gray-600">Department Name</th>
          <th class="p-3 text-sm font-semibold text-gray-600">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($departments as $i => $dept): ?>
        <tr class="border-b hover:bg-gray-50">
          <td class="p-3"><?= $i + 1 ?></td>
          <td class="p-3"><?= htmlspecialchars($dept['dept_name']) ?></td>
          <td class="p-3">
            <a href="../app/controllers/departmentController.php?delete=<?= $dept['id'] ?>" 
               class="text-red-600 hover:underline"
               onclick="return confirm('Delete this department?')">Delete</a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</main>

<!-- Modal -->
<div id="addDeptModal" class="hidden fixed inset-0 bg-black bg-opacity-30 flex items-center justify-center">
  <div class="bg-white rounded-lg p-6 shadow-lg w-full max-w-md">
    <h2 class="text-xl font-semibold mb-4">Add Department</h2>
    <form action="../app/controllers/departmentController.php" method="POST">
      <input type="hidden" name="addDepartment" value="1">

      <label class="block text-sm font-medium text-gray-700 mb-1">Department Name</label>
      <input type="text" name="name" required class="w-full border-gray-300 rounded-md p-2 mb-4">

      <div class="flex justify-end space-x-2">
        <button type="button" id="closeModal" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md">Cancel</button>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Save</button>
      </div>
    </form>
  </div>
</div>

<script>
const modal = document.getElementById('addDeptModal');
document.getElementById('openModal').addEventListener('click', () => modal.classList.remove('hidden'));
document.getElementById('closeModal').addEventListener('click', () => modal.classList.add('hidden'));
</script>

<?php include '../app/views/layouts/footer.php'; ?>
