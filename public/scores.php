<?php
// --- SAMPLE STAFF DATA (Replace with DB data later) ---
// $staffList = [
//     ["id" => "STAFF-001", "name" => "Banjo Olawunmi", "department" => "SRPR", "status" => "Active"],
//     ["id" => "STAFF-002", "name" => "Fadina Aderonke", "department" => "ISD", "status" => "Inactive"],
//     ["id" => "STAFF-003", "name" => "Sobowale Atinuke", "department" => "Admin", "status" => "Active"],
// ];

include '../app/views/layouts/sidebar.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Staff Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen flex bg-gray-100">

    <!-- Sidebar (FULL HEIGHT) -->
    <!-- <aside class="w-64 bg-blue-900 text-white flex flex-col min-h-screen">
        <div class="p-6 text-2xl font-bold border-b border-blue-800">
            🏛️ Estab Exam Dashboard
        </div>
        <nav class="flex-1 p-4 space-y-2">
            <a href="dashboard.php" class="block py-2.5 px-4 rounded hover:bg-blue-700">Home</a>
            <a href="staff.php" class="block py-2.5 px-4 rounded hover:bg-blue-700">Staff Records</a>
            <a href="exam-cohort.php" class="block py-2.5 px-4 rounded hover:bg-blue-700">Exam Cohorts</a>
            <a href="scores.php" class="block py-2.5 px-4 rounded hover:bg-blue-700">Exam Scores</a>
            <a href="subjects.php" class="block py-2.5 px-4 rounded hover:bg-blue-700">Subjects</a>
        </nav>
        <div class="p-4 border-t border-blue-800">
            <button class="w-full bg-blue-700 hover:bg-blue-600 py-2 rounded">Logout</button>
        </div>
    </aside> -->

    <!-- Main Content -->
    <main class="flex-1 p-6">
        <div class="max-w-6xl mx-auto bg-white shadow-md rounded-2xl p-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-4">
                <h1 class="text-2xl font-semibold text-gray-800">Staff Management</h1>

                <!-- Search Bar & Add Button -->
                <div class="flex flex-col sm:flex-row gap-2 w-full md:w-auto">
                    <div class="relative w-full sm:w-64">
                        <input id="searchInput" type="text" placeholder="Search staff..."
                            class="pl-8 p-2 border rounded-md w-full focus:ring-2 focus:ring-blue-500 outline-none" />
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 absolute left-2 top-2 text-gray-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z" />
                        </svg>
                    </div>
                    <button id="addStaffBtn"
                        class="flex items-center justify-center gap-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition">
                        <span>＋</span> Add New Staff
                    </button>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-100 text-left text-gray-700">
                            <th class="p-3 border-b">Staff ID</th>
                            <th class="p-3 border-b">Full Name</th>
                            <th class="p-3 border-b">Department</th>
                            <th class="p-3 border-b">Status</th>
                        </tr>
                    </thead>
                    <tbody id="staffTableBody">
                        <?php foreach ($staffList as $staff): ?>
                            <tr class="hover:bg-gray-50 active:bg-gray-100 transition">
                                <td class="p-3 border-b text-gray-800"><?= $staff["id"] ?></td>
                                <td class="p-3 border-b"><?= $staff["name"] ?></td>
                                <td class="p-3 border-b"><?= $staff["department"] ?></td>
                                <td class="p-3 border-b font-medium <?= $staff["status"] === 'Active' ? 'text-green-600' : 'text-red-500' ?>">
                                    <?= $staff["status"] ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="flex justify-between items-center mt-4 text-sm text-gray-500">
                    <p id="paginationText">Showing <?= count($staffList) ?> of <?= count($staffList) ?></p>
                    <div class="flex gap-2">
                        <button class="px-3 py-1 border rounded-md hover:bg-gray-100">Previous</button>
                        <button class="px-3 py-1 border rounded-md hover:bg-gray-100">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Add Staff Modal -->
    <div id="addStaffModal"
        class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
        <div class="bg-white rounded-lg p-6 w-11/12 sm:w-96 shadow-lg">
            <h2 class="text-xl font-semibold mb-4">Add New Staff</h2>
            <div class="space-y-3">
                <div>
                    <label class="text-sm text-gray-600">Full Name</label>
                    <input id="staffName" type="text"
                        class="w-full border rounded-md p-2 focus:ring-2 focus:ring-blue-500 outline-none" />
                </div>
                <div>
                    <label class="text-sm text-gray-600">Department</label>
                    <input id="staffDept" type="text"
                        class="w-full border rounded-md p-2 focus:ring-2 focus:ring-blue-500 outline-none" />
                </div>
                <div>
                    <label class="text-sm text-gray-600">Status</label>
                    <select id="staffStatus"
                        class="w-full border rounded-md p-2 focus:ring-2 focus:ring-blue-500 outline-none">
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-end gap-2 mt-5">
                <button id="cancelModal"
                    class="border border-gray-300 px-4 py-2 rounded-md hover:bg-gray-100">Cancel</button>
                <button id="saveStaffBtn"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">Save</button>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script>
        const modal = document.getElementById("addStaffModal");
        const addBtn = document.getElementById("addStaffBtn");
        const cancelBtn = document.getElementById("cancelModal");
        const saveBtn = document.getElementById("saveStaffBtn");
        const tableBody = document.getElementById("staffTableBody");
        const searchInput = document.getElementById("searchInput");

        addBtn.addEventListener("click", () => modal.classList.remove("hidden"));
        cancelBtn.addEventListener("click", () => modal.classList.add("hidden"));

        saveBtn.addEventListener("click", () => {
            const name = document.getElementById("staffName").value.trim();
            const dept = document.getElementById("staffDept").value.trim();
            const status = document.getElementById("staffStatus").value;

            if (!name || !dept) {
                alert("Please fill in all fields.");
                return;
            }

            const newId = "STAFF-" + String(tableBody.children.length + 1).padStart(3, "0");
            const newRow = document.createElement("tr");
            newRow.className = "hover:bg-gray-50 active:bg-gray-100 transition";
            newRow.innerHTML = `
                <td class="p-3 border-b text-gray-800">${newId}</td>
                <td class="p-3 border-b">${name}</td>
                <td class="p-3 border-b">${dept}</td>
                <td class="p-3 border-b font-medium ${status === "Active" ? "text-green-600" : "text-red-500"}">${status}</td>
            `;
            tableBody.appendChild(newRow);
            modal.classList.add("hidden");
            document.getElementById("staffName").value = "";
            document.getElementById("staffDept").value = "";
        });

        searchInput.addEventListener("keyup", () => {
            const filter = searchInput.value.toLowerCase();
            Array.from(tableBody.getElementsByTagName("tr")).forEach((row) => {
                const name = row.cells[1].textContent.toLowerCase();
                const dept = row.cells[2].textContent.toLowerCase();
                row.style.display = name.includes(filter) || dept.includes(filter) ? "" : "none";
            });
        });
    </script>
</body>
</html>
