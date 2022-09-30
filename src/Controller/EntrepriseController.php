<?php

namespace App\Controller;

use App\Entity\Employes;
use App\Form\EmployesType;
use App\Repository\EmployesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EntrepriseController extends AbstractController
{
//---------------------------------------------------------------------------------------------------------------------------------------
#[Route('/', name: 'home')]
public function home(): Response
{
    return $this->render('base.html.twig');
}
//---------------------------------------------------------------------------------------------------------------------------------------
#[Route('/entreprise', name: 'app_entreprise')]
#[Route('/entreprise/{id}', name: 'salarie_edit')]
public function index(EmployesRepository $repo, Request $globals, EntityManagerInterface $manager, Employes $salarie = null): Response
{
    $salaries_all=$repo->findAll();
    if( $salarie == null) {
        $salarie=new Employes;
    }
    $form=$this->createForm(EmployesType::class, $salarie);

    $form->handleRequest($globals);
    
    if($form->isSubmitted() && $form->isValid()) {
        $manager->persist($salarie);
        $manager->flush();
        return $this->redirectToRoute('app_entreprise');
    }
    return $this->renderForm('entreprise/index.html.twig', [
        'form'=> $form,
        'salaries' => $salaries_all,
        'editMode'=> $salarie->getId() !== null
    ]);
}
//---------------------------------------------------------------------------------------------------------------------------------------
#[Route('/entreprise/delete/{id}', name: 'salarie_delete')]
public function delete ($id, Employes $salarie, EntityManagerInterface $manager, EmployesRepository $repo): Response
{
    $salarie=$repo->find($id);
    $manager->remove($salarie);
    $manager->flush();

    return $this->redirectToRoute('app_entreprise');
}
//---------------------------------------------------------------------------------------------------------------------------------------
}
