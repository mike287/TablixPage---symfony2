<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Security\Core\SecurityContextInterface; // wygasa od wersji 3.0
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormError;
use UserBundle\Exception\UserException;
use UserBundle\Entity\User;
use UserBundle\Form\Type\LoginType;
use UserBundle\Form\Type\RememberPasswordType;
use UserBundle\Form\Type\RegisterUserType;

class LoginController extends Controller
{
    /**
     * @Route("/login",
     * name = "page_login"
     * )
     * @Template()
     */
    public function loginAction(Request $Request)
    {
        $Session = $this->get('session');

            if($Request->attributes->has(SecurityContextInterface::AUTHENTICATION_ERROR))
            {
                $loginError->$Request->attributes->get(SecurityContextInterface::AUTHENTICATION_ERROR);
            }
                else{
                    $loginError = $Session->remove(SecurityContextInterface::AUTHENTICATION_ERROR);
                }
            if(isset($loginError))
            {
                $this->get('session')->getFlashBag()->add('error', $login->getMessage());
            }
                
                $loginForm = $this->createForm(new LoginType(), array(
                    'username' => $Session->get(SecurityContextInterface::LAST_USERNAME)
                ));
                
        return array(
            'loginError' => $loginError,
            'loginForm' => $loginForm->createView()
        );
    }
}
