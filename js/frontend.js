// Simulated data for stats and appointments
const stats = {
    totalAppointments: 70,
    completedAppointments: 50,
    pendingAppointments: 20,
    todayAppointments: 15,
};

const appointments = [
    { id: 1, patientName: "John Doe", time: "10:00 AM", contact: "123-456-7890", status: "Scheduled" },
    { id: 2, patientName: "Jane Smith", time: "11:00 AM", contact: "987-654-3210", status: "Scheduled" },
    { id: 3, patientName: "Mark Johnson", time: "12:30 PM", contact: "555-123-4567", status: "Scheduled" },
    { id: 4, patientName: "Emily Davis", time: "02:00 PM", contact: "333-444-5555", status: "Pending" },
];

// Function to update statistics dynamically
function updateStats() {
    document.querySelector(".stats .card:nth-child(1) p").textContent = stats.todayAppointments;
    document.querySelector(".stats .card:nth-child(2) p").textContent = stats.completedAppointments;
    document.querySelector(".stats .card:nth-child(3) p").textContent = stats.pendingAppointments;
}

// Function to render the appointments table
function renderAppointments() {
    const tbody = document.querySelector(".appointments tbody");
    tbody.innerHTML = ""; // Clear existing rows

    appointments.forEach((appointment, index) => {
        const row = `
            <tr>
                <td>${index + 1}</td>
                <td>${appointment.patientName}</td>
                <td>${appointment.time}</td>
                <td>${appointment.contact}</td>
                <td>${appointment.status}</td>
            </tr>
        `;
        tbody.innerHTML += row;
    });
}

// Function to handle availability update
function updateAvailability(event) {
    event.preventDefault();
    const date = document.getElementById("availability-date").value;
    const time = document.getElementById("availability-time").value;

    if (date && time) {
        alert(`Availability updated for ${date} at ${time}`);
    } else {
        alert("Please fill out both date and time!");
    }
}

// Event listener for form submission
document.addEventListener("DOMContentLoaded", () => {
    updateStats();
    renderAppointments();

    const availabilityForm = document.querySelector(".availability form");
    availabilityForm.addEventListener("submit", updateAvailability);
});
