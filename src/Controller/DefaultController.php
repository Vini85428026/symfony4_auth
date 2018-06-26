<?php

namespace App\Controller;

use App\Entity\User;
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
     * @Template("default/index.html.twig")
     */
    public function admin()
    {
        $texto = "User is not admin!";

        if ($this->isGranted('ROLE_ADMIN')) {
            $texto = "User is admin!";
        }

        return [
            "texto" => $texto
        ];
    }

    /**
     * @Route("/admin/dashboard", name="dashboard")
     * @Template("default/dashboard.html.twig")
     */
    public function dashboard()
    {
        return [];
    }

    /**
     * @Route("/admin/relatorios", name="relatorios")
     * @Template("default/relatorios.html.twig")
     */
    public function relatorios()
    {
        return [];
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

    /**
     * @param Request $request
     * @Route("/insert")
     * @return Response
     */
    public function insert(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $user = new User();
        $user->setUsername('vinic');
        $user->setEmail('vini@email.com');
        $user->setRoles("ROLE_USER");

        $encoder = $this->get('security.password_encoder');
        $pass = $encoder->encodePassword($user, "abc");
        $user->setPassword($pass);
        $em->persist($user);

        $user2 = new User();
        $user2->setUsername('admin');
        $user2->setEmail('adm@email.com');
        $user2->setRoles("ROLE_ADMIN");

        $encoder = $this->get('security.password_encoder');
        $pass = $encoder->encodePassword($user2, "qwe");
        $user2->setPassword($pass);
        $em->persist($user2);

        $em->flush();

        return new Response("<h1>Inserido com sucesso!</h1>");

    }
}
