</main>
<footer class="text-center mt-5 py-3 border-top">
    <p>&copy; <?= date('Y') ?> - SwimLearn - Escuela de Natación</p>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.js"></script>


<script type="module" src="<?= rtrim(Env::get('ASSET_URL'), '/') ?>/js/modules/authMain.js"></script>

<?php if(isset($_SESSION['success'])): ?>
<script>
toastr.success("<?= $_SESSION['success'] ?>");
</script>
<?php unset($_SESSION['success']); ?>
<?php endif; ?>

<?php if(isset($_SESSION['error'])): ?>
<script>
toastr.error("<?= $_SESSION['error'] ?>");
</script>
<?php unset($_SESSION['error']); ?>
<?php endif; ?>

</body>

</html>