<?php

// src/Repository/CommentRepository.php
namespace App\Repository;

use App\Entity\Comment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CommentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comment::class);
    }


    public function getPosts1($str): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "SELECT *,p.datetime as dateCreated,p.id postid FROM post p
                LEFT JOIN user u ON(u.id=p.user_id)
                WHERE txt LIKE '%".$str."%'
                ORDER BY p.datetime DESC";
                
        $stmt = $conn->query($sql);
        
        return $stmt->fetchAllAssociative();
    }
    
    public function getComments($id): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "SELECT *,c.datetime as dateCreated,c.id as comid FROM comment c 
                LEFT JOIN user u ON(u.id=c.user_id)
                WHERE c.post_id=".$id." 
                ORDER BY c.datetime DESC";
                
        $stmt = $conn->query($sql);
        
        return $stmt->fetchAllAssociative();
    }    
}

?>

