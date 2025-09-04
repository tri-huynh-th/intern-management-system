<?php

class Controller
{
    public function redirect($path)
    {
        header('Location: ' . BASE_URL . $path);
        exit();
    }
    
    public function model($model)
    {
        require_once '../app/models/' . $model . '.php';
        return new $model();
    }

    public function view($view, $data = [])
    {
        require_once APPROOT . '/views/' . $view . '.php';
    }

    
}