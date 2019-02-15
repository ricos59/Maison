<?php
namespace App\Controller\bundles\FOSUserBundle;

use FOS\UserBundle\Controller\SecurityController as BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use FOS\UserBundle\Form\Factory\FactoryInterface;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;

class SecurityController extends BaseController{

  private $tokenManager;

  public function __construct(CsrfTokenManagerInterface $tokenManager = null, FactoryInterface $formFactory, UserManagerInterface $userManager)
  {
    $this->tokenManager = $tokenManager;
    $this->formFactory = $formFactory;
    $this->userManager = $userManager;
  }

    public function testAction(\Swift_Mailer $mailer)
    {
        $message = (new \Swift_Message('You Got Mail!'))
            ->setFrom('sandradelaporte@gmail.com')
            ->setTo('sandradelaporte@gmail.com')
            ->setBody(
                   "Ceci est mon message",
                   'text/plain'
               )
           ;

        $mailer->send($message);
        return $this->redirectToRoute('fos_user_accueil');
    }


  public function loginAction(Request $request){

    $session = $request->getSession();

    $authErrorKey = Security::AUTHENTICATION_ERROR;
    $lastUsernameKey = Security::LAST_USERNAME;

    // get the error if any (works with forward and redirect -- see below)
    if ($request->attributes->has($authErrorKey)) {
      $error = $request->attributes->get($authErrorKey);
    } elseif (null !== $session && $session->has($authErrorKey)) {
      $error = $session->get($authErrorKey);
      $session->remove($authErrorKey);
    } else {
      $error = null;
    }

    if (!$error instanceof AuthenticationException) {
      $error = null; // The value does not come from the security component.
    }

    // last username entered by the user
    $lastUsername = (null === $session) ? '' : $session->get($lastUsernameKey);

    $csrfToken = $this->tokenManager
    ? $this->tokenManager->getToken('authenticate')->getValue()
    : null;

    //formulaire registration FOS
    $user = $this->userManager->createUser();
    $user->setEnabled(true);

    $form = $this->formFactory->createForm();
    $form->setData($user);

    return $this->renderLogin(array(
      'last_username' => $lastUsername,
      'error' => $error,
      'csrf_token' => $csrfToken,
      'form' =>$form->createView(),
    ));

  }

}
