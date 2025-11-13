<?php
/* ============================================================
   PAGE INITIALIZATION & DEPENDENCIES
   ------------------------------------------------------------
   - Sets the page title.
   - Includes shared layout components (header & sidebar).
   - Loads database configuration and the Staff model.
   - Creates a Staff model instance and retrieves all staff records.
   ============================================================ */
$pageTitle = "Staff Management - Estab Exam System";
include '../app/views/layouts/header.php';
include '../app/views/layouts/sidebar.php';
require_once '../app/config/database.php';
require_once '../app/models/Staff.php';

$staffModel = new Staff($pdo);
$staffList = $staffModel->getAll();
?>

<!-- ============================================================
     MAIN CONTENT AREA
     ------------------------------------------------------------
     - Displays the Staff Management interface.
     - Includes title header, Add Staff button, filters, and staff table.
     ============================================================ -->
<main class="flex-1 p-8 overflow-y-auto">
  <header class="mb-8 flex justify-between items-center">
    <h1 class="text-3xl font-semibold text-gray-800">Staff Management</h1>
    <button id="openAddModal" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-semibold">+ Add New Staff</button>
  </header>

  <!-- ============================================================
       SEARCH & FILTERS SECTION
       ------------------------------------------------------------
       - Provides input field to search staff by name or ID.
       - Includes a dropdown to filter staff by department.
       ============================================================ -->
  <div class="mb-6 flex flex-col sm:flex-row gap-4 sm:items-center">
    <input type="text" placeholder="Search by name or ID" class="border border-gray-300 rounded-lg px-4 py-2 w-full sm:w-1/3 focus:outline-none focus:ring-2 focus:ring-blue-500">
    <select class="border border-gray-300 rounded-lg px-4 py-2 w-full sm:w-1/4 focus:outline-none focus:ring-2 focus:ring-blue-500">
      <option value="">All Departments</option>
      <option>Administration</option>
      <option>HR</option>
      <option>Finance</option>
      <option>ICT</option>
    </select>
  </div>

  <!-- ============================================================
       STAFF TABLE SECTION
       ------------------------------------------------------------
       - Displays a table of all staff records from the database.
       - Each row includes staff details and action buttons.
       ============================================================ -->
  <section class="bg-white shadow-md rounded-lg overflow-hidden">
    <table class="min-w-full border-collapse text-sm">
      <thead class="bg-gray-100 border-b">
        <tr>
          <th class="py-3 px-4 text-gray-600 font-semibold text-left">Staff ID</th>
          <th class="py-3 px-4 text-gray-600 font-semibold text-left">Full Name</th>
          <th class="py-3 px-4 text-gray-600 font-semibold text-left">Department</th>
          <th class="py-3 px-4 text-gray-600 font-semibold text-left">Status</th>
          <th class="py-3 px-4 text-gray-600 font-semibold text-left">Actions</th>
        </tr>
      </thead>
      <tbody>
  <?php foreach ($staffList as $staff): ?>
    <tr class="border-b hover:bg-gray-50">
      <td class="py-3 px-4"><?php echo htmlspecialchars($staff['staff_id']); ?></td>
      <td class="py-3 px-4"><?php echo htmlspecialchars($staff['full_name']); ?></td>
      <td class="p-3"><?= htmlspecialchars($staff['department'] ?? '—') ?></td>
      <td class="py-3 px-4">
        <span class="px-2 py-1 text-xs font-semibold rounded-lg 
          <?php echo $staff['status'] === 'Active' ? 'bg-green-100 text-green-700' : ($staff['status'] === 'On Leave' ? 'bg-yellow-100 text-yellow-700' : 'bg-gray-200 text-gray-700'); ?>">
          <?php echo $staff['status']; ?>
        </span>
      </td>
      <td class="py-3 px-4 flex gap-3">
        <button 
          class="text-blue-600 hover:text-blue-800 text-sm font-semibold editBtn"
          data-id="<?php echo $staff['id']; ?>"
          data-staffid="<?php echo htmlspecialchars($staff['staff_id']); ?>"
          data-name="<?php echo htmlspecialchars($staff['full_name']); ?>"
          data-deptid="<?php echo htmlspecialchars($staff['department_id']); ?>"
          data-status="<?php echo htmlspecialchars($staff['status']); ?>"
        >Edit</button>

        <a href="../app/controllers/staffController.php?delete=<?php echo $staff['id']; ?>" 
           class="text-red-600 hover:text-red-800 text-sm font-semibold" 
           onclick="return confirm('Are you sure you want to delete this staff?')">Delete</a>
      </td>
    </tr>
  <?php endforeach; ?>
