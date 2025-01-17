<?php

class Ajax
{
    public function __construct()
    {
        // Hook to handle AJAX requests
        $this->handleAjax();
    }

    public function handleAjax()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
            $action = $_POST['action'];

            if (method_exists($this, $action)) {
                $this->$action();
            } else {
                echo json_encode(['error' => 'Invalid action.']);
            }
            exit;
        }
    }

    protected function respond($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}
