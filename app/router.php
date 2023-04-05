<?php

use App\Controllers\CallDetailsController;
use App\Controllers\CallLogController;

$callLogController = new CallLogController();
$callDetailsController = new CallDetailsController();

if ($_SERVER['REQUEST_URI'] === '/add-call-header') {
    $callLogController->createCallHeader();
} elseif ($_SERVER['REQUEST_URI'] === '/store-call-log' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $callLogController->storeCallHeader($_POST);
} elseif ($_SERVER['REQUEST_URI'] === '/update-call-header' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $callLogController->updateCallHeader($_POST);
} elseif ($_SERVER['REQUEST_URI'] === '/delete-call-header' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $callLogController->deleteCallHeader($_POST);
} elseif (str_contains($_SERVER['REQUEST_URI'], '/view-call-header')) {
    $id = $_GET['id'];
    $callLogController->viewCallHeader($id);
} elseif (str_contains($_SERVER['REQUEST_URI'], '/add-call-details')) {
    $id = $_GET['id'];
    $callDetailsController->create($id);
} elseif ($_SERVER['REQUEST_URI'] === '/store-call-details' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $callDetailsController->store($_POST);
} elseif (str_contains($_SERVER['REQUEST_URI'], '/delete-call-detail') && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_GET['id'];
    $callDetailsController->delete($id);
} elseif (str_contains($_SERVER['REQUEST_URI'], '/search-call-header') && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $callLogController->search($_POST);
} else {
    $callLogController->index();
}
