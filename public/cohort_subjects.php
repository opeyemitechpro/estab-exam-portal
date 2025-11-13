<?php

session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$pageTitle = "Cohort Subjects - Estab Exam System";
include '../app/views/layouts/header.php';
include '../app/views/layouts/sidebar.php';
require_once '../app/config/database.php';
require_once '../app/models/Cohort.php';
require_once '../app/models/Subject.php';
require_once '../app/models/CohortSubject.php';

$cohortModel = new Cohort($pdo);
$subjectModel = new Subject($pdo);
$cohortSubjectModel = new CohortSubject($pdo);

$cohorts = $cohortModel->getAll();
$subjects = $subjectModel->getAll();

$selectedCohortId = $_GET['cohort'] ?? null;
$selectedCohort = $selectedCohortId ? $cohortModel->getById($selectedCohortId) : null;
$mappedSubjects = $selectedCohortId ? $cohortSubjectModel->getByCohort($selectedCohortId) : [];
?>

<main class="flex-1 p-8 overflow-y-auto">
  <header class="mb-8 flex justify-between items-center">
    <div>
      <h1 class="text-3xl font-semibold text-gray-800">Cohort Subject Mapping</h1>
      <p class="text-gray-500">Manage subjects assigned to specific cohorts</p>
    </div>
    <?php if ($selectedCohortId): ?>
      <a href="#" id="addSubjectBtn" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">Add Subject</a>
    <?php endif; ?>
  </header>

  <form method="GET" class="mb-6 flex gap-4">
    <div>
      <label for="cohort" class="block text-sm font-medium text-gray-700">Select Cohort</label>
      <select name="cohort" id="cohort" class="border border-gray-300 rounded-md px-3 py-2">
        <option value="">-- Choose Cohort --</option>
        <?php foreach ($cohorts as $c): ?>
          <option value="<?= $c['id'] ?>" <?= ($selectedCohortId == $c['id']) ? 'selected' : '' ?>>
            <?= htmlspecialchars($c['cohort_name']) ?> (<?= htmlspecialchars($c['year']) ?>)
          </option>
        <?php endforeach; ?>
      </select>
    </div>
    <button type="submit" class="self-end bg-gray-700 hover:bg-gray-800 text-white px-4 py-2 rounded-md">Load</button>
  </form>

  <?php if ($selectedCohort): ?>
  <section class="bg-white rounded-lg shadow-md p-6">
    <h2 class="text-xl font-semibold text-gray-700 mb-4">Subjects in this Cohort</h2>
    <div class="overflow-x-auto">
      <table class="min-w-full text-left border-collapse">
        <thead>
          <tr class="bg-gray-100 border-b">
            <th class="py-3 px-4 text-sm font-semibold text-gray-600">Subject Name</th>
            <th class="py-3 px-4 text-sm font-semibold text-gray-600">Max Score</th>
            <th class="py-3 px-4 text-sm font-semibold text-gray-600 text-right">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($mappedSubjects)): ?>
            <tr><td colspan="3" class="py-3 px-4 text-center text-gray-500">No subjects mapped yet.</td></tr>
          <?php else: ?>
            <?php foreach ($mappedSubjects as $subject): ?>
              <tr class="border-b hover:bg-gray-50">
                <td class="py-3 px-4 text-sm text-gray-700"><?= htmlspecialchars($subject['subject_name']) ?></td>
                <td class="py-3 px-4 text-sm text-gray-700"><?= htmlspecialchars($subject['max_score']) ?></td>
                <td class="py-3 px-4 text-sm text-right">
                  <a href="../app/controllers/cohortSubjectController.php?delete=<?= $subject['id'] ?>&cohort=<?= $selectedCohortId ?>" 
                     class="text-red-600 hover:underline">Delete</a>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </section>
  <?php endif; ?>
</main>

<!-- Add Subject Modal -->
<div id="subjectModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
  <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
    <h2 class="text-xl font-semibold text-gray-700 mb-4">Add Subject to Cohort</h2>
    <form action="../app/controllers/cohortSubjectController.php" method="POST" class="space-y-4">
      <input type="hidden" name="addMapping" value="1">
      <input type="hidden" name="cohort_id" value="<?= $selectedCohortId ?>">

      <div>
        <label class="block text-sm text-gray-700">Select Subject</label>
        <select name="subject_id" required class="w-full border border-gray-300 rounded-md px-3 py-2">
          <option value="">-- Choose Subject --</option>
          <?php foreach ($subjects as $subject): ?>
            <option value="<?= $subject['id'] ?>"><?= htmlspecialchars($subject['subject_name']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <div>
        <label class="block text-sm text-gray-700">Max Score</label>
        <input type="number" name="max_score" required min="0" max="100" value="100"
               class="w-full border border-gray-300 rounded-md px-3 py-2">
      </div>

      <div class="flex justify-end gap-3">
        <button type="button" id="closeSubjectModal" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">Cancel</button>
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Add</button>
      </div>
    </form>
  </div>
</div>

<script>
document.getElementById("addSubjectBtn")?.addEventListener("click", () => {
  document.getElementById("subjectModal").classList.remove("hidden");
});
document.getElementById("closeSubjectModal").addEventListener("click", () => {
  document.getElementById("subjectModal").classList.add("hidden");
});
</script>

<?php include '../app/views/layouts/footer.php'; ?>
