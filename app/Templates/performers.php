<?php require_once("$basePath/header.php"); ?>

<h2>Wykonwacy</h2>

<div class="record" align="center">
    <a href="<?php echo $baseUrl; ?>/performer/add">Dodaj nowego wykonawcę</a>

    <table border-style="dotted" border="5px" bgcolor="#EEFFEE">
    <?php foreach ($performers as $performer): ?>
        <tr>
            <td><?php echo $performer->getName(); ?></td>
            <td>
                <a class="edit" href="<?php echo "$baseUrl/performer/edit/" . $performer->getId(); ?>">
                    Edit
                </a>
            </td>
            <td>
                <a class="delete" href="<?php echo "$baseUrl/performer/delete/" . $performer->getId();?>">
                    Delete
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
    </table>
</div>

<?php require_once("$basePath/footer.php"); ?>
