<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UpdateFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

class UpdateController extends AbstractController
{


    /**
     * @var Security
     */
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }


    /**
     * @Route("/update", name="app_update")
     * @IsGranted("ROLE_USER")
     */
    public function index(
        EntityManagerInterface $entityManager,
        Request $request,
        UserPasswordEncoderInterface $passwordEncoder,
        TokenGeneratorInterface $tokenGenerator
    ): Response {
        $form = $this->createForm(UpdateFormType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $mail = $this->security->getUser()->getUsername();

            $entityManager = $this->getDoctrine()->getManager();

            $user = $entityManager->getRepository(User::class)->findOneBy(array('email' => $mail));

            var_dump($user);

            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('password')->getData()
                )
            );
            $entityManager->flush();
            $this->addFlash('succes', "votre mot de passe  à été bien modifié");
            return $this->redirectToRoute('app_logout');
        }

        return $this->render('update/index.html.twig', [
            'updateForm' => $form->createView(),
        ]);
    }
}
