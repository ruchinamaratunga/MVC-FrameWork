<?php

class Router {

    /**
     * take an array as input (url exploded by "/")
     * seperate the controller
     * seperate the action
     * everything left will be parameters, those will be our actions
     * enstatiate a relevant object(Home ,Tools....etc )(eg: if $controller = User then $dispatch will be 
     * a User Object , User has to be a child class of a Controller class)
     * call_user_func_array() function will execute the action function of the dispatch object ,$queryParams 
     * are the parameters passed into the action function (in Tools either indexAction,firstAction,secondAciton,thirdAction)
     * 
     */

    public static function route($url) {

        //controller
        $controller = (isset($url[0]) && $url[0] != '') ? ucwords($url[0]) : DEFAULT_CONTROLLER;
        $controller_name = $controller;
        array_shift($url);           // remove the first element
        // echo $controller;
        //action
        $action = (isset($url[0]) && $url[0] != '') ? $url[0] . 'Action' : 'indexAction';
        $action_name = $action;
        array_shift($url);          // remove the first element
        // echo $action;
        //params
        $queryParams = $url;      

        $dispatch = new $controller($controller_name, $action);      // relavant controller class will be created
        

        if(method_exists($controller,$action)) {
            call_user_func_array([$dispatch,$action],$queryParams);                    // run the controller action function
        }else {
            die('That method does not exist in the controller \"'. $controller_name . '\"');
        }

    }

    public static function redirect($location) {
        if(!headers_sent()) {
            header('Location: '.PROOT.$location);
            exit();
        } else {
            echo "hi";
        }
    }
}