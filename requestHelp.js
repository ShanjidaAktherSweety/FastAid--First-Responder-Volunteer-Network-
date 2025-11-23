// DOM Elements
const form = document.getElementById("requestHelpForm");
const requestType = document.getElementById("request-type");
const nameField = document.getElementById("name");
const emailField = document.getElementById("email");
const phoneField = document.getElementById("phone");
const locationField = document.getElementById("location");
const descriptionField = document.getElementById("description");
const errorBox = document.getElementById("errorBox");

// Display error function
function displayError(message) {
    errorBox.style.display = "block";
    errorBox.textContent = message;
    setTimeout(() => {
        errorBox.style.display = "none";
    }, 3000);
}

// Form submit event
form.addEventListener("submit", (e) => {

    let valid = true;

    // Validation
    if (!requestType.value) {
        displayError("Please select request type.");
        valid = false;
    }

    if (!nameField.value.trim()) {
        displayError("Please enter your name.");
        valid = false;
    }

    if (!emailField.value.trim() || !emailField.value.includes("@")) {
        displayError("Please enter a valid email.");
        valid = false;
    }

    if (!phoneField.value.trim() || phoneField.value.length < 10) {
        displayError("Please enter a valid phone number.");
        valid = false;
    }

    if (!locationField.value.trim()) {
        displayError("Please enter your location.");
        valid = false;
    }

    // If validation fails → stop submission
    if (!valid) {
        e.preventDefault();   // block submission only when invalid
        return;
    }

    // If validation passes → DO NOT prevent submission
    // The form will automatically submit to save_request.php
});
