<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900 flex flex-col items-center p-6 lg:p-8">

    <div class="container mx-auto p-6 bg-white shadow-md rounded-lg w-full max-w-[90%]">
        <h1 class="text-3xl font-bold text-center mb-6">Student Details</h1>

        <div class="mb-6 p-4 border border-gray-300 rounded-lg">
            <p class="text-lg"><strong>First Name:</strong> {{ $student->first_name }}</p>
            <p class="text-lg"><strong>Last Name:</strong> {{ $student->last_name }}</p>
        </div>

        <h2 class="text-2xl font-semibold mb-4">Grades</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 text-center">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="py-2 px-4 border-b">Subject</th>
                        <th class="py-2 px-4 border-b">Grade</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($student->grades as $grade)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $grade->subject }}</td>
                            <td class="py-2 px-4 border-b">{{ $grade->grade }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="py-2 px-4 border-b">No grades available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <a href="{{ url('/') }}" class="mt-6 inline-block bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">
            Back to Student List
        </a>
    </div>

</body>
</html>
