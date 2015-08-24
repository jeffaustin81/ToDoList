<?php
    class Task
    {
        private $description;
        private $category_id;
        private $id;
        private $user_date;

        function __construct($description, $user_date, $id = null, $category_id)
        {
            $this->description = $description;
            $this->user_date = $user_date;
            $this->id = $id;
            $this->category_id = $category_id;
        }

        function setDescription($new_description)
        {
            $this->description = (string) $new_description;
        }

        function getDescription()
        {
            return $this->description;
        }

        function getDate()
        {
            return $this->user_date;
        }

        function setDate($new_date)
        {
            $this->user_date = (string) $new_date;
        }

        function getId()
        {
            return $this->id;
        }

        function getCategoryId()
        {
            return $this->category_id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO tasks (description, user_date, category_id) VALUES ('{$this->getDescription()}', '{$this->getDate()}', {$this->getCategoryId()})");
            
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_tasks = $GLOBALS['DB']->query("SELECT * FROM tasks ORDER BY user_date");
            $tasks = array();
            foreach($returned_tasks as $task) {
                $description = $task['description'];
                $user_date = $task['user_date'];
                $id = $task['id'];
                $category_id = $task['category_id'];
                $new_task = new Task($description, $user_date, $id, $category_id);
                array_push($tasks, $new_task);
            }
            return $tasks;
        }

        static function deleteAll()
        {
          $GLOBALS['DB']->exec("DELETE FROM tasks;");
        }

        static function find($search_id)
        {
            $found_task = null;
            $tasks = Task::getAll();
            foreach($tasks as $task) {
                $task_id = $task->getId();
                if ($task_id == $search_id) {
                  $found_task = $task;
                }
            }
            return $found_task;
        }
    }
?>
