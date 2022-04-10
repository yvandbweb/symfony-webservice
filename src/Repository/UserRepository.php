<?php

// src/Repository/PostRepository.php
namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }	

    public function userlist($search): array
    {
        $conn = $this->getEntityManager()->getConnection();
        
        $sql = "SELECT u.id as id,u.nameuser as nameuser,u.datetime as dateCreated
                FROM user u 
                WHERE u.nameuser LIKE '%".$search."%' 
                ORDER BY u.nameuser ASC";
        
        $stmt = $conn->query($sql);
        
        return $stmt->fetchAllAssociative();
    }
    
    public function getUserComments($id): array
    {
        $conn = $this->getEntityManager()->getConnection();
        
        $sql = "SELECT *,c.datetime as dateCreated FROM comment c 
                LEFT JOIN user u ON(u.id=c.user_id) 
                WHERE c.user_id=".$id;
        
        $stmt = $conn->query($sql);
        
        return $stmt->fetchAllAssociative();
    }			
    
    public function getUserPosts($id): array
    {
        $conn = $this->getEntityManager()->getConnection();
        
        $sql = "SELECT *,p.datetime as dateCreated FROM post p 
                LEFT JOIN user u ON(u.id=p.user_id) 
                WHERE p.user_id=".$id;
        
        $stmt = $conn->query($sql);
        
        return $stmt->fetchAllAssociative();
    }	    
}

?>

