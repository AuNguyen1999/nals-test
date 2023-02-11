<?php

require_once("connection.php");

const PLANNING = 1;
const DOING = 2;
const COMPLETE = 3;

class Work {

  private $workId;

  private $workName;

  private $startingDate;

  private $endingDate;

  private $status;

  public function __construct($workId = NULL, $workName = NULL, $startingDate = NULL, $endingDate = NULL, $status = NULL) {
    $this->workId = $workId;
    $this->workName = $workName;
    $this->startingDate = $startingDate;
    $this->endingDate = $endingDate;
    $this->status = $status;
  }

  public function getWorkId(): int {
    return $this->workId;
  }

  public function getWorkName(): string {
    return $this->workName;
  }

  public function setWorkName(string $workName): void {
    $this->workName = $workName;
  }

  public function getStartingDate(): string {
    return $this->startingDate;
  }

  public function setStartingDate(string $startingDate): void {
    $this->startingDate = $startingDate;
  }

  public function getEndingDate(): string {
    return $this->endingDate;
  }

  public function setEndingDate(string $endingDate): void {
    $this->endingDate = $endingDate;
  }

  public function getStatus(): int {
    return $this->status;
  }

  public function setStatus(int $status): void {
    $this->status = $status;
  }

  public function getStatusDisplay(): string {
    switch ($this->status) {
      case PLANNING:
        return 'Planning';
      case DOING:
        return 'Doing';
      case COMPLETE:
        return 'Complete';
      default:
        return 'Undefined';
    }
  }

  public function save(): int {
    $db = Db::getInstance();
    $insert = false;
    if ($this->workId) {
      $stmt = $db->prepare("UPDATE works SET name=:name, starting_date=:starting_date, ending_date=:ending_date, status=:status WHERE id=:id");
      $stmt->bindValue(':id', $this->getWorkId(), PDO::PARAM_INT);
    }
    else {
      $insert = true;
      $stmt = $db->prepare("INSERT INTO works (name, starting_date, ending_date, status) VALUES (:name, :starting_date, :ending_date, :status)");
    }
    $stmt->bindValue(':name', $this->getWorkName(), PDO::PARAM_STR);
    $stmt->bindValue(':starting_date', $this->getStartingDate(), PDO::PARAM_STR);
    $stmt->bindValue(':ending_date', $this->getEndingDate(), PDO::PARAM_STR);
    $stmt->bindValue(':status', $this->getStatus(), PDO::PARAM_INT);
    $stmt->execute();
    if ($insert) {
      $this->workId = $db->lastInsertId();
    }
    return $this->workId;
  }

  public static function all(): array {
    $db = Db::getInstance();
    $req = $db->query('SELECT * FROM works');
    $works = [];
    foreach ($req->fetchAll() as $item) {
      $works[] = new Work($item['id'], $item['name'], $item['starting_date'], $item['ending_date'], $item['status']);
    }
    return $works;
  }

  public static function find($workId): ?Work {
    $db = Db::getInstance();
    $req = $db->prepare('SELECT * FROM works WHERE id = :id');
    $req->execute(['id' => $workId]);
    $item = $req->fetch();
    if (isset($item['id'])) {
      return new Work($item['id'], $item['name'], $item['starting_date'], $item['ending_date'], $item['status']);
    }
    return NULL;
  }

  public static function delete($workId): void {
    $db = Db::getInstance();
    $stmt = $db->prepare("DELETE FROM works WHERE id=:id");
    $stmt->bindValue(':id', $workId, PDO::PARAM_INT);
    $stmt->execute();
  }


}
