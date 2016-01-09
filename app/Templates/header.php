<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $header->getDescription(); ?></title>
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>/style/header.css">
</head>
<body>
<header>
    <h1>
        <a href="<?php echo $baseUrl; ?>">
            <?php echo $header->getDescription(); ?>
        </a>
    </h1>

    <?php foreach ($header->getAuthors() as $author): ?>
        <div>
            <p class="name"><?php echo $author->getName(), ' ', $author->getSurname(); ?></p>
            <p class="index"><?php echo $author->getIndex(); ?></p>
            <p class="course"><?php echo $author->getCourse(); ?></p>
        </div>
    <?php endforeach; ?>
</header>

<div id="container">
