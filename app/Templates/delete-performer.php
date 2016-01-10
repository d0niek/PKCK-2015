<?php require_once("$basePath/header.php"); ?>

<link rel="stylesheet" href="<?php echo $baseUrl; ?>/style/style.css">
<link rel="stylesheet" href="<?php echo $baseUrl; ?>/style/form.css">
<link rel="stylesheet" href="<?php echo $baseUrl; ?>/style/delete-performer.css">

<h2 id="delete-performer-title">Delete performer</h2>

<?php if (isset($_SESSION['validMessage'])): ?>
    <p class="valid-message"><?php echo $_SESSION['validMessage']; ?></p>
    <?php unset($_SESSION['validMessage']); ?>
<?php endif; ?>

<div id="<?php echo $performer->getId(); ?>" class="performer">
    <h3><?php echo $performer->getName(); ?></h3>
</div>

<form id="delete-performer-form" action="<?php echo "$baseUrl/delete-performer/" . $performer->getId(); ?>" method="post">
    <input type="hidden" title="performerId" name="performerId" value="<?php echo $performer->getId(); ?>">

    <input type="submit" value="Usuń wykonawcę">
</form>

<?php require_once("$basePath/footer.php"); ?>
