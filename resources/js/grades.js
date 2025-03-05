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
            <button class="bg-red-500 text-white py-1 px-3 rounded hover:bg-red-600 transition"
                    onclick="deleteGrade('${grade.id}')">
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

    const first_name = document.getElementById('first_name').value.trim();
    const last_name = document.getElementById('last_name').value.trim();
    const subject = document.getElementById('subject').value.trim();
    const grade = parseInt(document.getElementById('grade').value);

    if (!first_name || !last_name || !subject || isNaN(grade) || grade < 0 || grade > 100) {
        alert('⚠️ Please enter a valid student name and grade (0-100).');
        return;
    }

    axios.post(apiUrl, {
            first_name: first_name,
            last_name: last_name,
            subject: subject,
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
        alert('Grade successfully deleted');
    }
}

fetchGrades();