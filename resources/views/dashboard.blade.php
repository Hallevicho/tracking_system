<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Student Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    />
    <style>
        body {
            font-family: "Inter", sans-serif;
        }
        .info-label {
            font-weight: 600;
            color: #4b5563;
            font-size: 1.1rem;
        }
        .info-value {
            color: #6b7280;
            font-size: 1.1rem;
        }
        .input-field {
            border-radius: 0.5rem;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            width: 100%;
            font-size: 1rem;
            margin-bottom: 1.5rem;
        }
        .input-field:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-100 to-purple-100 p-6">
    <!-- Navigation removed -->

    <div
        class="container max-w-3xl mx-auto bg-white shadow-2xl rounded-xl p-12"
        id="dashboard-container"
    >
        <h1
            class="text-5xl font-bold text-indigo-700 text-center mb-12 bg-gradient-to-r from-indigo-400 to-purple-500 text-transparent bg-clip-text"
        >
            Student Dashboard
        </h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10" id="student-info-display">
            <div class="flex items-center gap-10">
                <div
                    class="w-32 h-32 rounded-full bg-indigo-500  flex items-center justify-center shadow-lg"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        class="lucide lucide-user text-white w-12 h-12"
                    >
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </div>
                <div class="text-gray-800 font-semibold text-2xl">
                    <div class="flex flex-col gap-2">
                        <div>Student Information</div>
                    </div>
                </div>
            </div>
            <div class="text-xl">
                <p>
                    <span class="info-label">Student ID:</span>
                    <span class="info-value" id="display-studentid">12345</span>
                </p>
                <p>
                    <span class="info-label">First Name:</span>
                    <span class="info-value" id="display-firstname">Jane</span>
                </p>
                <!-- Middle Name removed here -->
                <p>
                    <span class="info-label">Last Name:</span>
                    <span class="info-value" id="display-lastname">Smith</span>
                </p>
                <p>
                    <span class="info-label">Course:</span>
                    <span class="info-value" id="display-course"
                        >BS Information Technology</span
                    >
                </p>
                <p>
                    <span class="info-label">School Attended:</span>
                    <span class="info-value" id="display-school"
                        >University of Science and Technology of Southern Philippines</span
                    >
                </p>
            </div>
        </div>

        <div
            class="mb-8 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-md shadow-md"
            role="alert"
            id="attendance-info-box"
        >
            <p class="font-semibold text-lg">Section/Dept Time Stamp Schedule</p>
        </div>

        <div
            class="flex flex-col md:flex-row justify-end gap-6 mt-8"
        >
            <select
                id="section-select"
                class="border rounded-md py-3 px-4 text-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
            >
                <option value="" disabled selected>Select Section</option>
                <option value="Section 1">Section 1</option>
                <option value="Section 2">Section 2</option>
                <option value="Section 3">Section 3</option>
            </select>
            <button
                id="take-attendance-button"
                class="bg-green-600 hover:bg-green-700 text-white font-bold py-4 px-8 rounded-lg focus:outline-none focus:shadow-outline text-xl"
            >
                Take Attendance
            </button>
            <button
                id="edit-profile-button"
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 px-8 rounded-lg focus:outline-none focus:shadow-outline text-xl"
            >
                Edit Profile
            </button>

            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button
                    type="submit"
                    class="bg-red-600 hover:bg-red-700 text-white font-bold py-4 px-8 rounded-lg focus:outline-none focus:shadow-outline text-xl"
                >
                    Logout
                </button>
            </form>
        </div>

        <div
            id="timestamp-display"
            class="mt-6 text-gray-600 text-lg flex justify-between items-center"
        >
            <span id="timestamp-text"></span>
            <button
                id="delete-attendance-button"
                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline text-md hidden"
            >
                Delete Attendance
            </button>
        </div>
    </div>

    <div
        class="container max-w-3xl mx-auto bg-white shadow-2xl rounded-xl p-12 hidden"
        id="edit-profile-form"
    >
        <h1
            class="text-5xl font-bold text-indigo-700 text-center mb-12 bg-gradient-to-r from-indigo-400 to-purple-500 text-transparent bg-clip-text"
        >
            Edit Profile
        </h1>
        <form id="edit-form">
            <label for="edit-studentid" class="info-label">Student ID:</label>
            <input
                type="text"
                id="edit-studentid"
                name="studentid"
                class="input-field"
                value="12345"
                readonly
            />

            <label for="edit-firstname" class="info-label">First Name:</label>
            <input
                type="text"
                id="edit-firstname"
                name="firstname"
                class="input-field"
                value="Jane"
            />

            <!-- Middle Name removed here -->

            <label for="edit-lastname" class="info-label">Last Name:</label>
            <input
                type="text"
                id="edit-lastname"
                name="lastname"
                class="input-field"
                value="Smith"
            />

            <label for="edit-course" class="info-label">Course:</label>
            <input
                type="text"
                id="edit-course"
                name="course"
                class="input-field"
                value="BS Information Technology"
            />

            <label for="edit-school" class="info-label">School Attended:</label>
            <input
                type="text"
                id="edit-school"
                name="school"
                class="input-field"
                value="University of Science and Technology of Southern Philippines"
            />

            <div class="flex justify-end gap-4 mt-8">
                <button
                    type="button"
                    id="cancel-edit-button"
                    class="bg-gray-400 hover:bg-gray-500 text-white font-bold py-3 px-6 rounded-lg focus:outline-none focus:shadow-outline text-xl"
                >
                    Cancel
                </button>
                <button
                    type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg focus:outline-none focus:shadow-outline text-xl"
                >
                    Save Changes
                </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const takeAttendanceBtn = document.getElementById("take-attendance-button");
            const editProfileBtn = document.getElementById("edit-profile-button");
            const dashboardContainer = document.getElementById("dashboard-container");
            const editProfileForm = document.getElementById("edit-profile-form");
            const cancelEditBtn = document.getElementById("cancel-edit-button");
            const editForm = document.getElementById("edit-form");

            const timestampDisplay = document.getElementById("timestamp-text");
            const deleteAttendanceBtn = document.getElementById("delete-attendance-button");

            // Take Attendance functionality
            takeAttendanceBtn.addEventListener("click", () => {
                const selectedSection = document.getElementById("section-select").value;
                if (!selectedSection) {
                    alert("Please select a section before taking attendance.");
                    return;
                }

                // Set timestamp text with current date and time
                const now = new Date();
                timestampDisplay.textContent = `Attendance taken for ${selectedSection} at ${now.toLocaleString()}`;

                // Show delete button
                deleteAttendanceBtn.classList.remove("hidden");
            });

            // Delete attendance functionality
            deleteAttendanceBtn.addEventListener("click", () => {
                if (confirm("Are you sure you want to delete the attendance record?")) {
                    timestampDisplay.textContent = "";
                    deleteAttendanceBtn.classList.add("hidden");
                }
            });

            // Show Edit Profile form and hide dashboard
            editProfileBtn.addEventListener("click", () => {
                dashboardContainer.classList.add("hidden");
                editProfileForm.classList.remove("hidden");
            });

            // Cancel edit: hide form, show dashboard
            cancelEditBtn.addEventListener("click", () => {
                editProfileForm.classList.add("hidden");
                dashboardContainer.classList.remove("hidden");
            });

            // Save profile changes
            editForm.addEventListener("submit", (e) => {
                e.preventDefault();

                // Get form values
                const studentid = document.getElementById("edit-studentid").value;
                const firstname = document.getElementById("edit-firstname").value;
                const lastname = document.getElementById("edit-lastname").value;
                const course = document.getElementById("edit-course").value;
                const school = document.getElementById("edit-school").value;

                // Update dashboard display
                document.getElementById("display-studentid").textContent = studentid;
                document.getElementById("display-firstname").textContent = firstname;
                document.getElementById("display-lastname").textContent = lastname;
                document.getElementById("display-course").textContent = course;
                document.getElementById("display-school").textContent = school;

                // Hide form, show dashboard
                editProfileForm.classList.add("hidden");
                dashboardContainer.classList.remove("hidden");

                alert("Profile updated successfully!");
            });
        });
    </script>
</body>
</html>
