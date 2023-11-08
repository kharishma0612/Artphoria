// Function to update the total amount based on quantity
function updateTotal() {
    const quantity = document.getElementById('quantity').value;
    const pricePerUnit = 5000; // Replace with the actual price per unit
    const totalAmount = (pricePerUnit * quantity).toFixed(2);
    document.querySelector('.total-amount').textContent = `Total Amount: ${totalAmount}Rs`;
}

// Function to update the star rating display
function updateStars(selectedRating) {
    const stars = document.querySelectorAll('.star');
    stars.forEach((star, index) => {
        if (index < selectedRating) {
            star.innerHTML = '&#9733;'; // Yellow star
        } else {
            star.innerHTML = '&#9734;'; // Empty star
        }
    });
}

// Function to add a user comment
function addComment() {
    const commentInput = document.querySelector('.comment-input');
    const userComment = commentInput.value.trim();
    const selectedRating = getSelectedRating();

    if (userComment) {
        const reviewBox = document.querySelector('.customer-reviews-box');

        const customerReview = document.createElement('div');
        customerReview.classList.add('customer-review');

        // Create a div for displaying the user rating (for demonstration purposes)
        const userRatingDiv = document.createElement('div');
        userRatingDiv.classList.add('user-rating');

        for (let i = 0; i < selectedRating; i++) {
            const starIcon = document.createElement('span');
            starIcon.innerHTML = '&#9733;'; // Yellow star
            userRatingDiv.appendChild(starIcon);
        }

        // Create a paragraph for the user comment
        const userCommentPara = document.createElement('p');
        userCommentPara.classList.add('user-comment');
        userCommentPara.appendChild(userRatingDiv); // Append selected stars to the comment
        userCommentPara.appendChild(document.createTextNode(userComment)); // Add user's comment

        // Add username
        const usernameSpan = document.createElement('span');
        usernameSpan.classList.add('username');
        usernameSpan.textContent = 'Siri Sharvani'; // Replace with the actual username
        userCommentPara.prepend(usernameSpan);

        // Append the comment to the customer review element
        customerReview.appendChild(userCommentPara);

        // Append the customer review to the review box
        reviewBox.appendChild(customerReview);

        // Clear the comment input
        commentInput.value = '';
    }
}

// Function to get the selected rating
function getSelectedRating() {
    const stars = document.querySelectorAll('.star');
    let selectedRating = 0;

    stars.forEach((star, index) => {
        if (star.innerHTML === '&#9733;') {
            selectedRating = index + 1;
        }
    });

    return selectedRating;
}

// Event listener for star clicks
const stars = document.querySelectorAll('.star');
stars.forEach((star, index) => {
    star.addEventListener('click', () => {
        const rating = index + 1;
        updateStars(rating);
    });
});

// Event listener for adding comments
const addCommentButton = document.querySelector('.add-comment-button');
addCommentButton.addEventListener('click', addComment);

// Event listener for quantity change
const quantityInput = document.getElementById('quantity');
quantityInput.addEventListener('change', updateTotal);

// Initial update of total amount
updateTotal();