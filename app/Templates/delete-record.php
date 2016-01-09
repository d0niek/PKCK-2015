<?php require_once("$basePath/header.php"); ?>

<link rel="stylesheet" href="<?php echo $baseUrl; ?>/style/style.css">
<link rel="stylesheet" href="<?php echo $baseUrl; ?>/style/form.css">
<link rel="stylesheet" href="<?php echo $baseUrl; ?>/style/delete-record.css">

<h2 id="delete-record-title">Delete record</h2>

<?php if (isset($_SESSION['validMessage'])): ?>
    <p class="valid-message"><?php echo $_SESSION['validMessage']; ?></p>
    <?php unset($_SESSION['validMessage']); ?>
<?php endif; ?>

<div id="<?php echo $record->getId(); ?>" class="record">
    <div class="options">
        <a class="edit" href="<?php echo "$baseUrl/edit-record/" . $record->getId(); ?>">Edit</a>
    </div>

    <h3><?php echo $record->getTitle(); ?></h3>
    <h4><?php echo $record->getPerformer()->getName(); ?></h4>

    <p class="ranking"><?php echo $record->getRanking(); ?></p>
    <p class="time"><?php echo $record->getTime()->format('H:i:s'); ?></p>
    <p class="price"><?php echo $record->getPrice(); ?></p>

    <ul class="tracks">
        <?php foreach ($record->getTracks() as $track): ?>
            <li class="<?php echo $track->getNumber(); ?>">
                <?php echo $track->getTitle(); ?>
                <em><?php echo $track->getLength()->format('H:i:s'); ?></em>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<form id="delete-record-form" action="<?php echo "$baseUrl/delete-record/" . $record->getId(); ?>" method="post">
    <input type="hidden" title="recordId" name="recordId" value="<?php echo $record->getId(); ?>">

    <input type="submit" value="Usuń płytę">
</form>

<?php require_once("$basePath/footer.php"); ?>
