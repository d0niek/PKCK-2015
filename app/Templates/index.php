<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $header->getDescription(); ?></title>
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
</body>
</html>
