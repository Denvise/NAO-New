<?php

namespace NAO\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use NAO\CoreBundle\Entity\User;
use NAO\CoreBundle\Form\Type\UserType;
use NAO\CoreBundle\Form\Type\LoginType;
use NAO\CoreBundle\Form\Type\ForgotPasswordType;

class UserController extends Controller
{
    public function loginAction(Request $request)
    {
        // Création du formulaire
        $user = new User();
        $form = $this->createForm(LoginType::class, $user);

        // Traitement du formulaire
        // Si le visiteur est déjà identifié, on le redirige vers mon compte
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirectToRoute('nao_core_account');
        }

        // Le service authentication_utils permet de récupérer le nom d'utilisateur
        // et l'erreur dans le cas où le formulaire a déjà été soumis mais était invalide (mauvais mot de passe...)
        $authenticationUtils = $this->get('security.authentication_utils');

        // Affichage de la vue
        return $this->render('NAOCoreBundle:User:login.html.twig', array(
            'form' => $form->createView(),
            'last_username' => $authenticationUtils->getLastUsername(),
            'error' => $authenticationUtils->getLastAuthenticationError()
        ));
    }

    public function passwordAction(Request $request)
    {
        // Création du formulaire
        $user = new User();
        $form = $this->createForm(ForgotPasswordType::class, $user);

        // Traitement du formulaire
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

        }

        // Affichage de la vue
        return $this->render('NAOCoreBundle:User:password.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function registerAction(Request $request)
    {
        // Création du formulaire
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        // Traitement du formulaire
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $this->get('nao_core.users')->setUserAccount($user);

            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('nao_core_account');
        }

        // Affichage de la vue
        return $this->render('NAOCoreBundle:User:register.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function accountAction()
    {
        // Affichage de la vue
        return $this->render('NAOCoreBundle:User:account.html.twig');
    }
}
