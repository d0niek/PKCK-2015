<?php require_once("$basePath/header.php"); ?>

<link rel="stylesheet" href="<?php echo $baseUrl; ?>/style/record.css">
<link rel="stylesheet" href="<?php echo $baseUrl; ?>/style/form.css">

<h2 id="add-record-title">Add new record</h2>

<?php if (isset($_SESSION['validMessage'])): ?>
    <p class="valid-message"><?php echo $_SESSION['validMessage']; ?></p>
    <?php unset($_SESSION['validMessage']); ?>
<?php endif; ?>

<form id="add-record-form" action="<?php echo "$baseUrl/add-record"; ?>" method="post">
    <div class="form-group">
        <label>Tytuł</label>
        <input type="text" title="tytuł" name="title"
               value="<?php echo $form->getField('title')['value']; ?>">
    </div>

    <div class="form-group">
        <label>Wykonawca</label>
        <select title="Wykonawcy" name="performers">
            <?php foreach ($performers as $performer): ?>
                <option value="<?php echo $performer->getId(); ?>"
                    <?php echo $performer->getId() === $form->getField('performers')['value'] ? 'selected' : ''; ?>>
                    <?php echo $performer->getName(); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label>Data wydania</label>
        <input type="date" title="dataWydania" name="release" placeholder="rrrr-mm-dd"
               value="<?php echo $form->getField('release')['value']; ?>">
    </div>

    <div class="form-group">
        <label>Ranking</label>
        <input type="text" title="ranking" name="ranking"
               value="<?php echo $form->getField('ranking')['value']; ?>">
    </div>

    <div class="form-group">
        <label>Cena</label>
        <input type="text" title="price" name="price"
               value="<?php echo $form->getField('price')['value']; ?>">
    </div>

    <div class="form-group">
        <label>Lista utworów</label>

        <?php for ($i = 0; $i < 13; $i++): ?>
            <div class="track">
                <input type="text" title="track_<?php echo $i; ?>"
                       name="track_<?php echo $i; ?>" placeholder="<?php echo ($i + 1); ?>. Tytuł utworu"
                       value="<?php echo $form->getField('track_' . $i)['value']; ?>">
                <input type="text" title="track_length_<?php echo $i; ?>"
                       name="track_length_<?php echo $i; ?>" placeholder="00:00:00"
                       value="<?php echo $form->getField('track_length_' . $i)['value']; ?>">
            </div>
        <?php endfor; ?>
    </div>

    <div class="form-group">
        <input type="submit" value="Dodaj płyte">
    </div>

    <a class="go-back" href="<?php echo $baseUrl; ?>">← Wróć</a>
</form>

<?php require_once("$basePath/footer.php"); ?>
