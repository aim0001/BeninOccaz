document.addEventListener('DOMContentLoaded', function() {
    // Animation pour les inputs
    const inputs = document.querySelectorAll('input');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentNode.querySelector('label').classList.add('text-marketplace-primary');
        });
        input.addEventListener('blur', function() {
            if (!this.value) {
                this.parentNode.querySelector('label').classList.remove('text-marketplace-primary');
            }
        });
    });
});