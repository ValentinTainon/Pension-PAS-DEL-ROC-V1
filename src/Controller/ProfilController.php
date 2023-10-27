<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Form\CommentaireFormType;
use App\Repository\CommentaireRepository;
use App\Repository\ReservationRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    #[IsGranted('ROLE_USER')]
    public function index(): Response
    {
        return $this->render('profil/profil.html.twig');
    }

    #[Route('/mesReservations', name: 'app_mesReservations')]
    #[IsGranted('ROLE_USER')]
    public function mesReservations(ReservationRepository $reservationRepository): Response
    {
        $user = $this->getUser();

        if ($this->container->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            return $this->render('profil/mesReservations.html.twig', [
                'reservations' => $reservationRepository->findAll(),
            ]);
        }
        return $this->render('profil/mesReservations.html.twig', [
            'reservations' => $reservationRepository->findBy([
                'user' => $user,
            ])
        ]);
    }

    #[Route('/commentaire', name: 'app_commentaire', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_USER')]
    public function commentaire(Request $request, CommentaireRepository $commentaireRepository): Response
    {
        $user = $this->getUser();
        $commentaire = new Commentaire;
        $reservation = $commentaire->getReservation();

        $form = $this->createForm(CommentaireFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dateCreation = (new \DateTime('now'))->format('d-m-Y H:i:s');
            $commentaireClient = $form->get('commentaire')->getData();

            $commentaire->setUser($user)
                        ->setReservation($user)
                        ->setDateCreation($dateCreation)
                        ->setCommentaire($commentaireClient);
            $commentaireRepository->save($commentaire, true);
            $this->addFlash('Succès', 'Votre commentaire a été envoyé !');
            return $this->redirectToRoute('app_mesReservations', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('profil/commentaire.html.twig', [
            'commentaire' => $commentaire,
            'form' => $form,
        ]);
    }
}
