<?php

class Posts extends Controller
{

    /**
     * @var mixed
     *           For connecting to the Posts Model
     */
    private $postModel;

    /**
     * @var mixed
     *           Connecting to the Users Model
     *           For get data of the user and define permissions for edit and delete posts.
     */
    private $userModel;

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

        /*
         * Load User model
         * for ger data of the user
         * */
        $this->userModel = $this->loadModels('User');
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
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => $_SESSION['user_id'],
                'title_error' => '',
                'body_error' => ''
            ];


            // Validate data
            if (empty($data['title'])) {
                $data['title_error'] = 'Please enter title';
            }
            if (empty($data['body'])) {
                $data['body_error'] = 'Please enter body text';
            }

            // Make sure that no errors
            if (empty($data['title_error']) && empty($data['body_error'])) {
                /*
                 *  Validated
                 * then insert post to database
                 * and show successful message
                */
                if (!($this->postModel->addPost($data))) {
                    flashMessages('addPost', 'Sharing of the Post was Successful');
                    redirect('posts');
                } else {
                    die('Oh, Something went wrong...');
                }
            }
            else
            {
                $this->loadView('posts/add', $data);
            }
        }
        else
            {
            $data = [
                'title' => '',
                'body' => ''
            ];

            // Load add post page with error
            $this->loadView('posts/add', $data);
        }
    }

    /**
     * Get id of the post
     * and show data of that post.
     *
     * @param int $id
     *               Id of the post that we want to show data of it.
     */
    public function show($id)
    {
        // If the user types a post's id that doesn't exist.
        if (is_null($id))
        {
            redirect('posts');
        }

        // If the user types a post's id that doesn't exist in url.
        elseif (!($this->postModel->getPostById($id)))
        {
            redirect('posts');
        }
        else {


            $post = $this->postModel->getPostById($id);
            $user = $this->userModel->getUserById($post->user_id);

            $data = [
                'post' => $post,
                'user' => $user
            ];

            $this->loadView('posts/show', $data);
        }
    }

    public function edit()
    {

    }
}