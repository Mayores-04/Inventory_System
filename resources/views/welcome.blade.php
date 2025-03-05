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
    <div class="container mx-auto p-6 bg-white shadow-md rounded-lg w-full max-w-[90%]">
        <h1 class="text-3xl font-bold text-center mb-6">Grades Management</h1>

        <form id="gradeForm" class="flex flex-col md:flex-row items-center justify-center gap-2 mb-4">
            <input type="text" id="first_name" placeholder="First Name" required
                class="border border-gray-300 p-2 rounded flex-grow">
            <input type="text" id="last_name" placeholder="Last Name" required
                class="border border-gray-300 p-2 rounded flex-grow">
            <select id="subject" class="border border-gray-300 p-2 rounded">
                <option value="">Choose Subject</option>
                <option value="CP1">Computer Programming 1</option>
                <option value="CP2">Computer Programming 2</option>
                <option value="MMW">MMW</option>
                <option value="CollegeCalculus">College Calculus</option>
            </select>
            <input type="number" id="grade" placeholder="Grade" min="0" max="100" required
                class="border border-gray-300 p-2 rounded w-24">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                Add Grade
            </button>
        </form>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 text-center">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="py-2 px-4 border-b">First Name</th>
                        <th class="py-2 px-4 border-b">Last Name</th>
                        <th class="py-2 px-4 border-b">Subject</th>
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
                            <td class="py-2 px-4 border-b">${grade.first_name}</td>
                            <td class="py-2 px-4 border-b">${grade.last_name}</td>
                            <td class="py-2 px-4 border-b">${grade.subject}</td>
                            <td class="py-2 px-4 border-b">${grade.grade}</td>
                            <td class="py-2 px-4 border-b">
                                <button class="bg-green-500 text-white py-1 px-3 rounded hover:bg-green-600 transition"
                                        onclick="deleteGrade('${grade._id}')">
                                    Edit
                                </button>
                                <button class="bg-red-500 text-white py-1 px-3 rounded hover:bg-red-600 transition"
                                        onclick="deleteGrade('${grade._id}')">
                                    Delete
                                </button>
                                <button class="bg-gray-500 text-white py-1 px-3 rounded hover:bg-gray-600 transition"
                                        onclick="deleteGrade('${grade._id}')">
                                    Details
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

            const first_name = document.getElementById('first_name').value.trim();
            const last_name = document.getElementById('last_name').value.trim();
            const subject = document.getElementById('subject').value.trim();
            const grade = parseInt(document.getElementById('grade').value);

            if (!first_name || !last_name || !subject || isNaN(grade) || grade < 0 || grade > 100) {
                alert('⚠️ Please enter a valid student name and grade (0-100).');
                return;
            }

            axios.post(apiUrl, {
                    first_name,
                    last_name,
                    subject,
                    grade
                })
                .then(() => {
                    alert('✅ Grade added successfully!');
                    document.getElementById('gradeForm').reset();
                    fetchGrades();
                })
                .catch(error => console.error("❌ Add error:", error));
        });

        fetchGrades();
    </script>
</body>

</html>