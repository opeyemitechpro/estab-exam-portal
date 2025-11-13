<?php
$pageTitle = "Exam Scores Management";
include '../app/views/layouts/header.php';
include '../app/views/layouts/sidebar.php';
require_once '../app/config/database.php';
require_once '../app/models/ExamScore.php';
require_once '../app/models/Cohort.php';
require_once '../app/models/Subject.php';
require_once '../app/models/Staff.php';

$cohort = new Cohort($pdo);
$subject = new Subject($pdo);
$staff = new Staff($pdo);
$score = new ExamScore($pdo);

$cohorts = $cohort->getAll();
$subjects = [];
$scores = [];
$selectedCohort = $_GET['cohort_id'] ?? null;

if ($selectedCohort) {
  $subjects = $subject->getByCohort($selectedCohort);
  $scores = $score->getByCohort($selectedCohort);
}
?>

<main class="flex-1 p-8 overflow-y-auto">
  <h1 class="text-2xl font-semibold text-gray-800 mb-6">Exam Scores Management</h1>

  <form method="GET" class="mb-6 flex space-x-4">
    <select name="cohort_id" class="border-gray-300 rounded-md p-2">
      <option value="">Select Cohort</option>
      <?php foreach ($cohorts as $c): ?>
        <option value="<?= $c['id'] ?>" <?= $selectedCohort == $c['id'] ? 'selected' : '' ?>>
          <?= htmlspecialchars($c['cohort_name']) ?> (<?= htmlspecialchars($c['year']) ?>)
        </option>
      <?php endforeach; ?>
    </select>
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Load</button>
  </form>

  <?php if ($selectedCohort && $subjects): ?>
  <div class="overflow-x-auto bg-white shadow-md rounded-lg p-4">
    <table class="min-w-full border-collapse text-sm">
      <thead>
        <tr class="bg-gray-100 border-b">
          <th class="p-3 text-left">Staff</th>
          <?php foreach ($subjects as $sub): ?>
            <th class="p-3 text-center"><?= htmlspecialchars($sub['subject_name']) ?> (Max: <?= $sub['max_score'] ?>)</th>
          <?php endforeach; ?>
        </tr>
      </thead>
      <tbody>
        <?php
        $staffList = $staff->getAll();
        foreach ($staffList as $st):
        ?>
        <tr class="border-b hover:bg-gray-50" data-staff="<?= $st['id'] ?>">
          <td class="p-3 font-semibold"><?= htmlspecialchars($st['full_name']) ?></td>
          <?php foreach ($subjects as $sub):
            $existing = array_filter($scores, fn($s) => $s['staff_id'] == $st['id'] && $s['subject_id'] == $sub['id']);
            $val = $existing ? array_values($existing)[0]['score'] : '';
          ?>
            <td class="p-3 text-center editable" 
                contenteditable="true" 
                data-staff="<?= $st['id'] ?>" 
                data-subject="<?= $sub['id'] ?>" 
                data-cohort="<?= $selectedCohort ?>">
              <?= htmlspecialchars($val) ?>
            </td>
          <?php endforeach; ?>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <?php endif; ?>
</main>

<script>
document.querySelectorAll('.editable').forEach(cell => {
  cell.addEventListener('blur', async function() {
    const staffId = this.dataset.staff;
    const subjectId = this.dataset.subject;
    const cohortId = this.dataset.cohort;
    const score = this.innerText.trim();

    if (score === '' || isNaN(score) || score < 0 || score > 100) {
      alert('Invalid score (0–100 only)');
      return;
    }

    const formData = new FormData();
    formData.append('action', 'saveScore');
    formData.append('staff_id', staffId);
    formData.append('subject_id', subjectId);
    formData.append('cohort_id', cohortId);
    formData.append('score', score);

    const res = await fetch('../app/controllers/scoreController.php', {
      method: 'POST',
      body: formData
    });

    const data = await res.json();
    if (data.success) {
      this.classList.add('bg-green-50');
      setTimeout(() => this.classList.remove('bg-green-50'), 1000);
    } else {
      alert('Save failed.');
    }
  });
});
</script>

<?php include '../app/views/layouts/footer.php'; ?>
