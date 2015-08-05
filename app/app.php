<?php
  require_once __DIR__."/../vendor/autoload.php";
  require_once __DIR__."/../src/Task.php";

  $app = new Silex\Application();

  $app->get("/", function() {
    $test_task = new Task("Learn PHP.");
    $another_test_task = new Task("Learn Drupal.");
    $third_task = new Task("Visit France.");

    $list_of_tasks = array($test_task, $another_test_task, $third_task);
    $output = "";

    foreach($list_of_tasks as $task) {
      $output = $output . "<p>" . $task->getDescription() . "</p>";
    }
      return $output;
  });

  return $app;
 ?>
