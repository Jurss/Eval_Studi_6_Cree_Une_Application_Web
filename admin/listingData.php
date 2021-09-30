<?php
include "../inc/function.php";
logged_only();
$table = $_POST['table'];

require_once '../class/ListingData.php';

$listing = new ListingData();
$data = $listing->getData($table);

$dataCol = new ListingData();
$cols = $dataCol->getColumns($table);

include "../inc/header.php";
?>
<div class="back">
    <a href="admin.php" class="btn btn-success">Back</a>
</div>

<table class="table table-striped table-hover">
    <thead>
    <tr>
        <?php foreach ($cols as $col) { ?>
            <th> <?php echo $col['Field'] ?></th>
        <?php } ?>
    </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $dataOccurence) { ?>
        <tr>
            <?php foreach ($dataOccurence as $d) { ?>
                <td class="table-responsive">
                    <?php echo $d; ?>
                </td>
            <?php } ?>
        </tr>
        <?php } ?>
    </tbody>
</table>

<?php
include '../inc/footer.php';


