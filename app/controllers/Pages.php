<?php


class Pages
{
    public function __construct()
    {
        echo 'Pages loaded';
        echo '<br>';
    }

    public function index()
    {
        echo 'This is index page';
    }

    public function about($id)
    {
        echo 'This is about';
        echo '<br>';
        echo $id;
    }
}
