<?php

class PostController{
    /**
     * Show post list page
     * 
     * @return void
     */
    public function list(){
        if(!isset($_SESSION['user'])){
            header("Location: ". Request::generateUrl('auth','login'));
            exit;
        }

        require_once 'models/post.php';
        $req = Request::postRequest();
        $searchError = false;
        if(isset($req['date']) && trim($req['date']) != ""){
            $now = new DateTime();
            $req['date'] = new DateTime($req['date']);
            if ($req['date']->format('Y-m-d') > $now->format('Y-m-d')) {
                $req['date'] = null;
                $_SESSION['error'] = "Date must be lower than today";
            }
        }
        $post = new Post();
        $posts = $post->getPosts($req['comment'],$req['date']);

        require_once 'views/posts/list.php';
    }
    
    /**
     * Save new comment
     */
    public function create(){
        if(!isset($_SESSION['user'])){
            header("Location: ". Request::generateUrl('post','list'));
            exit;
        }
        require_once 'models/post.php';

        if(trim($comment) == ""){
            $_SESSION['formError']['comment'] = "Comment must not be empty";
            header("Location: ". Request::generateUrl('post','list'));
            exit();
        }else{
            $req = Request::postRequest();
            $post = new Post();
            $post->comment = $req['comment'];
            $post->username = $_SESSION['user'][1];
            $post->time = time();
    
            $post->store();
        }

        require_once 'views/posts/list.php';
    }
}
