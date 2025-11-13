<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>




<aside class="w-64 bg-blue-900 text-white flex flex-col">
  <div class="p-6 text-2xl font-bold border-b border-blue-800">
    🏛️ Estab Exam Dashboard
  </div>

  <nav class="flex-1 p-4 space-y-2">

    <a href="dashboard.php"
       class="block py-2.5 px-4 rounded 
       <?= $currentPage === 'dashboard.php' ? 'bg-blue-700 font-semibold' : 'hover:bg-blue-700' ?>">
       Home
    </a>

    <a href="staff.php"
       class="block py-2.5 px-4 rounded 
       <?= $currentPage === 'staff.php' ? 'bg-blue-700 font-semibold' : 'hover:bg-blue-700' ?>">
       Staff Records
    </a>

    <a href="../public/cohorts.php"
       class="block py-2.5 px-4 rounded 
       <?= $currentPage === 'cohorts.php' ? 'bg-blue-700 font-semibold' : 'hover:bg-blue-700' ?>">
       📅 Exam Cohorts
    </a>

    <a href="../public/subjects.php"
       class="block py-2.5 px-4 rounded 
       <?= $currentPage === 'subjects.php' ? 'bg-blue-700 font-semibold' : 'hover:bg-blue-700' ?>">
       Exam Subjects
    </a>

    <a href="../public/cohort_subjects.php"
       class="block py-2.5 px-4 rounded 
       <?= $currentPage === 'cohort_subjects.php' ? 'bg-blue-700 font-semibold' : 'hover:bg-blue-700' ?>">
       Cohort-Subject Mapping
    </a>

    <a href="../public/exam_scores.php"
       class="block py-2.5 px-4 rounded 
       <?= $currentPage === 'exam_scores.php' ? 'bg-blue-700 font-semibold' : 'hover:bg-blue-700' ?>">
       Exam Scores
    </a>

    <a href="../public/departments.php"
       class="block py-2.5 px-4 rounded 
       <?= $currentPage === 'departments.php' ? 'bg-blue-700 font-semibold' : 'hover:bg-blue-700' ?>">
       Departments
    </a>

  </nav>

  <div class="p-4 border-t border-blue-800">
  <button 
    class="w-full bg-blue-700 hover:bg-blue-600 py-2 rounded" 
    onclick="window.location.href='../public/logout.php'">
    Logout
  </button>
</div>
</aside>




