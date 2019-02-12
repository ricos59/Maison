<?php
namespace App\UserBundle\Controller;

use FOS\UserBundle\Controller\SecurityController as BaseController;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends BaseController{

  public function loginAction(Request $request){

  //  parent::loginAction();

    $form = $this->formFactory->createForm();
    $form->setData($user);

    /** @var $session Session */
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

    //return
    return $this->renderLogin(array(
        'last_username' => $lastUsername,
        'error' => $error,
        'csrf_token' => $csrfToken,
        'form' => $form->createView(),
    ));

    //return $this->render('@FOSUser/Registration/register.html.twig', array(

    //));



  }

}
