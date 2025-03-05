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


fetchStudents();