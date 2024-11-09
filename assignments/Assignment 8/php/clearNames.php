<?php
require_once '../classes/Pdo_methods.php';
$pdo = new PdoMethods();
try{
$sql = "TRUNCATE TABLE names";
$pdo->otherNotBinded($sql);
echo json_encode([
    'masterstatus' => 'success',
    'msg' => 'All names were deleted'
]);
} catch (PDOException $e) {
echo json_encode([
    'masterstatus' => 'error',
    'msg' => 'Failed to clear names: ' . $e->getMessage()
]);
}
?>