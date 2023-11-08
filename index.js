document.getElementById("loginButton").addEventListener("click", function() {
    window.location.href = "login.html";
  });

document.getElementById("signupButton").addEventListener("click", function() {
        window.location.href = "signup.html";
    });

let slideIndex = 0;
showSlides();
function showSlides() {
    let slides = document.getElementsByClassName("slide");
    
    for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slideIndex++;
    if (slideIndex > slides.length) {
        slideIndex = 1;
    }
    slides[slideIndex - 1].style.display = "block";
    setTimeout(showSlides, 3000);
}