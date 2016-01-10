<?php require_once("$basePath/header.php"); ?>

<link rel="stylesheet" href="<?php echo $baseUrl; ?>/style/performer.css">

<h2 id="performers-title">Wykonawcy</h2>

<?php foreach ($performers as $performer): ?>
    <div id="<?php echo $performer->getId(); ?>" class="performer">
        <p class="name"><?php echo $performer->getName(); ?></p>
        <p class="type"><?php echo $performer->getType(); ?></p>
        <p class="members"><?php echo $performer->getMembers(); ?></p>


        <div class="options">
            <a class="edit" href="<?php echo "$baseUrl/performer/edit/" . $performer->getId(); ?>">
                Edit
            </a>
            <a class="delete" href="<?php echo "$baseUrl/performer/delete/" . $performer->getId();?>">
                Delete
            </a>
        </div>
    </div>
<?php endforeach; ?>

<a id="add-new-performer" href="<?php echo $baseUrl; ?>/performer/add">Dodaj nowego wykonawcę</a>

<?php require_once("$basePath/footer.php"); ?>
