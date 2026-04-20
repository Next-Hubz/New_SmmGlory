document.addEventListener('DOMContentLoaded', function() {
    const starContainer = document.getElementById('star-container');
    if (!starContainer) return;

    // UI/UX Friendly: Reduced star count for better performance while maintaining visual density
    const starCount = 800; 

    const fragment = document.createDocumentFragment();

    for (let i = 0; i < starCount; i++) {
        const star = document.createElement('div');
        star.classList.add('star');

        // Random positioning
        const left = Math.random() * 100;
        const top = Math.random() * 100;
        star.style.left = `${left}%`;
        star.style.top = `${top}%`;

        // Size distribution (more small stars, fewer large ones)
        const sizeRandom = Math.random();
        if (sizeRandom > 0.98) {
            star.classList.add('xl');
        } else if (sizeRandom > 0.9) {
            star.classList.add('large');
        } else if (sizeRandom > 0.6) {
            star.classList.add('medium');
        } else {
            star.classList.add('small');
        }

        // Animation timing
        const duration = 2 + Math.random() * 4; // 2s to 6s
        const delay = Math.random() * 5;
        
        star.style.setProperty('--duration', `${duration}s`);
        star.style.setProperty('--delay', `${delay}s`);

        fragment.appendChild(star);
    }

    // Add shooting stars (reduced count for subtlety)
    for (let i = 0; i < 4; i++) {
        const shootingStar = document.createElement('div');
        shootingStar.classList.add('shooting-star');
        shootingStar.style.top = `${Math.random() * 50}%`;
        shootingStar.style.left = `${Math.random() * 100}%`;
        shootingStar.style.animationDelay = `${Math.random() * 15}s`;
        fragment.appendChild(shootingStar);
    }

    starContainer.appendChild(fragment);
});