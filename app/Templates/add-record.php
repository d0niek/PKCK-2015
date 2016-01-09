<?php require_once("$basePath/header.php"); ?>

<link rel="stylesheet" href="<?php echo $baseUrl; ?>/style/add-record.css">
<link rel="stylesheet" href="<?php echo $baseUrl; ?>/style/form.css">

<h2 id="add-record-title">Add new record</h2>

<form id="add-record-form" action="<?php echo "$baseUrl/add-record"; ?>" method="post">
    <div class="form-group">
        <label>Tytuł</label>
        <input type="text" title="tytuł" name="title">
    </div>

    <div class="form-group">
        <label>Wykonawca</label>
        <select title="Wykonawcy" name="performers">
            <?php foreach ($performers as $performer): ?>
                <option value="<?php echo $performer->getId(); ?>">
                    <?php echo $performer->getName(); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label>Data wydania</label>
        <input type="date" title="dataWydania" name="release" placeholder="rrrr-mm-dd">
    </div>

    <div class="form-group">
        <label>Ranking</label>
        <input type="text" title="ranking" name="ranking">
    </div>

    <div class="form-group">
        <label>Cena</label>
        <input type="text" title="price" name="price">
    </div>

    <div class="form-group">
        <label>Lista utworów</label>

        <?php for ($i = 0; $i < 13; $i++): ?>
            <div class="track">
                <input type="text" title="tract_<?php echo $i; ?>"
                       name="track_<?php echo $i; ?>" placeholder="<?php echo ($i + 1); ?>. Tytuł utworu">
                <input type="text" title="tract_length_<?php echo $i; ?>"
                       name="track_length_<?php echo $i; ?>" placeholder="00:00:00">
            </div>
        <?php endfor; ?>
    </div>

    <div class="form-group">
        <input type="submit" value="Dodaj płyte">
    </div>
</form>

<?php require_once("$basePath/footer.php"); ?>
