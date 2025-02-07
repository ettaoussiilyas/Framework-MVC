<?php

namespace App\Core;

class View
{
    protected $view;
    protected $data;

    public function __construct($view, $data = [])
    {
        $this->view = $view;
        $this->data = $data;
    }

    public function render()
    {
        $viewPath = __DIR__ . '/../../app/views/' . str_replace('.', '/', $this->view) . '.php';
        
        if (!file_exists($viewPath)) {
            throw new \Exception("View {$this->view} not found");
        }

        extract($this->data);
        
        ob_start();
        include $viewPath;
        return ob_get_clean();
    }
} 