<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Entity\Reservation;
use App\Form\AnimalProfilType;
use App\Repository\AnimalRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/animal')]
class AnimalController extends AbstractController
{
    #[Route('/', name: 'app_animal_index', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    public function index(AnimalRepository $animalRepository): Response
    {
        $user = $this->getUser();
        return $this->render('animal/index.html.twig', [
            'animals' => $animalRepository->findBy([
                'user' => $user,
            ]),
        ]);
    }

    #[Route('/new', name: 'app_animal_new', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_USER')]
    public function new(Request $request, AnimalRepository $animalRepository): Response
    {
        $user = $this->getUser();
        $animal = new Animal();
        $form = $this->createForm(AnimalProfilType::class, $animal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $animal->setUser($user);
            $animalRepository->save($animal, true);

            return $this->redirectToRoute('app_animal_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('animal/new.html.twig', [
            'animal' => $animal,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_animal_show', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    public function show(Animal $animal): Response
    {
        return $this->render('animal/show.html.twig', [
            'animal' => $animal,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_animal_edit', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_USER')]
    public function edit(Request $request, Animal $animal, AnimalRepository $animalRepository): Response
    {
        $form = $this->createForm(AnimalProfilType::class, $animal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $animalRepository->save($animal, true);

            return $this->redirectToRoute('app_animal_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('animal/edit.html.twig', [
            'animal' => $animal,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_animal_delete', methods: ['POST'])]
    #[IsGranted('ROLE_USER')]
    public function delete(Request $request, Animal $animal, AnimalRepository $animalRepository, Reservation $reservation): Response
    {
        $user = $this->getUser();
        
        if($reservation->getAnimal() == false){
            if ($this->isCsrfTokenValid('delete'.$animal->getId(), $request->request->get('_token'))) {
                $animalRepository->remove($animal, true);
            }
        }

        return $this->redirectToRoute('app_animal_index', [], Response::HTTP_SEE_OTHER);
    }
}
