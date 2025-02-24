import './bootstrap';

document.addEventListener('DOMContentLoaded', function () {
    const avatarButtons = document.querySelectorAll('.avatar-button');
    avatarButtons.forEach(button => {
        button.addEventListener('click', openImageModal);
    });

    const closeButtons = document.querySelectorAll('[data-close-modal]');
    closeButtons.forEach(button => {
        button.addEventListener('click', closeImageModal);
    });
});

function openImageModal() {
    document.getElementById('image-modal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeImageModal() {
    document.getElementById('image-modal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}
