<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Comment;
use App\Entity\User;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Serializer;
USE Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
USE Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends AbstractController
{
    
    public function root(): Response
    {


        return new Response("root of app");
    }

    
    public function getComments(Request $request): Response
    {
        $repository = $this->getDoctrine()->getRepository(Comment::class);    
        
        $Posts = $repository->getPosts1($request->query->get("search")); 
        
        $prev=0;
        $b=0;
        $v=0;
        $items=array();
        $tems=array();
        
        for ($i=0;$i<count($Posts);$i++){
           $Posts[$i]["user"]["nameuser"]=$Posts[$i]["nameuser"];
           
           $Posts[$i]["comments"]=array();
           $v=0;
           foreach ($repository->getComments($Posts[$i]["postid"]) as $pid){
                $Posts[$i]["comments"][$v]=$pid;  
                $Posts[$i]["comments"][$v]["user"]=array();
                $Posts[$i]["comments"][$v]["user"]["nameuser"]=$pid["nameuser"];
                $v++;
           }
        }
        
        
        
        $response=new Response();
        
        $response->setContent(json_encode($Posts));        
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Content-Type', 'application/json');


        return $response;
    }
    
    
    public function getUsers(Request $request): Response
    {   
        $repository = $this->getDoctrine()->getRepository(User::class);    
        
        $Users = $repository->userlist($request->query->get("search")); 
        
        $prev=0;
        $b=0;
        $v=0;
        $items=array();
        $tems=array();
        
        for ($i=0;$i<count($Users);$i++){
           $Users[$i]["user"]["nameuser"]=$Users[$i]["nameuser"];
           
           $Users[$i]["comments"]=array();
           $v=0;
           foreach ($repository->getUserComments($Users[$i]["id"]) as $pid){
                $Users[$i]["comments"][$v]=$pid;  
                
                $Users[$i]["comments"][$v]["user"]=array();
                $Users[$i]["comments"][$v]["user"]["nameuser"]=$pid["nameuser"];
                
                $v++;
           }
           
           
           $Users[$i]["posts"]=array();
           $v=0;
           foreach ($repository->getUserPosts($Users[$i]["id"]) as $pid){
                $Users[$i]["posts"][$v]=$pid;  
                
                $Users[$i]["posts"][$v]["user"]=array();
                $Users[$i]["posts"][$v]["user"]["nameuser"]=$pid["nameuser"];
                
                $v++;
           }           
        }
        
        
        
        $response=new Response();
        
        $response->setContent(json_encode($Users));        
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Content-Type', 'application/json');


        return $response;
    }    
}
?>
