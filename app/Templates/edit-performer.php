<?php require_once("$basePath/header.php"); ?>

<link rel="stylesheet" href="<?php echo $baseUrl; ?>/style/form.css">
<link rel="stylesheet" href="<?php echo $baseUrl; ?>/style/performer.css">

<h2 id="edit-performer-title">Edit new performer</h2>

<?php if (isset($_SESSION['validMessage'])): ?>
    <p class="valid-message"><?php echo $_SESSION['validMessage']; ?></p>
    <?php unset($_SESSION['validMessage']); ?>
<?php endif; ?>

<form id="edit-performer-form" action="<?php echo "$baseUrl/performer/edit/" . $performer->getId(); ?>"
    method="post">
    <div class="form-group">
        <label>Nazwa</label>
        <input type="text" title="name" name="name"
            value="<?php echo $form->getField('name')['value'] ?
                $form->getField('name')['value'] :
                $performer->getName(); ?>">
    </div>

    <div class="form-group">
        <label>Gatunek</label>
        <select title="type" name="type">
            <?php foreach ($types as $type): ?>
                <option value="<?php echo $type; ?>"
                    <?php echo $type === $form->getField('type')['value'] ?
                        $form->getField('type')['value'] :
                        $performer->getType()
                            ? 'selected' : ''; ?>>
                    <?php echo $type; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label>Członków</label>
        <input type="text" title="members" name="members"
            value="<?php echo $form->getField('members')['value'] ?
                $form->getField('members')['value'] :
                $performer->getMembers(); ?>">
    </div>

    <div class="form-group">
        <input type="submit" value="Edytuj wykonawcę">
    </div>

    <a class="go-back" href="<?php echo "$baseUrl/performers"; ?>">← Wróć</a>
</form>

<?php require_once("$basePath/footer.php"); ?>
