<?php

namespace App\Core;

class Controller
{
    protected function view($view, $data = [])
    {
        extract($data);
        
        $view = str_replace('.', '/', $view);
        $viewPath = "../app/views/{$view}.php";
        
        if (file_exists($viewPath)) {
            require $viewPath;
        } else {
            throw new \Exception("View {$view} not found");
        }
    }

    protected function redirectWithError($path, $message)
    {
        $_SESSION['errors'] = [$message];
        header("Location: {$path}");
        exit();
    }

    protected function redirectWithSuccess($path, $message)
    {
        $_SESSION['success'] = $message;
        header("Location: {$path}");
        exit();
    }
}
