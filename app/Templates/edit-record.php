<?php require_once("$basePath/header.php"); ?>

<link rel="stylesheet" href="<?php echo $baseUrl; ?>/style/record.css">
<link rel="stylesheet" href="<?php echo $baseUrl; ?>/style/form.css">

<h2 id="edit-record-title">Edit new record</h2>

<?php if (isset($_SESSION['validMessage'])): ?>
    <p class="valid-message"><?php echo $_SESSION['validMessage']; ?></p>
    <?php unset($_SESSION['validMessage']); ?>
<?php endif; ?>

<form id="edit-record-form" action="<?php echo "$baseUrl/edit-record/" . $record->getId(); ?>" method="post">
    <div class="form-group">
        <label>Tytuł</label>
        <input type="text" title="tytuł" name="title"
            value="<?php echo $form->getField('title')['value'] ?
                $form->getField('title')['value'] :
                $record->getTitle(); ?>">
    </div>

    <div class="form-group">
        <label>Wykonawca</label>
        <select title="Wykonawcy" name="performers">
            <?php foreach ($performers as $performer): ?>
                <?php $performerId = $form->getField('performers')['value'] ?
                    $form->getField('performers')['value'] :
                    $record->getPerformer()->getId(); ?>
                <option value="<?php echo $performer->getId(); ?>"
                    <?php echo $performer->getId() === $performerId ? 'selected' : ''; ?>>
                    <?php echo $performer->getName(); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label>Data wydania</label>
        <input type="date" title="dataWydania" name="release" placeholder="RRRR-MM-DD"
            value="<?php echo $form->getField('release')['value'] ?
                $form->getField('release')['value'] :
                $record->getRelease()->format('Y-m-d'); ?>">
    </div>

    <div class="form-group">
        <label>Ranking</label>
        <input type="text" title="ranking" name="ranking"
            value="<?php echo $form->getField('ranking')['value'] ?
                $form->getField('ranking')['value'] :
                $record->getRanking(); ?>">
    </div>

    <div class="form-group">
        <label>Cena</label>
        <input type="text" title="price" name="price"
            value="<?php echo $form->getField('price')['value'] ?
                $form->getField('price')['value'] :
                $record->getPrice(); ?>">
    </div>

    <div class="form-group">
        <label>Lista utworów</label>

        <?php for ($i = 0; $i < 13; $i++): ?>
            <div class="track">
                <input type="text" title="track_<?php echo $i; ?>"
                    name="track_<?php echo $i; ?>" placeholder="<?php echo($i + 1); ?>. Tytuł utworu"
                    value="<?php echo $form->getField('track_' . $i)['value'] ?
                        $form->getField('track_' . $i)['value'] :
                        isset($record->getTracks()[$i]) ?
                            $record->getTracks()[$i]->getTitle() :
                            ''; ?>">
                <input type="text" title="track_length_<?php echo $i; ?>"
                    name="track_length_<?php echo $i; ?>" placeholder="00:00:00"
                    value="<?php echo $form->getField('track_length_' . $i)['value'] ?
                        $form->getField('track_length_' . $i)['value'] :
                        isset($record->getTracks()[$i]) ?
                            $record->getTracks()[$i]->getLength()->format('H:i:s') :
                            ''; ?>">
            </div>
        <?php endfor; ?>
    </div>

    <div class="form-group">
        <input type="submit" value="Edytuj płytę">
    </div>
</form>

<?php require_once("$basePath/footer.php"); ?>
