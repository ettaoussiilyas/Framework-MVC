<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Article;
use App\Core\Auth;
use App\Core\Session;
use App\Core\Security;

class ArticleController extends Controller
{
    protected Auth $auth;
    protected Session $session;
    protected Security $security;

    public function __construct()
    {
        // Initialize dependencies
        $this->session = new Session();
        $this->security = new Security();
        $this->auth = new Auth($this->session, $this->security);
        
        // Check authentication
        if (!$this->auth->check()) {
            header('Location: /login');
            exit();
        }
    }

    public function index()
    {
        $user = $this->auth->user();
        $articles = Article::all();
        
        // Return view based on user role
        if ($user->email === 'admin@gmail.com') {
            return $this->view('admin/dashboard', [
                'articles' => $articles,
                'user' => $user
            ]);
        } else {
            return $this->view('user/index', [
                'articles' => $articles,
                'user' => $user
            ]);
        }
    }

    public function create()
    {
        return $this->view('articles/create');
    }

    public function store()
    {
        // Validation
        if (empty($_POST['title']) || empty($_POST['content'])) {
            $_SESSION['errors'] = ["All fields are required"];
            header('Location: /articles/create');
            exit;
        }

        // Create article
        Article::create([
            'title' => $_POST['title'],
            'content' => $_POST['content'],
            'user_id' => $_SESSION['user']['id']
        ]);

        $_SESSION['success'] = "Article created successfully!";
        header('Location: /user/index');
        exit;
    }

    public function show($id)
    {
        $article = Article::find($id);
        return $this->view('articles/show', ['article' => $article]);
    }

    public function destroy($id){
        Article::deleteArticle($id);
        return redirectWithSuccess('/articles', 'Article deleted successfully');
    }

    public function edit($id){
        $article = Article::find($id);
        return $this->view('articles/edit', ['article' => $article]);
    }

    public function update($id){
        $article = Article::find($id);
        $article->update([
            'title' => $_POST['title'],
            'content' => $_POST['content']
        ]);
        return redirectWithSuccess('/articles', 'Article updated successfully');
    }
} 