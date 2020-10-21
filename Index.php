
<?php
include 'Solution.php';

try {
    $solution = new Solution();
    $solution->run();
} catch (Exception $e) {
    echo $e->getMessage();
}