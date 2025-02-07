<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Auth;
use App\Core\Session;
use App\Core\Security;
use App\Models\Article;

class HomeController extends Controller
{
    protected Auth $auth;
    protected Session $session;
    protected Security $security;

    public function __construct()
    {
        $this->session = new Session();
        $this->security = new Security();
        $this->auth = new Auth($this->session, $this->security);
    }

    public function index()
    {
        // Simply return the home view
        return $this->view('home/index');
    }

    public function getArticles()
    {
        $articles = Article::findAll();
        return $this->view('home/articles', ['articles' => $articles]);
    }
}

