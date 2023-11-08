
document.addEventListener('DOMContentLoaded', function () {
    const menuItems = document.querySelectorAll('.menu li a');
    const videoContainers = document.querySelectorAll('.video-container > div');

    menuItems.forEach(function (item) {
        item.addEventListener('click', function (event) {
            event.preventDefault();
            const selectedType = item.textContent.toLowerCase();
            videoContainers.forEach(function (container) {
                if (container.classList.contains(selectedType + '-videos')) {
                    container.classList.remove('inactive');
                } else {
                    container.classList.add('inactive');
                }
            });
        });
    });
});
function goToMainPage() {
    window.location.href = "../templates/tutorial.html";
}
const menuItems = document.querySelectorAll('.menu li a');
const sketchVideos = document.querySelector('.sketch-videos');
const paintVideos = document.querySelector('.paint-videos');
const diyVideos = document.querySelector('.diy-videos');

menuItems.forEach(item => {
    item.addEventListener('click', function (event) {
        event.preventDefault();
        const selectedType = this.textContent.toLowerCase();
        sketchVideos.style.display = 'none';
        paintVideos.style.display = 'none';
        diyVideos.style.display = 'none';
        if (selectedType === 'sketch') {
            sketchVideos.style.display = 'block';
        } else if (selectedType === 'paint') {
            paintVideos.style.display = 'block';
        } else if (selectedType === 'diy') {
            diyVideos.style.display = 'block';
        }
    });
});