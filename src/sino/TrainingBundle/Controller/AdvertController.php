<?php

// src/sino/TrainingBundle/Controller/AdvertController.php

namespace sino\TrainingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\component\HttpFoundation\Response;

class AdvertController extends Controller
{
	public function indexAction()
	{
		$url = $this->generateUrl(
			'sino_training_view',
			array('id'=>7),
			true
			);
		$content = $this
			->get('templating')
			->render('sinoTrainingBundle:Advert:index.html.twig', array(
				'nom'=>'ta maman',
				'prenom'=>'Annabi',
				'age'=>'vingt', 
				'url'=>$url
				)
		);
		return new Response($content);
	}
	
	public function viewAction($id)
	{
		return new Response("Affichage de l'annonce d'id : " .$id);
	}
	public function viewSlugAction($year, $slug, $format)
	{
		return new Response("On pourrait afficher l'annonce correspondant au
            slug '".$slug."', créée en ".$year." et au format ".$format.".");
	}
}