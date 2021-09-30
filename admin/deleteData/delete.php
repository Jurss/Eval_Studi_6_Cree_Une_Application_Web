<?php
include "header.php";
include "../../inc/function.php";
require_once "../../class/ListingData.php";

$req = new ListingData();
$datas = $req->getData($_SESSION['tableDynamic']);
$cols = $req->getColumns($_SESSION['tableDynamic']);



?>

    <div class="back">
        <a href="../admin.php" class="btn btn-success">Back</a>
    </div>

    <h1> <?php echo $_SESSION['tableDynamic'] ?></h1>

    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <?php foreach ($cols as $col) { ?>
                <th id="fieldIn"> <?php echo $col['Field'] ?></th>
            <?php } ?>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($datas as $dataOccurence) { ?>
            <tr>

                <?php foreach ($dataOccurence as $key => $data) { ?>

                    <td class="table-responsive">
                        <a href="deleteFile.php?id=<?php echo $dataOccurence['id'] ?>&table=<?php echo $_SESSION['tableDynamic'] ?>">
                            <?php echo $data; ?>
                        </a>
                    </td>
                <?php } ?>
            </tr>
        <?php } ?>
        </tbody>
    </table>

<?php
include '../../inc/footer.php';