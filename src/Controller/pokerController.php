<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;



class pokerController extends AbstractController
{
    #[Route('/acces_poker', name: 'table_poker')]
    public function table_poker()
    {

        $request = Request::createFromGlobals();
        $age = $request->query->get("age");

        if ($age>=18){
            return $this->render('page/poker_welcom.html.twig');
        }else{
            return $this->render('page/get_out.html.twig');
        }

    }

    #[Route('/poker', name: 'form_poker')]
    public function form_poker()
    {
        $request = Request::createFromGlobals();
        $age = $request->query->get("age");

        if (!$request->query->has("age")) {
            return $this->render('page/poker.html.twig');
        } else {
            if ($age >= 18) {
                return $this->render('page/poker_welcom.html.twig');
            } else {
                return $this->render('page/get_out.html.twig');
            }
        }

    }

}


