<?php

use PHPUnit\Framework\TestCase;

require_once 'model/Work.php';

class WorkTest extends TestCase {

  public function testConstructor() {
    $work = new Work(1, 'Test Work', '2022-01-01 06:00:00', '2022-12-31 08:00:00', PLANNING);
    $this->assertInstanceOf(Work::class, $work);
    $this->assertEquals(1, $work->getWorkId());
    $this->assertEquals('Test Work', $work->getWorkName());
    $this->assertEquals('2022-01-01 06:00:00', $work->getStartingDate());
    $this->assertEquals('2022-12-31 08:00:00', $work->getEndingDate());
    $this->assertEquals(PLANNING, $work->getStatus());
  }

  public function testCanSaveAndRetrieveWork() {
    $work = new Work();
    $work->setWorkName('Test Work');
    $work->setStartingDate('2022-01-01 06:00:00');
    $work->setEndingDate('2022-12-31 08:00:00');
    $work->setStatus(PLANNING);
    $workId = $work->save();
    $this->assertNotNull($workId);
    $savedWork = Work::find($workId);
    $this->assertNotNull($savedWork);
    $this->assertEquals('Test Work', $savedWork->getWorkName());
    $this->assertEquals('2022-01-01 06:00:00', $savedWork->getStartingDate());
    $this->assertEquals('2022-12-31 08:00:00', $savedWork->getEndingDate());
    $this->assertEquals(PLANNING, $savedWork->getStatus());
    $this->assertEquals('Planning', $savedWork->getStatusDisplay());
  }

  public function testCanUpdateWork() {
    $work = new Work();
    $work->setWorkName('Test Work');
    $work->setStartingDate('2022-01-01 06:00:00');
    $work->setEndingDate('2022-12-31 08:00:00');
    $work->setStatus(PLANNING);
    $workId = $work->save();
    $this->assertNotNull($workId);
    $savedWork = Work::find($workId);
    $savedWork->setWorkName('Test Work Update');
    $savedWork->setStatus(DOING);
    $savedWork->save();
    $updateWork = Work::find($workId);
    $this->assertEquals('Test Work Update', $updateWork->getWorkName());
    $this->assertEquals('2022-01-01 06:00:00', $updateWork->getStartingDate());
    $this->assertEquals('2022-12-31 08:00:00', $updateWork->getEndingDate());
    $this->assertEquals(DOING, $updateWork->getStatus());
  }

  public function testCanDeleteWork() {
    $work = Work::find(38);
    $this->assertNotNull($work);
    Work::delete(38);
    $work = Work::find(38);
    $this->assertNull($work);
  }

}