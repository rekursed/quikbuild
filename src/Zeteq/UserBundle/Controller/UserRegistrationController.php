<?php

namespace Zeteq\UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Zeteq\UserBundle\Entity\User;
use Zeteq\UserBundle\Form\UserType;
use Zeteq\UserBundle\Form\RegisterUserType;
use Zeteq\UserBundle\Form\UserChangePasswordType;
 
/**
 * User controller.
 *
 */
class UserRegistrationController extends Controller
{
    
    
     
    
    
        public function registerAction(Request $request)
   {

              $entity = new User();
        $form   = $this->createForm(new RegisterUserType(), $entity);

              

        return $this->render('ZeteqUserBundle:UserRegistration:register.html.twig', 
                array(
            'entity' => $entity,
            'form'   => $form->createView(),
        )
                
                );
    }
    
    
        public function registersaveAction(Request $request) 
      {

        $entity  = new User();
        $form = $this->createForm(new RegisterUserType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {


        $factory = $this->get('security.encoder_factory');
        $encoder = $factory->getEncoder($entity);
        $password = $encoder->encodePassword($entity->getPassword(), $entity->getSalt());
        $entity->setPassword($password);
        $em = $this->getDoctrine()->getManager();
        $group = $em->getRepository('ZeteqUserBundle:Role')->findOneByRole('ROLE_STORE');
        $entity->addRole($group);
        $rand_string = $this->randString(15);
        $entity->setActivationCode($rand_string);
        $entity->setIsActive(false);
        $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            
            
            //send email
            $web = $this->container->getParameter('web');
            $email = $this->container->getParameter('email');
$email_name = $this->container->getParameter('email_name');
$site_name = $this->container->getParameter('site_name');   

             $message = \Swift_Message::newInstance()
                    ->setSubject('Registration Successful ')
                    ->setFrom(array($email => $email_name))
                    ->setTo($entity->getEmail())
                    ->setBody(
                    $this->renderView(
                            'ZeteqUserBundle:UserRegistration:register_success_email.html.twig', array('site_name'=>$site_name, 'web'=>$web,  'user' => $entity)
                    ),'text/html'
                    )
            ;
            $this->get('mailer')->send($message);
            //end send email

            return $this->redirect($this->generateUrl('register_success', array('id' => $entity->getId())));
        }

        $template = "register";
        return $this->render('ZeteqUserBundle:UserRegistration:register.html.twig', 
                array(
            'entity' => $entity,
            'form'   => $form->createView(),  ));
    }
    
      public function register_successAction(Request $request) 
      {
          
 
        return $this->render(
           'ZeteqUserBundle:UserRegistration:register_success.html.twig'
        );    
          
      }
      
      
      
          
    
        public function activate_userAction($rand_string) 
     {

        $em = $this->getDoctrine()->getManager();

        $dql = "SELECT a FROM ZeteqUserBundle:User a WHERE a.activation_code=:rand_string";

        $query = $em->createQuery($dql);
        $query->setParameter('rand_string', $rand_string);
        $entity= $query->getOneOrNullResult();
        
        
        
        $entity->setIsActive(true);
        $entity->setActivationCode($this->randString(25));
                     $em->persist($entity);
                $em->flush();

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Page entity.');
        }

  
        return $this->render('ZeteqUserBundle:UserRegistration:activate_user.html.twig', array(
                    'user' => $entity,
                    
                ));
    }
    
    
    
    
    
    function randString($length, $charset='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789')
{
    $str = '';
    $count = strlen($charset);
    while ($length--) {
        $str .= $charset[mt_rand(0, $count-1)];
    }
    return $str;
}
    
    
 
    
    }
