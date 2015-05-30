<?php

// src/MC/EventBundle/Controller/AdvertController.php

namespace MC\EventBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use MC\EventBundle\Entity\Evenement;
use MC\EventBundle\Entity\EvenementRepository;
use MC\EventBundle\Form\EvenementType;
use MC\EventBundle\Form\EvenementEditType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Doctrine\Common\Collections;
use FOS\UserBundle;
use MC\UserBundle\Entity\User;
use MC\EventBundle\Entity\EvenementSearch;
use MC\EventBundle\Form\EvenementSearchType;

class AdvertController extends Controller 
{
  public function indexAction($page)
  {
    if ($page < 1) {
      throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
    }
	
    // Ici, on récupérera la liste des événements, puis on la passera au template
    $repository = $this
    ->getDoctrine()
    ->getManager()
    ->getRepository('MCEventBundle:Evenement');

    $resultatsParPage = 20;
    // $listEvenements = $repository->findBy(array(), array('debut' => 'asc'), $resultatsParPage, ($page-1)*$resultatsParPage);

    $listEvenements = $repository->findByDebut($page, $resultatsParPage);
    /* $listEvenements = array(
      array(
        'nomEvenement'   => 'Soirée post partiels',
        'id'      => 1,
        'nomOrganisateur'  => 'Coopé',
        'descriptif' => 'Nous recherchons un dÃ©veloppeur Symfony2 dÃ©butant sur Lyon. Blablaâ€¦',
        'dateDebut'    => 'lundi'),
      array(
        'nomEvenement'   => 'Blindtest',
        'id'      => 2,
        'nomOrganisateur'  => 'BdA',
        'descriptif' => 'Nous recherchons un webmaster capable de maintenir notre site internet. Blablaâ€¦',
        'dateDebut'    => 'mardi'),
      array(
        'nomEvenement'   => 'JT de passation',
        'id'      => 3,
        'nomOrganisateur'  => 'SMS',
        'descriptif' => 'Nous proposons un poste pour webdesigner. Blablaâ€¦',
        'dateDebut'    => 'jeudi')
    ); */
    // Mais pour l'instant, on ne fait qu'appeler le template
    return $this->render('MCEventBundle:Advert:index.html.twig', array(
  'listEvenements'=> $listEvenements, 'page'=> $page
  ));
  }

  public function viewAction($id)
  {	
	$repository = $this
		->getDoctrine()
		->getManager()
		->getRepository('MCEventBundle:Evenement');
	
    $evenement = $repository->find($id);
	if (null == $evenement) {
		throw new NotFoundHttpException("L'événement d'id ".$id." n'existe pas.");
    }
    return $this->render('MCEventBundle:Advert:view.html.twig', array(
      'evenement' => $evenement
    ));
  }
  
  /**
  * @Security("has_role('ROLE_ORGANISATEUR')")
  */
  public function addAction(Request $request)
  {
    // Création de l'entité Evenement
    $evenement = new Evenement();

    // Création du formulaire
    $form = $this->get('form.factory')->create(new EvenementType(), $evenement);
   
    // On vérifie que les valeurs entrées sont correctes
    if ($form->handleRequest($request)->isValid())
    { 
        $this->getCa()->addEvenement($evenement);
        $evenement->addCa($ca);
        $em = $this->getDoctrine()->getManager();
        $em->persist($evenement);
        $em->flush();

        $request->getSession()->getFlashBag()->add('notice', 'Evénement bien enregistré.');

        //On redirige vers la page de visualisation de l'événement nouvellement créé
        return $this->redirect($this->generateUrl('mc_event_view', array('id' => $evenement->getId())));

    }

    return $this->render('MCEventBundle:Advert:add.html.twig',array('form' => $form->createView()));
  }
  
