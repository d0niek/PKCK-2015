<?php require_once("$basePath/header.php"); ?>

<link rel="stylesheet" href="<?php echo $baseUrl; ?>/style/style.css">

<?php foreach ($records as $record): ?>
    <div id="<?php echo $record->getId(); ?>" class="record">
        <div class="options">
            <a class="edit" href="<?php echo "$baseUrl/edit-record/" . $record->getId(); ?>">Edit</a>
            <a class="delete" href="<?php echo "$baseUrl/delete-record/" . $record->getId(); ?>">Delete</a>
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
<?php endforeach; ?>

<a id="add-new-record" href="<?php echo $baseUrl; ?>/add-record">Dodaj nową płytę</a>

<?php require_once("$basePath/footer.php"); ?>
