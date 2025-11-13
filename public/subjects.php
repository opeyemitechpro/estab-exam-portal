<?php
$pageTitle = "Exam Subjects - Estab Exam System";
include '../app/views/layouts/header.php';
include '../app/views/layouts/sidebar.php';
require_once '../app/config/database.php';
require_once '../app/models/Subject.php';

$subjectModel = new Subject($pdo);
$subjects = $subjectModel->getAll();
?>

<main class="flex-1 p-8 overflow-y-auto">
  <header class="mb-8 flex justify-between items-center">
    <div>
      <h1 class="text-3xl font-semibold text-gray-800">Exam Subject Setup</h1>
      <p class="text-gray-500">Manage exam subjects and their maximum scores.</p>
    </div>
    <button id="openAddModal" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium">+ Add Subject</button>
  </header>

  <section class="bg-white rounded-lg shadow-md p-6">
    <h2 class="text-xl font-semibold text-gray-700 mb-4">Subject List</h2>

    <div class="overflow-x-auto">
      <table class="min-w-full border-collapse text-left">
        <thead>
          <tr class="bg-gray-100 border-b">
            <th class="py-3 px-4 text-sm font-semibold text-gray-600">#</th>
            <th class="py-3 px-4 text-sm font-semibold text-gray-600">Subject Name</th>
            <th class="py-3 px-4 text-sm font-semibold text-gray-600">Max Score</th>
            <th class="py-3 px-4 text-sm font-semibold text-gray-600">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($subjects as $index => $subject): ?>
            <tr class="border-b hover:bg-gray-50">
              <td class="py-3 px-4"><?php echo $index + 1; ?></td>
              <td class="py-3 px-4"><?php echo htmlspecialchars($subject['subject_name']); ?></td>
              <td class="py-3 px-4"><?php echo htmlspecialchars($subject['max_score']); ?></td>
              <td class="py-3 px-4 flex gap-3">
                <button 
                  class="text-blue-600 hover:text-blue-800 text-sm font-semibold editBtn"
                  data-id="<?php echo $subject['id']; ?>"
                  data-name="<?php echo htmlspecialchars($subject['subject_name']); ?>"
                  data-score="<?php echo htmlspecialchars($subject['max_score']); ?>"
                >Edit</button>

                <a href="../app/controllers/subjectController.php?delete=<?php echo $subject['id']; ?>" 
                   class="text-red-600 hover:text-red-800 text-sm font-semibold"
                   onclick="return confirm('Are you sure you want to delete this subject?')">Delete</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </section>
</main>

<!-- Add Subject Modal -->
<div id="addModal" class="fixed inset-0 hidden bg-gray-900 bg-opacity-50 items-center justify-center">
  <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
    <h2 class="text-xl font-semibold mb-4 text-gray-800">Add New Subject</h2>
    <form action="../app/controllers/subjectController.php" method="POST" class="space-y-4">
      <input type="hidden" name="addSubject" value="1">

      <div>
        <label class="block text-sm font-medium text-gray-600">Subject Name</label>
        <input type="text" name="subject_name" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-600">Maximum Score</label>
        <input type="number" name="max_score" value="100" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
      </div>

      <div class="flex justify-end gap-2 mt-6">
        <button type="button" id="closeAddModal" class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold">Cancel</button>
        <button type="submit" class="px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-semibold">Save</button>
      </div>
    </form>
  </div>
</div>

<!-- Edit Subject Modal -->
<div id="editModal" class="fixed inset-0 hidden bg-gray-900 bg-opacity-50 items-center justify-center">
  <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
    <h2 class="text-xl font-semibold mb-4 text-gray-800">Edit Subject</h2>
    <form action="../app/controllers/subjectController.php" method="POST" class="space-y-4">
      <input type="hidden" name="updateSubject" value="1">
      <input type="hidden" name="id" id="edit_id">

      <div>
        <label class="block text-sm font-medium text-gray-600">Subject Name</label>
        <input type="text" name="subject_name" id="edit_name" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-600">Maximum Score</label>
        <input type="number" name="max_score" id="edit_score" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
      </div>

      <div class="flex justify-end gap-2 mt-6">
        <button type="button" id="closeEditModal" class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold">Cancel</button>
        <button type="submit" class="px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-semibold">Update</button>
      </div>
    </form>
  </div>
</div>

<script>
const addModal = document.getElementById('addModal');
const openAddModal = document.getElementById('openAddModal');
const closeAddModal = document.getElementById('closeAddModal');
openAddModal.addEventListener('click', () => addModal.classList.remove('hidden'));
closeAddModal.addEventListener('click', () => addModal.classList.add('hidden'));

const editModal = document.getElementById('editModal');
const closeEditModal = document.getElementById('closeEditModal');
const editButtons = document.querySelectorAll('.editBtn');

editButtons.forEach(btn => {
  btn.addEventListener('click', () => {
    document.getElementById('edit_id').value = btn.dataset.id;
    document.getElementById('edit_name').value = btn.dataset.name;
    document.getElementById('edit_score').value = btn.dataset.score;
    editModal.classList.remove('hidden');
  });
});

closeEditModal.addEventListener('click', () => editModal.classList.add('hidden'));
</script>

<?php include '../app/views/layouts/footer.php'; ?>
