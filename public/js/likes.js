// public/js/likes.js

document.addEventListener('DOMContentLoaded', function() {
    // Gérer tous les boutons de like
    document.querySelectorAll('.like-btn').forEach(button => {
        button.addEventListener('click', async function(e) {
            e.preventDefault();
            
            const postId = this.dataset.postId;
            const url = `/post/${postId}/like`;
            
            try {
                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    }
                });
                
                const data = await response.json();
                
                if (data.success) {
                    // Mettre à jour l'icône
                    const icon = this.querySelector('i');
                    if (data.liked) {
                        icon.classList.remove('bi-heart');
                        icon.classList.add('bi-heart-fill', 'text-danger');
                        this.classList.add('liked');
                    } else {
                        icon.classList.remove('bi-heart-fill', 'text-danger');
                        icon.classList.add('bi-heart');
                        this.classList.remove('liked');
                    }
                    
                    // Mettre à jour le compteur
                    const counter = this.querySelector('.like-count');
                    if (counter) {
                        counter.textContent = data.likesCount;
                    }
                    
                    // Animation
                    this.classList.add('pulse');
                    setTimeout(() => {
                        this.classList.remove('pulse');
                    }, 300);
                }
            } catch (error) {
                console.error('Erreur:', error);
            }
        });
    });
});