<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Grades Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.min.js"></script>
</head>

<body class="bg-gray-100 text-gray-900 flex flex-col items-center p-6 lg:p-8">
    <div class="container mx-auto p-6 bg-white shadow-md rounded-lg w-full max-w-3xl">
        <h1 class="text-3xl font-bold text-center mb-6">Jake List of Grades</h1>

        <form id="gradeForm" class="flex flex-col md:flex-row items-center justify-center gap-2 mb-4">
            <input type="text" id="studentName" placeholder="Student Name" required
                class="border border-gray-300 p-2 rounded flex-grow">
            <input type="number" id="grade" placeholder="Grade (0-100)" min="0" max="100" required
                class="border border-gray-300 p-2 rounded w-24">
            <button type="submit"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                Add Grade
            </button>
        </form>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 text-center">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="py-2 px-4 border-b">Student Name</th>
                        <th class="py-2 px-4 border-b">Grade</th>
                        <th class="py-2 px-4 border-b">Action</th>
                    </tr>
                </thead>
                <tbody id="tableBody"></tbody>
            </table>
        </div>
    </div>

    <script>
        const apiUrl = "http://127.0.0.1:8000/api/grades";

        function fetchGrades() {
            axios.get(apiUrl)
                .then(response => {
                    console.log("✅ Grades fetched:", response.data);
                    const tableBody = document.getElementById('tableBody');
                    tableBody.innerHTML = '';

                    response.data.forEach(grade => {
                        const row = document.createElement('tr');
                        row.classList.add('hover:bg-gray-100');

                        row.innerHTML = `
                <td class="py-2 px-4 border-b">${grade.student_name}</td>
                <td class="py-2 px-4 border-b">${grade.grade}</td>
                <td class="py-2 px-4 border-b">
                    <button class="bg-red-500 text-white py-1 px-3 rounded hover:bg-red-600 transition"
                            onclick="deleteGrade('${grade._id}')">
                        Delete
                    </button>
                </td>
            `;
                        tableBody.appendChild(row);
                    });
                })
                .catch(error => console.error("❌ Fetch error:", error));

        }

        document.getElementById('gradeForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const studentName = document.getElementById('studentName').value.trim();
            const grade = parseInt(document.getElementById('grade').value);

            if (!studentName || isNaN(grade) || grade < 0 || grade > 100) {
                alert('⚠️ Please enter a valid student name and grade (0-100).');
                return;
            }

            axios.post(apiUrl, {
                    student_name: studentName,
                    grade: grade
                })
                .then(response => {
                    alert('✅ Grade added successfully!');
                    document.getElementById('gradeForm').reset();
                    fetchGrades();
                })
                .catch(error => {
                    console.error("❌ Add error:", error);
                    alert('❌ Failed to add grade. Check the console for details.');
                });
        });


        function deleteGrade(id) {
            if (confirm("Are you sure you want to delete this grade?")) {
                axios.delete(`${apiUrl}/${id}`).then(() => fetchGrades());
            }
        }

        fetchGrades();
    </script>
</body>

</html>