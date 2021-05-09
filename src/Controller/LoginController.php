<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Usuarios;

/**
    * @Route("/login", name="login")
    */
class LoginController extends AbstractController
{
    /**
     * @Route("/", name="inicio")
     */

    public function inicio(Request $request)
    {
        return $this->render('login/index.html.twig', [
            'controller_name' => 'LoginController', 'msj' => ''
        ]);
    }
    /**
     * @Route("/verificar", name="verificar")
     */
    public function verificar(Request $request)
    {
        //Saca los valores que se mandaron en el formulario dentro del request.
        $email =$request->request->get("email");
        $password =$request->request->get("password");

        $em = $this-> getDoctrine() -> getManager();
        //Busco con el Entity Manager un usuario con el email y contraseña ingresados
        $usuario = $em -> getRepository(Usuarios::class) -> findOneBy(["email" => $email, "password" => $password]);

        if($usuario <> null){
            $msj = 'Acceso correcto';
            $vista = 'login/response.html.twig';
        }
        else{
            $msj = 'Usuario o contraseña incorrectos';
            $vista = 'login/index.html.twig';
        }

        return $this->render($vista, [
            'controller_name' => 'LoginController', 'msj' => $msj
            ]);
    }

};


