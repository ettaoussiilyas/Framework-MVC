<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Auth;
use App\Core\Session;
use App\Core\Security;
use App\Models\Article;

class UserController extends Controller
{
    protected Auth $auth;
    protected Session $session;
    protected Security $security;

    public function __construct()
    {
        $this->session = new Session();
        $this->security = new Security();
        $this->auth = new Auth($this->session, $this->security);
        
        // Check authentication
        if (!$this->auth->check() || $this->auth->user()->email === 'admin@gmail.com') {
            header('Location: /login');
            exit();
        }
    }

    public function index()
    {
        $articles = Article::all();
        return $this->view('user/index', [
            'articles' => $articles,
            'user' => $this->auth->user()
        ]);
    }

    public function articles()
    {
        $articles = Article::all();
        return $this->view('user/articles', [
            'articles' => $articles,
            'user' => $this->auth->user()
        ]);
    }

    public function create()
    {
        return $this->view('user/articles/create');
    }

    public function store()
    {
        // Handle article creation
        $title = $_POST['title'] ?? '';
        $content = $_POST['content'] ?? '';

        if (empty($title) || empty($content)) {
            $this->session->flash('error', 'All fields are required');
            header('Location: /user/articles/create');
            exit();
        }

        Article::create([
            'title' => $title,
            'content' => $content,
            'user_id' => $this->auth->user()->id
        ]);

        $this->session->flash('success', 'Article created successfully');
        header('Location: /user/articles');
        exit();
    }
} 