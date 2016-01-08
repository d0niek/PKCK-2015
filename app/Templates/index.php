<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $header->getDescription(); ?></title>
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>/style/style.css">
</head>
<body>
    <header>
        <h2><?php echo $header->getDescription(); ?></h2>

        <?php foreach ($header->getAuthors() as $author): ?>
        <div>
            <p class="name"><?php echo $author->getName(), ' ', $author->getSurname(); ?></p>
            <p class="index"><?php echo $author->getIndex(); ?></p>
            <p class="course"><?php echo $author->getCourse(); ?></p>
        </div>
        <?php endforeach; ?>
    </header>

    <div class="container">
        <?php foreach ($records as $record): ?>
        <div id="<?php echo $record->getId(); ?>" class="record">
            <div class="options">
                <a href="<?php echo "$baseUrl/edit-record/" . $record->getId(); ?>">Edit</a>
                <a href="<?php echo "$baseUrl/delete-record/" . $record->getId(); ?>">Delete</a>
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

        <a href="<?php echo $baseUrl; ?>/add-record">Dodaj nową płytę</a>
    </div>
</body>
</html>
