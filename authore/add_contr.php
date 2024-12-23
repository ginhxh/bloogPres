<?php 
declare(strict_types=1);
function isinput_empty(string $title,string $content_txt,string $url_img){

    if(empty($title)||empty($content_txt)||empty($url_img)){
    
    return true;
    
    }
    else{
        return false;}
    
    }
function creat_post(object $pdo,string $title,string $content_txt, string $author_id,string $url_img){
        set_articls( $pdo, $title, $content_txt,  $author_id,$url_img);}


