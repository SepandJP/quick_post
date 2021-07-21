<?php


class Pages extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        /* 
         * If the user was logged in,
         * with click on home tab or site's logo
         * redirected to the posts page
        */
        if (isLoggedIn())
        {
            redirect('posts');
        }

        $data = [
            'title' => 'Welcome',
            'description' => 'Simple social network built on myMVC PHP framework'
        ];

        $this->loadView('pages/index', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'About Page',
            'description' => 'App to share posts with other users'
        ];

        $this->loadView('pages/about', $data);
    }
}
