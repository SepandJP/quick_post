<?php


/**
 * Main controller
*/
class Controller
{

    /**
     * Load models
     *
     * @param $model
     * @return mixed
     */
    public function loadModels($model)
    {
        // Require model file
        require_once '../app/models/' . $model . '.php';

        // Instantiate model
        return new $model();
    }


    /**
     * Load Views
     *
     * @param $view
     * @param array $data
     */
    public function loadView($view, $data = [])
    {
        $viewPath = '../app/views/' . $view . '.php';

        // Check for view file
        if (file_exists($viewPath))
        {
            require_once $viewPath;
        }

        else
        {
            // View does not exist
            die('View does not exist');
        }
    }
}
