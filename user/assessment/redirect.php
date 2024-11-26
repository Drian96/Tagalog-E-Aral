<?php
if (!isset($_POST['score'])) {
    header("Location: startA.php");
    exit();
}

$score = intval($_POST['score']);

if ($score <= 3) {
    header("Location: ../../user/easy/easyMain.php");
} elseif ($score <= 7) {
    header("Location: ../../average/averageMain.php");
} else {
    header("Location: ../../hard/hardMain.php");
}
exit();
