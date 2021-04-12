<?php


/**
 * Main controller
*/
class Controller
{

    /**
     * Load models
     *
     * @param string $model
     * @return mixed
     */
    public function loadModels($model)
    {
        $modelPath = '../app/models/' . $model . '.php';

        // Require model file
        require_once $modelPath;

        // Instantiate model
        return new $model();
    }


    /**
     * Load Views
     *
     * @param string $view
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
