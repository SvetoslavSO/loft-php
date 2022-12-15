<?php

namespace Core;

use App\Controller\User;
use App\Controller\Blog;
use App\Model\User as UserModel;
use App\Model\Blog as BlogModel;

class Application
{
    private $route;
    private $controller;
    private $actionName;

    public function __construct()
    {
        $this->route = new Route();
    }

    public function run()
    {
        try {
          session_start();
          $this->addRoutes();
          $this->initController();
          $this->initAction();

          $view = new View();
          $this->controller->setView($view);
          $this->initUser();
          $this->initBlog();
  
          $this->controller->{$this->actionName}();
        } catch (RedirectException $e) {
            header('Location:' . $e->getUrl());
            die;
        } catch (RouteException $e) {
            header('HTTP/1.0 404 Not Found');
            echo $e->getMessage();
        }
    }

    private function addRoutes()
    {
      $this->route->addRoute('/user/login', \App\Controller\User::class, 'login');
      $this->route->addRoute('/user/register', \App\Controller\User::class, 'register');
      $this->route->addRoute('/blog', \App\Controller\Blog::class, 'index');
      $this->route->addRoute('/blog/index', \App\Controller\Blog::class, 'index');
    }

    private function initUser()
    {
        $id = $_SESSION['id'] ?? null;
        if ($id) {
            $user = UserModel::getById($id);
            if ($user) {
              $this->controller->setUser($user);
            }
        }
    }

    private function initController()
    {
      $controllerName = $this->route->getControllerName();

      if (!class_exists($controllerName)) {
          throw new RouteException('Cant find controller' . $controllerName);
      }

      $this->controller = new $controllerName;
    }

    private function initAction()
    {
      $actionName = $this->route->getActionName();

      if (!method_exists($this->controller, $actionName)) {
          throw new RouteException('Action ' . $actionName . ' not found in ' . get_class($this->controller));
      }
      $this->actionName = $actionName;
    }

    private function initBlog()
    {   
        $blog = new BlogModel();
        $history = $blog->getHistory();
        $this->controller->setBlog($history);
    }
}