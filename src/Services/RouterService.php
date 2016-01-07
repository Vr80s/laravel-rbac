<?php
namespace Vr80s\LaravelRbac\Services;

use Illuminate\Routing\Router;

/**
 * get route info service
 * Class RouterService
 * @package Vr80s\LaravelRbac\Services
 */
class RouterService {

    protected $route;

    public function __construct(Router $route){
        $this->route = $route;
    }

    public function getAll(){
        $routeList = array();
        $routes = $this->route->getRoutes()->getRoutes();

        foreach ($routes as $route) {
            $uri = $route->getUri();
            $action = $route->getAction();
            $method = $this->getMethod($route);
            $id = $this->getRouteHashId($route);

            if(!$action['uses'] instanceof \Closure){
                $arr = ['id'=>$id,
                    'uri'=>$uri,
                    'method'=>$method,
                    'action'=>$action['uses'],
                    'status'=>'VALID'];
            }else{
                $dump = closure_dump($action['uses']);
                $func = $dump['file'].'['.$dump['line'].']';
                $arr = ['id'=>$id,
                    'uri'=>$uri,
                    'method'=>$method,
                    'action'=>$func,
                    'status'=>'VALID'];
            }

            array_push($routeList, $arr);
        }

        return $routeList;
    }

    public function getAllByMiddleware($mw){
        $routeList = array();
        $routes = $this->route->getRoutes()->getRoutes();

        foreach ($routes as $route) {
            $uri = $route->getUri();
            $action = $route->getAction();
            $method = $this->getMethod($route);
            $id = $this->getRouteHashId($route);

            if(in_array($mw, $action)){
                if(!$action['uses'] instanceof \Closure){
                    $arr = ['id'=>$id,
                        'uri'=>$uri,
                        'method'=>$method,
                        'action'=>$action['uses'],
                        'status'=>'VALID'];
                }else{
                    $dump = closure_dump($action['uses']);
                    $func = $dump['file'].'['.$dump['line'].']';
                    $arr = ['id'=>$id,
                        'uri'=>$uri,
                        'method'=>$method,
                        'action'=>$func,
                        'status'=>'VALID'];
                }

                array_push($routeList, $arr);
            }
        }

        return $routeList;
    }

    protected function getMethod($route){
        $method = null;
        $methods = $route->getMethods();

        switch($methods){
            case in_array('GET',$methods,false):
                $method = 'GET';
                break;
            case in_array('POST',$methods,false):
                $method = 'POST';
                break;
            case in_array('PUT',$methods,false):
                $method = 'PUT';
                break;
            case in_array('DELETE',$methods,false):
                $method = 'DELETE';
                break;
        }

        return $method;
    }

    public function getRouteHashId($route){
        $uri = $route->getUri();
        $method = $this->getMethod($route);
        return md5($method.'|'.$uri);
    }

}
