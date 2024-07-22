<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Routing\Attribute\Route;

// pour la class et extends je ne vois pas exactement ce qu'ils font
class indexController extends AbstractController
{
    //permet donner un nom a la place de mon URL
#[Route('/', name: 'home')]
public function index(){

var_dump("salut");die;
}
}