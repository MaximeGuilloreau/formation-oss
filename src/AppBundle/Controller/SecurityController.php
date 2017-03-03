<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\SignInType;
use AppBundle\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class SecurityController
 */
class SecurityController extends Controller
{
    /**
     * @Route("/sign-in", name="security_signin")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function signInAction(): Response
    {
        $form = $this->createForm(SignInType::class);

        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/signin.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
            'form'          => $form->createView(),
        ]);
    }

    /**
     * @Route("/sign-up", name="security_signup")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function signUpAction(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $password = $this->get('security.password_encoder')
                ->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            $this->get('formation_oss.object_saver')->save($user);

            return $this->redirectToRoute('security_signin');
        }

        return $this->render(':security:signup.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/logout", name="security_logout")
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function logoutAction(): Response
    {
        return $this->redirectToRoute('security_signin');
    }
}
