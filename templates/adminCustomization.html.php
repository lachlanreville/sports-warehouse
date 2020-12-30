<style>
    <?php if(isset($_SESSION['background'])):?>
        body {
            background-color: <?= $_SESSION['background'] ?>;
        }
    <?php else: ?>
        body {
            background-color: white;
        }
    <?php endif; ?>
</style>