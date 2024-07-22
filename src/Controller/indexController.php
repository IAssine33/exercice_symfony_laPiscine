<?php
// src/Controller.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Routing\Attribute\Route;

// la classe "indexController" est l'enfant de l'extends "AbstractController(parent)",
// qui permet de prendre toute les methodes dans l'extends et les utiliser dans la class (enfant).
class indexController extends AbstractController
{
    //permet donner un nom d'URL qui est "/"
#[Route('/', name: 'home')]
public function index(){

return $this->render('index.html.twig');
}
}