</tbody>

    </table>
  </section>

  <!-- ============================================================
       PAGINATION PLACEHOLDER
       ------------------------------------------------------------
       - Displays a summary of how many staff records are shown.
       - Currently shows all staff as a single page (no pagination logic yet).
       ============================================================ -->
  <div class="flex justify-end mt-6 text-gray-500 text-sm">Showing 1–<?php echo count($staffList); ?> of <?php echo count($staffList); ?> staff</div>
</main>

<!-- ============================================================
     ADD STAFF MODAL
     ------------------------------------------------------------
     - Hidden modal that appears when "Add New Staff" is clicked.
     - Contains a form to create a new staff record.
     ============================================================ -->
<!-- Add Staff Modal -->
<div id="addStaffModal" class="hidden fixed inset-0 bg-black bg-opacity-30 flex items-center justify-center">
  <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
    <h2 class="text-xl font-semibold mb-4">Add New Staff</h2>
    <form action="../app/controllers/staffController.php" method="POST">
      <input type="hidden" name="addStaff" value="1">
      
      <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
      <input type="text" name="full_name" required class="w-full border-gray-300 rounded-md p-2 mb-3">

      <label class="block text-sm font-medium text-gray-700 mb-1">Staff ID</label>
      <input type="text" name="staff_id" required class="w-full border-gray-300 rounded-md p-2 mb-3">

      <label class="block text-sm font-medium text-gray-700 mb-1">Department</label>
      <select name="department_id" required class="w-full border-gray-300 rounded-md p-2 mb-3">
        <option value="">Select Department</option>
        <?php
          require_once '../app/models/Department.php';
          $departmentModel = new Department($pdo);
          $departments = $departmentModel->getAll();
          foreach ($departments as $dept): ?>
            <option value="<?= $dept['id'] ?>"><?= htmlspecialchars($dept['dept_name']) ?></option>
        <?php endforeach; ?>
      </select>

      <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
      <select name="status" required class="w-full border-gray-300 rounded-md p-2 mb-4">
        <option value="Active">Active</option>
        <option value="Inactive">Inactive</option>
      </select>

      <div class="flex justify-end space-x-2">
        <button type="button" id="closeModal" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md">Cancel</button>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Save</button>
      </div>
    </form>
  </div>
</div>


<!-- ============================================================
     EDIT STAFF MODAL
     ------------------------------------------------------------
     - Hidden modal for editing existing staff details.
     - Pre-fills input fields based on selected staff data.
     ============================================================ -->
<div id="editModal" class="fixed inset-0 hidden bg-gray-900 bg-opacity-50 items-center justify-center">
  <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
    <h2 class="text-xl font-semibold mb-4 text-gray-800">Edit Staff</h2>
    <form action="../app/controllers/staffController.php" method="POST" class="space-y-4">
      <input type="hidden" name="updateStaff" value="1">
      <input type="hidden" name="id" id="edit_id">

      <div>
        <label class="block text-sm font-medium text-gray-600">Staff ID</label>
        <input type="text" name="staff_id" id="edit_staff_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-600">Full Name</label>
        <input type="text" name="full_name" id="edit_full_name" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
      </div>
      <div>
  <label class="block text-sm font-medium text-gray-600">Department</label>
  <select name="department_id" id="edit_department_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
    <option value="">Select Department</option>
    <?php
      require_once '../app/models/Department.php';
      $deptModel = new Department($pdo);
      $departments = $deptModel->getAll();
      foreach ($departments as $dept): ?>
        <option value="<?= $dept['id'] ?>"><?= htmlspecialchars($dept['dept_name']) ?></option>
    <?php endforeach; ?>
  </select>
