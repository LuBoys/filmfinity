document.addEventListener('DOMContentLoaded', function() {
    const images = document.querySelectorAll('.film-image');
    images.forEach(img => {
        img.addEventListener('click', function() {
            if (this.classList.contains('zoomed')) {
                this.classList.remove('zoomed');
            } else {
                // Retirer la classe 'zoomed' de toute autre image qui pourrait être zoomée
                images.forEach(innerImg => innerImg.classList.remove('zoomed'));
                this.classList.add('zoomed');
            }
        });
    });

    // Fermer le zoom en cliquant en dehors de l'image
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('zoomed') === false) {
            images.forEach(img => img.classList.remove('zoomed'));
        }
    });
});
