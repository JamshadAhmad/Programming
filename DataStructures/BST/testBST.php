<?php

require_once './BST.php';

$bst = new BST();

$bst->insert(5);
$bst->insert(9);
$bst->insert(4);
$bst->insert(7);
$bst->insert(11);
$bst->insert(1);
$bst->insert(97);
$bst->insert(38);
$bst->insert(6);
$bst->insert(12);

$expected = [1, 4, 5, 6, 7, 9, 11, 12, 38, 97];
if ($expected !== $bst->toArrayValues()) {
    echo 'toArrayValues() test failed' . PHP_EOL;
}

if (1 !==  $bst->min()->value) {
    echo 'min() test failed' . PHP_EOL;
}

if (97 !== $bst->max()->value) {
    echo 'max() test failed' . PHP_EOL;
}

if (!$bst->search(6) || !$bst->search(38) || $bst->search(9999)) {
    echo 'search() test failed' . PHP_EOL;
}

$bst->delete(9); //delete from BST
$bst->delete(1);
$bst->delete(7);

$expected = array_values(array_diff($expected, [9, 1, 7])); //delete from expected array

if ($expected !== $bst->toArrayValues()) {
    echo 'delete() test failed' . PHP_EOL;
}

if (!$bst->exists(6) || !$bst->exists(97) || $bst->exists(7)) {
    echo 'exists() test failed' . PHP_EOL;
}

if (!$bst->isValidBST($bst->root)) {
    echo 'isValidBST() test failed' . PHP_EOL;
}

echo 'End of file. All tests are run successfully.' . PHP_EOL;