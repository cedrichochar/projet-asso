<?php
// src/MC/EventBundle/Controller/CAController.php

namespace MC\EventBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use MC\EventBundle\Entity\CA;
use MC\EventBundle\Form\CAType;
use MC\EventBundle\Form\CAEditType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use MC\EventBundle\Model\CASearch;
use MC\EvenetBundle\Form\CASearchType;
use MC\UserBundle\Entity\User;

class CAController extends Controller
{
  public function indexAction($page)
    {
    // On ne sait pas combien de pages il y a
    // Mais on sait qu'une page doit être supérieure ou égale à  1
    if ($page < 1) {
      // On déclenche une exception NotFoundHttpException, cela va afficher
      // une page d'erreur 404 (qu'on pourra personnaliser plus tard d'ailleurs)
      throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
    }
    // Ici, on récupérera la liste des événements, puis on la passera au template
    $repository = $this
    ->getDoctrine()
    ->getManager()
    ->getRepository('MCEventBundle:CA');

    $resultatsParPage = 10;

    $listCA = $repository->findByNomCA($page, $resultatsParPage);
    // Mais pour l'instant, on ne fait qu'appeler le template
    return $this->render('MCEventBundle:CA:index.html.twig', array(
  'listCA'=> $listCA
  ));
  }
  
  /**
  * @Security("has_role('ROLE_ADMIN')")
  */
  public function addAction(Request $request)
  {
    // Création de l'entité CA
    $ca = new CA();

    // Création du formulaire
    $form = $this->get('form.factory')->create(new CAType(), $ca);
   
    // On vérifie que les valeurs entrées sont correctes
    if ($form->handleRequest($request)->isValid())
    {
        if($ca->getImage() != null) {$ca->getImage()->upload();}
        $em = $this->getDoctrine()->getManager();
        $em->persist($ca);
        $em->flush();

        $request->getSession()->getFlashBag()->add('notice', 'Club ou association bien enregistré(e).');

        //On redirige vers la page de visualisation du CA nouvellement créé
        return $this->redirect($this->generateUrl('mc_ca_view', array('id' => $ca->getId())));
         $contenu =$this->renderView('MCEventBundle:CA:email.txt.twig');
        mail ('louis.annabi@supelec.fr', 'Enregistrement club ou association ok', $contenu);


    }

    return $this->render('MCEventBundle:CA:add.html.twig',array('form' => $form->createView()));
  }

  /**
  * @Security("has_role('ROLE_ADMIN')")
  */
  public function editAction($id, Request $request)
  {
    $em = $this->getDoctrine()->getManager();

    // On récupère le ca $id
    $ca = $em->getRepository('MCEventBundle:CA')->find($id);

    if (null === $ca) {
      throw new NotFoundHttpException("Le club ou association d'id ".$id." n'existe pas.");
    }

    $form = $this->createForm(new CAEditType(), $ca);

    if ($form->handleRequest($request)->isValid()) {
      // Inutile de persister ici, Doctrine connait déjà notre ca
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'Club ou association bien modifié(e).');

      return $this->redirect($this->generateUrl('mc_ca_view', array('id' => $ca->getId())));
    }

    return $this->render('MCEventBundle:CA:edit.html.twig', array(
      'form'   => $form->createView(),
      'ca' => $ca // Je passe également le ca à la vue si jamais il veut l'afficher
    ));
  }
  
  /**
  * @Security("has_role('ROLE_ADMIN')")
  */
  public function deleteAction($id, Request $request)
  {
    $em = $this->getDoctrine()->getManager();

    // On récupère le ca $id
    $ca = $em->getRepository('MCEventBundle:CA')->find($id);

    if (null === $ca) {
      throw new NotFoundHttpException("Le club ou association d'id ".$id." n'existe pas.");
    }

    // On crée un formulaire vide, qui ne contiendra que le champ CSRF
    // Cela permet de protéger la suppression de CA contre cette faille
    $form = $this->createFormBuilder()->getForm();

    if ($form->handleRequest($request)->isValid()) {
      $em->remove($ca);
      $em->flush();

      $request->getSession()->getFlashBag()->add('info', "Le club ou association a bien été supprimé(e).");

      return $this->redirect($this->generateUrl('mc_ca_home'));
    }

    $em->remove($ca);
    $em->flush();
    // Si la requête est en GET, on affiche une page de confirmation avant de supprimer
    return $this->redirect($this->generateUrl('mc_ca_home'));
 
//return $this->render('MCEventBundle:CA:delete.html.twig', array(
  //    'form'   => $form->createView(),
    //  'ca' => $ca // Je passe également le ca à la vue si jamais il veut l'afficher
    //));

  }
  

  public function viewAction($id)
  {
    $repository = $this
    ->getDoctrine()
    ->getManager()
    ->getRepository('MCEventBundle:CA');
  
    $ca = $repository->find($id);
  if (null == $ca) {
    throw new NotFoundHttpException("Le Club/Asso d'id ".$id." n'existe pas.");
    }
    return $this->render('MCEventBundle:CA:view.html.twig', array(
      'ca' => $ca, 
    ));
  }

  public function mycaAction($page)
  {

    if ($page < 1) {
      throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
    }

    $user = $this->getUser();

    $resultatsParPage = 20;

    $repository = $this
    ->getDoctrine()
    ->getManager()
    ->getRepository('MCEventBundle:CA');

    $listCA = $repository->findByUser($page, $resultatsParPage, $user);

    return $this->render('MCEventBundle:CA:myca.html.twig', array(
      'listCA' => $listCA,
    ));
  }

  public function listAction(Request $request)
    {
        $caSearch = new CASearch();

        $caSearchForm = $this->get('form.factory')
            ->createNamed(
                '',
                'ca_search_type',
                $caSearch,
                array(
                    'action' => $this->generateUrl('mc_ca_list'),
                    'method' => 'GET'
                )
            );
        $caSearchForm->handleRequest($request);
        $caSearch = $caSearchForm->getData();
        
        $elasticaManager = $this->container->get('fos_elastica.manager');
        $results = $elasticaManager->getRepository('MCEventBundle:CA')->search($caSearch);

        return $this->render('MCEventBundle:CA:list.html.twig', array(
            'results' => $results,
            'caSearchForm' => $caSearchForm->createView(),
        ));
    }

  public function abonnerAction($id)
    {
      $user = $this->getUser();

      $repository = $this
      ->getDoctrine()
      ->getManager()
      ->getRepository('MCEventBundle:CA');

      $ca = $repository->find($id);

      $user->addCa($ca);
      $ca->addUser($user);
      $em = $this->getDoctrine()->getManager();
        $em->persist($ca);
        $em->flush();

      return $this->render('MCEventBundle:CA:view.html.twig', array(
        'ca' => $ca
      ));
    }

  public function desabonnerAction($id)
    {
      $user = $this->getUser();

      $repository = $this
      ->getDoctrine()
      ->getManager()
      ->getRepository('MCEventBundle:CA');

      $ca = $repository->find($id);

      $user->removeCa($ca);
      $ca->removeUser($user);
        $em = $this->getDoctrine()->getManager();
        $em->persist($ca);
        $em->flush();

      return $this->render('MCEventBundle:CA:view.html.twig', array(
        'ca' => $ca
      ));
    }

}