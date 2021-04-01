<?php

class Core
{
    /**
     * Save URL
    */
    protected $url;

    /**
     * First part of url
     * Controller's name
     *
     * For example: localhost/quick_post/{Pages}
     *
     * If URL haven't any parameter, then redirected to Pages controller
     * */
    protected $currentController = 'Pages';

    /**
     * Second part of url
     * Method's name
     *
     * For example: localhost/quick_post/pages/{about}
     *
     * */
    protected $currentMethod = 'index';

    /**
     * For save URL and call method in controller with params
     * */
    protected $params = [];

    // End of properties
    // Start methods

    public function __construct()
    {
        $this->url = $this->getUrl();

        /*
         * Check for first part of url
         * Controller's name
         * */
        $this->controllerUrl();

        /*
         * Check for second part of url
         * Method's name
         * */
        $this->methodUrl();

        /*
        * Get URL params
        * and
        * Call the method of controller
        * */
        $this->getAndUseUrlParams();
    }

    /**
     * @return false|string[]
     */
    public function getUrl()
    {

        if (!isset($_GET['url']))
        {
            $_GET['url'] = '/';
        }

        elseif (isset($_GET['url']));
        {
            $this->url = trim($_GET['url'], '/');
            $this->url = filter_var($this->url, FILTER_SANITIZE_URL);
            $this->url = explode('/', $this->url);
            return $this->url;
        }
    }

    /**
     * Check for first part of url
     */
    public function controllerUrl()
    {
        /**
         * Convert the first character to uppercase
         * Because the first character of the controller's name is uppercase
         */
        $upperUrl = ucwords($this->url[0]);

        // Look in controllers for first value
        if(file_exists('../app/controllers/' . $upperUrl . '.php'))
        {
            // If exists, set as controller
            $this->currentController = $upperUrl;

            // todo why?
            unset($upperUrl);
            unset($this->url[0]);
        }

        // Require and instantiate controller
        $this->useController();

        // Unset 0 Index
        unset($this->url[0]);
    }

    /**
     * Require the controller
     * and
     * Instantiate controller class
      */
    public function useController()
    {
        // Require the controller
        require_once('../app/controllers/' . $this->currentController . '.php');

        // Instantiate controller class
        $this->currentController = new $this->currentController;
    }

    /**
     * Check for second part of url
     */
    public function methodUrl()
    {
        if (isset($this->url[1]))
        {
            // Check to see if method exists in controller
            if (method_exists($this->currentController, $this->url[1]))
            {
                $this->currentMethod = $this->url[1];

                // Unset 1 index
                unset($this->url[1]);
            }
        }
    }

    /**
     * Get URL params
     * and
     * Call the method of controller
     **/
    public function getAndUseUrlParams()
    {
        // Get params
        $this->params = $this->url ? array_values($this->url) : [null];

        // Call a callback with array of params
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }
}
