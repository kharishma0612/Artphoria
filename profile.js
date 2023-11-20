const fileInput = document.getElementById('file-input');
const profileImage = document.getElementById('profile-image');
const cameraIcon = document.querySelector('.camera-icon');
fileInput.addEventListener('change', (event) => {
    const selectedFile = event.target.files[0];

    if (selectedFile) {
        const reader = new FileReader();

        reader.onload = (e) => {
            profileImage.src = e.target.result;
            cameraIcon.style.display = 'none';
        };
        reader.readAsDataURL(selectedFile);
    }
});

const updateEmailButton = document.getElementById('update-email');
const emailDisplay = document.getElementById('email-display');
updateEmailButton.addEventListener('click', () => {
    const newEmail = prompt('Enter a new email address:');
    if (newEmail !== null && newEmail !== '') {
        emailDisplay.textContent = newEmail;
    }
});

const updatePhoneButton = document.getElementById('update-phone');
const phoneDisplay = document.getElementById('phone-display');
updatePhoneButton.addEventListener('click', () => {
    const newPhoneNumber = prompt('Enter a new phone number:');
    if (newPhoneNumber !== null && newPhoneNumber !== '') {
        phoneDisplay.textContent = newPhoneNumber;
    }
});