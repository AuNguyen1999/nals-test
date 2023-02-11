<?php

require_once 'controller/WorkController.php';

$controller = new WorkController();

$action = $_GET['action'] ?? 'list';
$workId = $_GET['work_id'] ?? NULL;

switch ($action) {
  case 'add':
    $controller->add();
    break;
  case 'store':
    $controller->store();
    break;
  case 'edit':
    $controller->edit($workId);
    break;
  case 'update':
    $controller->update($workId);
    break;
  case 'delete':
    $controller->delete($workId);
    break;
  default:
    $controller->list();
    break;
}