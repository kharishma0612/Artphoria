
function updateTotal() {
    const quantity = document.getElementById('quantity').value;
    const pricePerUnit = 5000; 
    const totalAmount = (pricePerUnit * quantity).toFixed(2);
    document.querySelector('.total-amount').textContent = `Total Amount: ${totalAmount}Rs`;
}
function updateStars(selectedRating) {
    const stars = document.querySelectorAll('.star');
    stars.forEach((star, index) => {
        if (index < selectedRating) {
            star.innerHTML = '&#9733;';
        } else {
            star.innerHTML = '&#9734;'; 
        }
    });
}
function addComment() {
    const commentInput = document.querySelector('.comment-input');
    const userComment = commentInput.value.trim();
    const selectedRating = getSelectedRating();

    if (userComment) {
        const reviewBox = document.querySelector('.customer-reviews-box');

        const customerReview = document.createElement('div');
        customerReview.classList.add('customer-review');
        const userRatingDiv = document.createElement('div');
        userRatingDiv.classList.add('user-rating');

        for (let i = 0; i < selectedRating; i++) {
            const starIcon = document.createElement('span');
            starIcon.innerHTML = '&#9733;';
            userRatingDiv.appendChild(starIcon);
        }
        const userCommentPara = document.createElement('p');
        userCommentPara.classList.add('user-comment');
        userCommentPara.appendChild(userRatingDiv); 
        userCommentPara.appendChild(document.createTextNode(userComment));
        const usernameSpan = document.createElement('span');
        usernameSpan.classList.add('username');
        usernameSpan.textContent = 'Siri Sharvani';
        userCommentPara.prepend(usernameSpan);
        customerReview.appendChild(userCommentPara);
        reviewBox.appendChild(customerReview);
        commentInput.value = '';
    }
}
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
const stars = document.querySelectorAll('.star');
stars.forEach((star, index) => {
    star.addEventListener('click', () => {
        const rating = index + 1;
        updateStars(rating);
    });
});
const addCommentButton = document.querySelector('.add-comment-button');
addCommentButton.addEventListener('click', addComment);
const quantityInput = document.getElementById('quantity');
quantityInput.addEventListener('change', updateTotal);
updateTotal();