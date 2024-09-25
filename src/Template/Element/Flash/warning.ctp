<?php if (!empty($message)): ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: 'Aviso',
            text: '<?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>',
            icon: 'warning',
            timer: 5000, 
            timerProgressBar: true,
            showCloseButton: true, 
            confirmButtonText: 'OK', 
            didOpen: () => {
                Swal.showLoading();
            },
            willClose: () => {
                Swal.hideLoading();
            }
        });
    });
    </script>
<?php endif; ?>
