</main>
<!-- The Close Div Tag of class container -->
</div>
<div id="toast__container"></div>
<script src="<?= public_dir('/js/toolTip.js') ?>"></script>
<script src="<?= public_dir('/js/toastMessage.js') ?>"></script>
<?php
    include './Views/Partials/toast.php';
    if (!empty($extraJS)) {
        foreach ($extraJS as $js) {
            echo '<script src="' . $js . '"></script>';
        }
    }
?>
<script src="<?= public_dir('js/AdminJs/script.js') ?>"></script>
</body>
</html>
