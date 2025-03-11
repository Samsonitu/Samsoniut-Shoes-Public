<?php if (!empty($_SESSION['toastMessage'])) : ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            toast({ 
                type: <?= json_encode($_SESSION['toastMessage']['type']); ?>,
                title: <?= json_encode($_SESSION['toastMessage']['title']); ?>,
                message: <?= json_encode($_SESSION['toastMessage']['message']); ?>,
            });
        });
    </script>
    <?php $_SESSION['toastMessage'] = null; ?>
<?php endif; ?>
