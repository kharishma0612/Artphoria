const fileInput = document.getElementById('file-input');
const profileImage = document.getElementById('profile-image');
const cameraIcon = document.querySelector('.camera-icon');

// Add an event listener to the file input
fileInput.addEventListener('change', (event) => {
    const selectedFile = event.target.files[0];

    if (selectedFile) {
        // Create a FileReader to read the selected file
        const reader = new FileReader();

        reader.onload = (e) => {
            // Set the src attribute of the profile image to the data URL of the selected file
            profileImage.src = e.target.result;
            
            // Hide the camera icon when a new profile picture is set
            cameraIcon.style.display = 'none';
        };

        // Read the selected file as a data URL
        reader.readAsDataURL(selectedFile);
    }
});

const updateEmailButton = document.getElementById('update-email');
const emailDisplay = document.getElementById('email-display');

// Add a click event listener to the "Change Email" button
updateEmailButton.addEventListener('click', () => {
    // Prompt the user for a new email
    const newEmail = prompt('Enter a new email address:');
    
    // Check if the user provided a new email and update the display
    if (newEmail !== null && newEmail !== '') {
        emailDisplay.textContent = newEmail;
    }
});

const updatePhoneButton = document.getElementById('update-phone');
const phoneDisplay = document.getElementById('phone-display');

// Add a click event listener to the "Change Phone Number" button
updatePhoneButton.addEventListener('click', () => {
    // Prompt the user for a new phone number
    const newPhoneNumber = prompt('Enter a new phone number:');
    
    // Check if the user provided a new phone number and update the display
    if (newPhoneNumber !== null && newPhoneNumber !== '') {
        phoneDisplay.textContent = newPhoneNumber;
    }
});