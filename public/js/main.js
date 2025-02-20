document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('.needs-validation');

    Array.from(forms).forEach(function(form) {
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }

            form.classList.add('was-validated');
        }, false);
    });

    // Ejemplo de petición AJAX para actualizar el estado del usuario
    const userStatusToggles = document.querySelectorAll('.user-status-toggle');
    
    userStatusToggles.forEach(toggle => {
        toggle.addEventListener('change', function() {
            const userId = this.dataset.userId;
            const status = this.checked ? 1 : 0;

            fetch('/users/updateStatus', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ userId, status }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('User status updated successfully');
                } else {
                    console.error('Failed to update user status');
                    this.checked = !this.checked; // Revert the toggle
                }
            })
            .catch((error) => {
                console.error('Error:', error);
                this.checked = !this.checked; // Revert the toggle
            });
        });
    });
});