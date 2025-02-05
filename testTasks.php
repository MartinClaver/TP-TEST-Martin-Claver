<?php

use Mclav\Tests\Tasks\TaskManager;

class testTasks extends \PHPUnit\Framework\TestCase
{
    function testAddTask() {
        $tasks = new TaskManager();
        $tasks->addTask("testTask");
        $this->assertEquals("testTask", $tasks->getTask(0));
    }
    function testRemoveTask() {
        $tasks = new TaskManager();
        $tasks->addTask("testTask");
        $tasks->addTask("testTask2");
        $tasks->removeTask(1);
        $this->assertEquals("testTask", $tasks->getTask(0));
    }
    function testGetTasks() {
        $tasks = new TaskManager();
        $tasks->addTask("testTask");
        $tasks->addTask("testTask2");
        $this->assertEquals(["testTask", "testTask2"], $tasks->getTasks());
    }
    function testGetTask() {
        $tasks = new TaskManager();
        $tasks->addTask("testTask");
        $tasks->addTask("testTask2");
        $this->assertEquals("testTask", $tasks->getTask(0));
    }
    function testRemoveInvalidIndexThrowsException() {
        $tasks = new TaskManager();
        $tasks->addTask("testTask");
        $this->expectException(OutOfBoundsException::class);
        $this->expectExceptionMessage("Index de tâche invalide: 1");
        $tasks->removeTask(1);
    }
    function testGetInvalidIndexThrowsException() {
        $tasks = new TaskManager();
        $tasks->addTask("testTask");
        $tasks->addTask("testTask2");
        $this->expectException(OutOfBoundsException::class);
        $this->expectExceptionMessage("Index de tâche invalide: 2");
        $this->assertEquals("testTask", $tasks->getTask(2));
    }
    function testTaskOrderAfterRemoval() {
        $tasks = new TaskManager();
        $tasks->addTask("testTask");
        $tasks->addTask("testTask2");
        $tasks->addTask("testTask3");
        $tasks->removeTask(0);
        $this->assertEquals("testTask2", $tasks->getTask(0));
    }
}