</div>

      <div>
        <label class="block text-sm font-medium text-gray-600">Status</label>
        <select name="status" id="edit_status" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
          <option value="Active">Active</option>
          <option value="On Leave">On Leave</option>
          <option value="Inactive">Inactive</option>
        </select>
      </div>

      <div class="flex justify-end gap-2 mt-6">
        <button type="button" id="closeEditModal" class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold">Cancel</button>
        <button type="submit" class="px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-semibold">Update</button>
      </div>
    </form>
  </div>
</div>

<!-- ============================================================
     MODAL CONTROL SCRIPT (ADD MODAL)
     ------------------------------------------------------------
     - Handles opening and closing the "Add Staff" modal.
     ============================================================ -->
<!-- <script>
const modal = document.getElementById('addModal');
const openModal = document.getElementById('openAddModal');
const closeModal = document.getElementById('closeAddModal');

openModal.addEventListener('click', () => modal.classList.remove('hidden'));
closeModal.addEventListener('click', () => modal.classList.add('hidden'));
</script> -->

<!-- ============================================================
     MODAL CONTROL SCRIPT (ADD & EDIT MODALS)
     ------------------------------------------------------------
     - Controls both add and edit modal visibility.
     - Populates edit modal fields using data attributes from Edit buttons.
     ============================================================ -->
<!-- <script>
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
    document.getElementById('edit_staff_id').value = btn.dataset.staffid;
    document.getElementById('edit_full_name').value = btn.dataset.name;
    document.getElementById('edit_department').value = btn.dataset.dept;
    document.getElementById('edit_status').value = btn.dataset.status;
    editModal.classList.remove('hidden');
  });
});

closeEditModal.addEventListener('click', () => editModal.classList.add('hidden'));
</script> -->


<script>
// ===== ADD STAFF MODAL CONTROL =====
const addStaffModal = document.getElementById('addStaffModal');
const openAddModalBtn = document.getElementById('openAddModal');
const closeAddModalBtn = document.getElementById('closeModal');

// Open modal
openAddModalBtn.addEventListener('click', () => {
  addStaffModal.classList.remove('hidden');
});

// Close modal
closeAddModalBtn.addEventListener('click', () => {
  addStaffModal.classList.add('hidden');
});

// ===== EDIT STAFF MODAL CONTROL =====
const editModal = document.getElementById('editModal');
const closeEditModal = document.getElementById('closeEditModal');
const editButtons = document.querySelectorAll('.editBtn');

// Open edit modal and populate data
editButtons.forEach(btn => {
  btn.addEventListener('click', () => {
    document.getElementById('edit_id').value = btn.dataset.id;
    document.getElementById('edit_staff_id').value = btn.dataset.staffid;
    document.getElementById('edit_full_name').value = btn.dataset.name;
    document.getElementById('edit_department_id').value = btn.dataset.deptid;

    document.getElementById('edit_status').value = btn.dataset.status;
    editModal.classList.remove('hidden');
  });
});

// Close edit modal
closeEditModal.addEventListener('click', () => {
  editModal.classList.add('hidden');
});

addStaffModal.addEventListener('click', (e) => {
  if (e.target === addStaffModal) {
    addStaffModal.classList.add('hidden');
  }
});



</script>


<!-- ============================================================
     FOOTER INCLUDE
     ------------------------------------------------------------
     - Adds the footer section shared across all pages.
     ============================================================ -->
<?php include '../app/views/layouts/footer.php'; ?>
