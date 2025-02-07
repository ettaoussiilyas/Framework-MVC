<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Article;
use App\Core\Auth;
use App\Core\Session;
use App\Core\Security;

class AdminController extends Controller
{
    protected Auth $auth;
    protected Session $session;
    protected Security $security;

    public function __construct()
    {
        $this->session = new Session();
        $this->security = new Security();
        $this->auth = new Auth($this->session, $this->security);
        
        // Check if user is admin
        if (!$this->auth->check() || $this->auth->user()->role !== 'admin') {
            header('Location: /login');
            exit();
        }
    }

    public function dashboard()
    {
        return $this->view('admin/dashboard');
    }

    public function articles()
    {
        $articles = Article::all();
        return $this->view('admin/articles', [
            'articles' => $articles,
            'user' => $this->auth->user()
        ]);
    }

    public function deleteArticle()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /admin/articles');
            exit();
        }

        $articleId = $_POST['article_id'] ?? null;

        if (!$articleId) {
            $_SESSION['error'] = 'Article ID is required';
            header('Location: /admin/articles');
            exit();
        }

        try {
            Article::deleteArticle($articleId);
            $_SESSION['success'] = 'Article deleted successfully';
        } catch (\Exception $e) {
            $_SESSION['error'] = 'Error deleting article';
        }

        header('Location: /admin/articles');
        exit();
    }
} 