const heroImages = [
    "assets/images/hero1.jpg",
    "assets/images/hero2.jpg",
    "assets/images/hero3.jpg",
    "assets/images/hero4.jpg"
];

let currentIndex = 0;
const heroImage = document.getElementById("heroImage");

setInterval(() => {
    heroImage.style.opacity = 0;
    setTimeout(() => {
        currentIndex = (currentIndex + 1) % heroImages.length;
        heroImage.src = heroImages[currentIndex];
        heroImage.style.opacity = 1; // Fade in
    }, 4000); 

}, 20000); 
