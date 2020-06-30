<?php
class Post{
    public $comment;
    public $username;
    public $time;

    /**
     * Store the comment
     */
    public function store(){
        $ds = DIRECTORY_SEPARATOR;
        try{
            $p = [
                'comment' => $this->comment,
                'username' => $this->username,
                'time' => $this->time
            ];
    
            $f = fopen($this->getDirectory($this->time).$ds.$this->time.'.json','w+');
            fwrite($f,json_encode($p));
            fclose($f);
            $_SESSION['success'] = "Comment published!";
            header("Location: ". Request::generateUrl('post','list'));
            exit;
        }catch(Exception $e){
            $_SESSION['error'] = "An error ocurred! please try later ". $e->getMessage();
            header("Location: ". Request::generateUrl('post','list'));
            exit;
        }
    }

    /**
     * Get all posts
     */
    public function getPosts($comment,$date){
        $ds = DIRECTORY_SEPARATOR;
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator(dirname(__DIR__).$ds."posts"), 
        RecursiveIteratorIterator::SELF_FIRST);
        $posts = [];
        $searchByDate = false;
        $dateArray = [];
        if($date != null){
            $period = new DatePeriod(
                $date,
                new DateInterval('P1D'),
                new DateTime()
            );
            $searchByDate = true;
            foreach ($period as $key => $value) {
                array_push($dateArray,$value->format('Y-m-d'));   
            }
        }
        foreach($iterator as $file) {
            if($file->isFile()){
                $path = $file->getRealpath();
                $post = json_decode(file_get_contents($path));
                $post->time = date('Y-m-d',$post->time);
                if(trim($comment) == "")
                    array_push($posts,$post);
                else{
                    if(strpos($post->comment,$comment) !== false){
                        array_push($posts,$post);
                    }
                }
            }
        }
        if($searchByDate){
            foreach($posts as $key => $post){
                if(!in_array($post->time,$dateArray))
                    unset($posts[$key]);
            }
        }
        return array_reverse($posts);
    }

    /**
     * Folder structure to store the posts files
     * The post will be stored in posts/{Current year}/{Current month}
     * 
     * @param int time
     * 
     * @param String path
     */
    private function getDirectory($time){
        $ds = DIRECTORY_SEPARATOR;
        try{
            $date = new DateTime(strtotime($time));
            $path = dirname(__DIR__).$ds."posts".$ds.$date->format('Y');
            
            if(!file_exists($path) && !is_dir($path))
                mkdir($path . $ds.$date->format('Y'),755);

            $path .= $ds.$date->format('m');
            if(!file_exists($path) && !is_dir($path))
                mkdir($path,755);
            
            $path .= $ds.$date->format('d');
            if(!file_exists($path) && !is_dir($path))
                mkdir($path);

            return $path;
        }catch(Exception $e){
            return $e->getMessage();
        }
    }
}