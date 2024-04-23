<?php

namespace App\Controller;

use App\Form\Type\SmartphoneType;
use App\Repository\SmartphoneRepository;
use App\Service\Compare;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/**
 * Controller for adding smartphones, and comparing them.
 */
class Controller extends AbstractController {
  private SmartphoneRepository $repository;

  /**
   * @param \App\Repository\SmartphoneRepository $repository
   */
  public function __construct(SmartphoneRepository $repository) {
    $this->repository = $repository;
  }

  /**
   * Redirects to smartphones list when user access '/' path.
   *
   * @return \Symfony\Component\HttpFoundation\Response
   *   Returns redirect response to the smartphone list.
   */
  #[Route('/' , name: 'home')]
  public function index():Response {
    return $this->redirectToRoute('smartphone-list');
  }

  /**
   * Adds new smartphones.
   *
   * @param \Symfony\Component\HttpFoundation\Request $request
   *   Takes request object to handle the requests from form.
   *
   * @return \Symfony\Component\HttpFoundation\Response
   *   Returns a form view to put smartphone data.
   */
  #[Route('/smartphone/add', name: 'add-smartphone')]
  public function addDevice(Request $request):Response {
    $form = $this->createForm(SmartphoneType::class);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $smartphone = $form->getData();
      $this->repository->save($smartphone);
      $this->addFlash('success', 'Smartphone added successfully');
      return $this->redirectToRoute('smartphone-list');
    }
    return $this->render('smartphone/add.html.twig', [
      'form' => $form
    ]);
  }

  /**
   * Returns all smartphones stored in the database.
   *
   * @return \Symfony\Component\HttpFoundation\Response
   *   Returns all smartphones stored in the database.
   */
  #[Route('/smartphone/list', name: 'smartphone-list')]
  public function getAllSmartphones():Response {
    $smartphones = $this->repository->findAll();
    return $this->render('smartphone/list.html.twig', [
      'smartphones' => $smartphones
    ]);
  }

  /**
   * Takes two smartphone id and compares them according to their
   * specifications and price.
   *
   * @param int $id1
   *   ID of smartphone 1.
   * @param int $id2
   *   ID of smartphone 2.
   *
   * @return \Symfony\Component\HttpFoundation\Response
   *   Returns response displaying the comparison result.
   */
  #[Route('/smartphone/compare/{id1}/and/{id2}', name: 'compare-smartphone',
    requirements: ['id1' => '\d+', 'id2' => '\d+'],)]
  public function compare(int $id1, int $id2):Response {
    if(($smartphone1 = $this->repository->findOneBy(['id' => $id1])) &&
        ($smartphone2 = $this->repository->findOneBy(['id' => $id2]))) {
      $result = Compare::compare($smartphone1,$smartphone2);
      return $this->render('smartphone/compare.html.twig', [
        'smartphone1' => $smartphone1,
        'smartphone2' => $smartphone2,
        'result' => $result
      ]);
    }else{
     return $this->render('smartphone/error.html.twig', [
       'error' => "Smartphone not found"
     ]);
    }
  }

  /**
   * Displays a single smartphone using its ID.
   *
   * @param int $id
   *   Smartphone ID to search smartphone in the database.
   *
   * @return \Symfony\Component\HttpFoundation\Response
   *   Returns response displaying the smartphone with given ID.
   */
  #[Route('/smartphone/{id}', name: 'single-smartphone')]
  public function getSmartphoneByName(int $id):Response {
    $smartphone = $this->repository->findOneBy(['id' => $id]);
    return $this->render('smartphone/single.html.twig', [
      'smartphone' => $smartphone
    ]);
  }

}
