<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="default")
     */
    public function index()
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function admin()
    {
        return new Response("<html><body><h1>Admin page!</h1></body></html>");
    }

    /**
     * @Route("/admin/dashboard", name="dashboard")
     */
    public function dashboard()
    {
        return new Response("<html><body><h1>Admin dashboard page!</h1></body></html>");
    }

    /**
     * @Route("/admin/relatorios", name="relatorios")
     */
    public function relatorios()
    {
        return new Response("<html><body><h1>Admin relatorios page!</h1></body></html>");
    }

    /**
     * @Route("/admin/login", name="login")
     * @Template("default/login.html.twig")
     * @param Request $request
     * @param AuthenticationUtils $authUtils
     * @return array
     */
    public function login(Request $request, AuthenticationUtils $authUtils)
    {
        $error = $authUtils->getLastAuthenticationError();
        $lastUsername = $authUtils->getLastUsername();

        return [
            'error' => $error,
            'last_username' => $lastUsername
        ];
    }
}
