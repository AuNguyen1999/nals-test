<?php

require_once 'model/Work.php';

class WorkController {

  public function list() {
    $works = Work::all();
    include 'view/WorkListView.php';
  }

  public function add() {
    include 'view/WorkFormView.php';
  }

  public function store() {
    $work = new Work();
    $work->setWorkName($_POST['work_name']);
    $work->setStartingDate($_POST['starting_date']);
    $work->setEndingDate($_POST['ending_date']);
    $work->setStatus($_POST['status']);
    $work->save();
    header('Location: index.php');
  }

  public function edit($workId) {
    $work = Work::find($workId);
    include 'view/WorkFormView.php';
  }

  public function update($workId) {
    $work = Work::find($workId);
    $work->setWorkName($_POST['work_name']);
    $work->setStartingDate($_POST['starting_date']);
    $work->setEndingDate($_POST['ending_date']);
    $work->setStatus($_POST['status']);
    $work->save();
    header('Location: index.php');
  }

  public function delete($workId) {
    Work::delete($workId);
    header('Location: index.php');
  }

}