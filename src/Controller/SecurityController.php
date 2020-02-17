<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Repository\UsersRepository;
use App\Form\RegistrationFormType;
use App\Service\EmailService;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('redirect');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        
        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername, 
            'error' => $error
            ]);
    }

    /**
     * @Route("/password-update", name="password_update")
     */
    public function password_update(
        Request $request, 
        UsersRepository $usersRepo,
        UserPasswordEncoderInterface $passwordEncoder
    ) {

        $user = $this->getUser();
        $success = "Votre mot de passe a bien été modifié.";

        if (!$user) {
            $email = $request->query->get('email');

            $user = $usersRepo->findOneBy( array( 'email' => $email ) );

            if (!$user) {
                throw new \Exception("Page interdite !");
            }

            $success = "Votre mot de passe a bien été modifié. Vous pouvez maintenant l'utiliser pour vous conecter";
        }

        $form = $this->createForm(RegistrationFormType::class, $user);
        $form
            ->remove('nom')
            ->remove('prenom')
            ->remove('codepostal')
            ->remove('adresse')
            ->remove('ville')
            ->remove('email')
        ;

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('password')->getData()
                )
            );

            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->addFlash('success', $success);
            return $this->redirectToRoute('app_login');
        }

        return $this->render('security/password_update.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/password-forgotten", name="password_forgotten")
     */
    public function password_forgotten(Request $request, UsersRepository $usersRepo, EmailService $emailService)
    {

       
        if($request->isMethod('POST')) {

            // dump($request->request->all());

            $email = $request->request->get('email');
            $user = $usersRepo->findOneBy(array('email' => $email) );
          
            if(!$user) {
                $this->addFlash('danger', 'Votre addresse ne correspond pas a aucun compte');
            }else{
                

                $em = $this->getDoctrine()->getManager();
                $em ->flush();

                $link = $this->generateUrl('password_update', ['email'=>$user->getEmail()], UrlGeneratorInterface::ABSOLUTE_URL);
                // dump($link);die;

                $emailService->password_forgotten($user,$link);

                $this->addFlash('success', 'Nous vous avons envoyer un email content un lien pour modifier votre mot de passe.');
                return $this->redirectToRoute('password_forgotten', ['send' =>'ok']);
            }

        }
        //Redirect vers login avec flash
        return $this->render('security/password_forgotten.html.twig', [

        ]);
    }


    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \Exception('This method can be blank - it will be intercepted by the logout key on your firewall');
    }

    /**
     * @Route("/штампы", name="hack")
     */
    public function hack()
    {
        return $this->render('security/hack.html.twig', [

            ]);
    }

    
}
