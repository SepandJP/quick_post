<?php

class Posts extends Controller
{

    /**
     * @var mixed
     *           For connecting to the Posts Model
     */
    private $postModel;

    /**
     * Posts constructor.
     *
     * If the users don't log in site, they redirect to the login page and do not have access to see and modify the posts.
     * // todo users without log in site, can see the posts, but do not have access to modify the posts.
     */
    public function __construct()
    {
        if (!isLoggedIn())
        {
            redirect('users/login');
        }

        $this->postModel = $this->loadModels('Post');
    }

    /**
     * Show all of the posts.
     */
    public function index()
    {
        // Get all of the posts
        $posts = $this->postModel->getAllPosts();

        $data = [
            'posts' => $posts
        ];

        $this->loadView('posts/index', $data);
    }

    /**
     * Write a post and share it.
     */
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => $_SESSION['user_id'],
                'title_error' => '',
                'body_error' => ''
            ];
        }

        else
        {
            $data = [
                'title' => '',
                'body' => ''
            ];
        }


        $this->loadView('posts/add', $data);
    }
}