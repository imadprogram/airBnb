<?php if (isset($_SESSION['toast'])): ?>
    <script>
        Toastify({
            text: "<?= $_SESSION['toast']['message'] ?>",
            duration: 3000,
            close: true,
            gravity: "top",
            position: "right",
            stopOnFocus: true,
            style: {
                background: "<?= $_SESSION['toast']['type'] == 'success' ? 'linear-gradient(to right, #059669, #34d399)' : 'linear-gradient(to right, #dc2626, #f87171)' ?>",
                borderRadius: "10px",
                fontWeight: "bold"
            },
        }).showToast();
    </script>
    
    <?php 
    unset($_SESSION['toast']); 
    ?>
<?php endif; ?>