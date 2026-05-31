// Reference to the form and appointments list
const appointmentForm = document.getElementById("appointmentForm");
const appointmentsList = document.getElementById("appointmentsList");

// Array to hold appointments
let appointments = [];

// Add an appointment
appointmentForm.addEventListener("submit", (event) => {
    event.preventDefault(); // Prevent form submission

    // Collect form data
    const name = document.getElementById("name").value;
    const email = document.getElementById("email").value;
    const doctor = document.getElementById("doctor").value;
    const date = document.getElementById("appointmentDate").value;
    const time = document.getElementById("appointmentTime").value;

    // Add appointment to the list
    const newAppointment = { name, email, doctor, date, time };
    appointments.push(newAppointment);

    // Update the UI
    renderAppointments();

    // Reset the form
    appointmentForm.reset();
});

// Render appointments in the table
function renderAppointments() {
    appointmentsList.innerHTML = ""; // Clear existing appointments

    appointments.forEach((appointment, index) => {
        const row = document.createElement("tr");

        row.innerHTML = `
            <td>${index + 1}</td>
            <td>${appointment.name}</td>
            <td>${appointment.email}</td>
            <td>${appointment.doctor}</td>
            <td>${appointment.date}</td>
            <td>${appointment.time}</td>
            <td class="actions">
                <button onclick="deleteAppointment(${index})">Delete</button>
            </td>
        `;

        appointmentsList.appendChild(row);
    });
}

function deleteAppointment(index) {
    appointments.splice(index, 1); 
    renderAppointments(); 
}
