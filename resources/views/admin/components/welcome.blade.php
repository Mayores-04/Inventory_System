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
        <h1 class="text-3xl font-bold text-center mb-6">Student Management</h1>

        <form id="studentForm" class="flex flex-col md:flex-row items-center justify-center gap-2 mb-4">
            <input type="text" id="first_name" placeholder="First Name" required class="border border-gray-300 p-2 rounded flex-grow">
            <input type="text" id="last_name" placeholder="Last Name" required class="border border-gray-300 p-2 rounded flex-grow">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Add Student</button>
        </form>

        <!-- Message Display -->
        <div id="messageBox" class="hidden text-center py-2 px-4 rounded-md mt-2"></div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 text-center">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="py-2 px-4 border-b">First Name</th>
                        <th class="py-2 px-4 border-b">Last Name</th>
                        <th class="py-2 px-4 border-b">Action</th>
                    </tr>
                </thead>
                <tbody id="studentTableBody"></tbody>
            </table>
        </div>
    </div>

    <script>
        const studentApiUrl = "http://127.0.0.1:8000/api/students";

        function showMessage(message, type = "success") {
            const messageBox = document.getElementById('messageBox');
            messageBox.textContent = message;
            messageBox.className = `text-white py-2 px-4 rounded-md mt-2 ${
                type === "success" ? "bg-green-500" : "bg-red-500"
            }`;
            messageBox.classList.remove('hidden');

            setTimeout(() => {
                messageBox.classList.add('hidden');
            }, 3000);
        }

        function fetchStudents() {
            axios.get(studentApiUrl)
                .then(response => {
                    const tableBody = document.getElementById('studentTableBody');
                    tableBody.innerHTML = '';

                    if (response.data.length === 0) {
                        showMessage("No students found.", "error");
                        return;
                    }

                    response.data.forEach(student => {
                        const row = document.createElement('tr');
                        row.classList.add('hover:bg-gray-100');

                        row.innerHTML = `
                            <td class="py-2 px-4 border-b">${student.first_name}</td>
                            <td class="py-2 px-4 border-b">${student.last_name}</td>
                            <td class="py-2 px-4 border-b">
                                <a href="/student/${student.id}" 
                                    class="bg-green-500 mr-2 text-white py-1 px-3 rounded hover:bg-green-600 transition">
                                    View Details
                                </a>
                            </td>
                        `;
                        tableBody.appendChild(row);
                    });
                })
                .catch(error => {
                    showMessage("❌ Error fetching students!", "error");
                    console.error("Fetch error:", error);
                });
        }

        function AddGrade(){
            alert("g");
        }
        

        document.getElementById('studentForm').addEventListener('submit', function(event) {
            event.preventDefault();
            
            const firstName = document.getElementById("first_name").value.trim();
            const lastName = document.getElementById("last_name").value.trim();

            if (!firstName || !lastName) {
                showMessage("⚠️ First Name and Last Name are required!", "error");
                return;
            }
            
            const studentData = {
                first_name: firstName,
                last_name: lastName
            };

            axios.post(studentApiUrl, studentData, {
                headers: { 'Content-Type': 'application/json' }
            })
            .then(() => {
                showMessage("✅ Student added successfully!", "success");
                fetchStudents();
                document.getElementById('studentForm').reset();
            })
            .catch(error => {
                console.error("Add error:", error.response ? error.response.data : error);
                showMessage("❌ Failed to add student: " + (error.response?.data?.error || "Unknown error"), "error");
            });

        });



        fetchStudents();
    </script>
</body>

</html>