  /**
  * @Security("has_role('ROLE_ORGANISATEUR')")
  */
  public function editAction($id, Request $request)
  {
    $em = $this->getDoctrine()->getManager();

    // On récupère l'événement $id
    $evenement = $em->getRepository('MCEventBundle:Evenement')->find($id);

    if (null == $evenement) {
      throw new NotFoundHttpException("L'événement d'id ".$id." n'existe pas.");
    }

    $form = $this->createForm(new EvenementEditType(), $evenement);

    if ($form->handleRequest($request)->isValid()) {
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'Evénement bien modifié.');

      return $this->redirect($this->generateUrl('mc_event_view', array('id' => $evenement->getId())));
    }

    return $this->render('MCEventBundle:Advert:edit.html.twig', array(
      'form' => $form->createView(),
      'evenement' => $evenement // Je passe également l'événement à la vue si jamais il veut l'afficher
    ));
  }
  
  /**
  * @Security("has_role('ROLE_ORGANISATEUR')")
  */
  public function deleteAction($id, Request $request)
  {
    $em = $this->getDoctrine()->getManager();

    // On récupère l'événement $id
    $evenement = $em->getRepository('MCEventBundle:Evenement')->find($id);

    if (null == $evenement) {
      throw new NotFoundHttpException("L'événement d'id ".$id." n'existe pas.");
    }

    // On crée un formulaire vide, qui ne contiendra que le champ CSRF
    // Cela permet de protéger la suppression d'événement contre cette faille
    $form = $this->createFormBuilder()->getForm();
	
    if ($form->handleRequest($request)->isValid()) {
      $em->remove($evenement);
      $em->flush();

      $request->getSession()->getFlashBag()->add('info', "L'événement a bien été supprimé.");

     return $this->redirect($this->generateUrl('mc_event_home'));
    }
	$em->remove($evenement);
    $em->flush();
    // Si la requête est en GET, on affiche une page de confirmation avant de supprimer
    return $this->redirect($this->generateUrl('mc_event_home'));
  }
  
  public function menuAction()
  {
    $repository = $this
    ->getDoctrine()
    ->getManager()
    ->getRepository('MCEventBundle:Evenement');

    $listEvenements = $repository->findByDebut(1, 5);

    return $this->render('MCEventBundle:Advert:menu.html.twig', array(
      // Tout l'intérêt est ici : le contrôleur passe
      // les variables nécessaires au template !
      'listEvenements' => $listEvenements
    ));
  }

  public function myevAction($page)
  {

    if ($page < 1) {
      throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
    }

    $user = $this->getUser();

    $cas = $user->getCas();

    $resultatsParPage = 20;

    $repository = $this
    ->getDoctrine()
    ->getManager()
    ->getRepository('MCEventBundle:Evenement');

    $listEvenements = $repository->findByUser($page, $resultatsParPage, $user);

    return $this->render('MCEventBundle:Advert:myev.html.twig', array(
      'listEvenements' => $listEvenements, 
      'page' => $page
    ));
  }



    public function listAction($listEvenements)
    {

        return $this->render('MCEventBundle:Advert:list.html.twig',array(
            'listEvenements' => $listEvenements,
        ));
    }

    public function searchAction()
    {
      $form = $this->get('form.factory')->create(new EvenementSearchType());

      $request = $this->getRequest();

      if($request->getMethod() == 'POST')
      {
        $form->bind($request);

        if($form->isValid())

        {


         $em = $this->getDoctrine()->getManager();

      //On récupère les données entrées dans le formulaire par l'utilisateur

         $data = $this->getRequest()->request->get('evenement_search_type');
         
      //On va récupérer la méthode dans le repository afin de trouver toutes les annonces filtrées par les paramètres du formulaire

         $listEvenements = $em->getRepository('MCEventBundle:Evenement')->findByCriteria($data['dateFrom'], $data['dateTo'], $data['nomEvenement'], $data['nomOrganisateur']);

      //Puis on redirige vers la page de visualisation de cette liste d'annonces

         return $this->render('MCEventBundle:Advert:list.html.twig', array('listEvenements' => $listEvenements));

       }

     }

     return $this->render('MCEventBundle:Advert:search.html.twig',array(
      'form' => $form->createView(),
      ));
   }

}

