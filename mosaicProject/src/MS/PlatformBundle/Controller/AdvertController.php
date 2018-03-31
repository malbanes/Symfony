<?php

// src/MS/PlatformBundle/Controller/AdvertController.php

namespace MS\PlatformBundle\Controller;

use MS\PlatformBundle\Entity\Advert;
use MS\PlatformBundle\Entity\Image;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse; // N'oubliez pas ce use

class AdvertController extends Controller
{
	public function viewAction($id)
	{
		//recuperer depuis la DB l'article correspondant à l'id
		//Puis on passe l'annonce à la vue.
		// On check le type de requete
		//if ($request->isMethod('GET'))	
		//{
			// On récupère un parametre tag
		//	$tag = $request->query->get('tag');
		//}
		//return new Response("Affichage de l'annonce d'id : ".$id."avec le tag : ".$tag);
		//On utilise le raccourci: il cree un objet reponse
		//return $this->get('templating')->renderResponse(
		//	'MSPlatformBundle:Advert:view.html.twig',
		//	array('id' => $id)
		//);
		//or
		//return $this->render('MSPlatformBundle:Advert:view.html.twig', array('id' => $id));
		//Redirection
		//$url = $this->get('router')->generate('ms_platform_home');
		//return new RedirectResponse($url);
		//ou un qui 'nas pas besoin de l'entete use
		//return $this->redirectToRoute('ms_platform_home');

		//$response->headers->set('Content-Type', 'application/json');

		//Gere les variables SESSIONS

		//$session = $request->getSession();
		//$userId = $session->get('user_id');
		//$session->set('user_id', 91);
		//return new Response("Je suis une page test");
	
		//Squelette app

		
		//return $this->render('MSPlatformBundle:Advert:view.html.twig', array(
		  //'id' => $id
	//	));
	
/*
    $advert = array(

      'title'   => 'Recherche développpeur Symfony2',

      'id'      => $id,

      'author'  => 'Alexandre',

      'content' => 'Nous recherchons un développeur Symfony2 débutant sur Lyon. Blabla…',

      'date'    => new \Datetime()*/
	$repository = $this->getDoctrine()
	  ->getManager()
	  ->getRepository('MSPlatformBundle:Advert')
	;
	$advert = $repository->find($id);
	if ($advert == null) {
		throw new NotFoundHttpException("L'annonce d'id".$id." n'existe pas.");
	}
    	return $this->render('MSPlatformBundle:Advert:view.html.twig', array(

      'advert' => $advert

    ));


	}
	
	public function addAction(Request $request)
	{
	//	$session = $request->getSession();

	/*	$antispam = $this->container->get('ms_platform.antispam');
		if ($request->isMethod('POST')) {
			$text = '...';
			if ($antispam->isSpam($text)) {
				throw new \Exception('Votre message a été détecté comme spam !');
			}
			$session->getFlashBag()->add('notice', 'Annonce bien enregistrée !');
			//$session->getFlashBag()->add('info', 'Oui oui, elle est bien enregistrée !'); 
			return $this->redirectToRoute('ms_platform_view', array('id' => 5));
		}
		$id = 9;
		return $this->render('MSPlatformBundle:Advert:add.html.twig');
	}*/
	
	//Ajout en base de donné

	//creation de l'entité
	$advert = new Advert();
	$advert->setTitle('Recherche dev Database');
	$advert->setAuthor('Alexendre');
	$advert->setContent("Nous recherchons un dev Database sur Lyon");
	//la date et la publication sont défini automatiquement par le constructeur

	$image = new Image();
	$image->setUrl('http://sdz-upload.s3.amazonaws.com/prod/upload/job-de-reve.jpg');
	$image->setAlt('Job de rêve');
	$advert->setImage($image);

	$em = $this->getDoctrine()->getManager();
	$em->persist($advert);
	//$advert2 = $em->getRepository('MSPlatformBundle:Advert')->find(5);
	//$advert2->setDate(new \Datetime());

	$em->flush();

		if ($request->isMethod('POST')) {
			$request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée !');
			return $this->redirect($this->generateUrl('os_platform_view',array('is' => $advert->getId())));
		}
	return $this->render('MSPlatformBundle:Advert:add.html.twig');
	}

	public function editAction($id, Request $request)
	{
		if ($request->isMethod('POST')) {
		$request->getSession()->getFlashBag()->add('notice', 'Annonce bien modifiée.');
		return $this->redirectToRoute('ms_platform_view', array('id' => 5));
		}

		$advert = array(
		  'title' => 'Recherche',
		  'id' => $id,
		  'author' => 'Alex',
		  'content' => 'Blablabla',
		  'date' => new \Datetime()
		);

		return $this->render('MSPlatformBundle:Advert:edit.html.twig', array(
		'advert' => $advert
		));
	}

	public function deleteAction($id)
	{
		return $this->render('MSPlatformBundle:Advert:delete.html.twig');
	}

	public function indexAction($page)
	{
	//	$content = $this->get('templating')->render('MSPlatformBundle:Advert:index.html.twig', array('nom' => 'winzou'
	//		)
	//	);
	//	return new Response($content);

		//Generer une URL
		//$url = $this->get('router')->generate('ms_platform_view', array('id' => 5), true); //true si on doit envoyer pas email
		//return new Response("L'URL de l'annonce d'id 5 est: ".$url);
		//Generer rapidement:
		//$url = $this->generateUrl('ms_platform_home');
	


		//squelette apli

		if ($page < 1) {
		   throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
		   return $this->render('MSPlatformBundle:Advert:index.html.twig');
		}
	//	return $this->render('MSPlatformBundle:Advert:index.html.twig');
		return $this->render('MSPlatformBundle:Advert:index.html.twig', array(
		'listAdverts' => array()
		));
	}

	public function viewSlugAction($slug, $year, $_format, $_locale)
	{
		return new Response(
			"On pourrait afficher l'annonce slug'".$slug."', crée en ".$year." et au format ".$_format."."
		);
	}

	public function sendemailAction(){
		$contenu = $this->renderView('MSPlatformBundle:Advert:email.txt.twig', array(
		'var1' => $var1,
		'var2' => $var2
		));
		
		mail('support@mosaic-selfi.com', 'Inscription OK', $contenu);

		$mailer = $this->container->get('mailer');
		
		return $this->render('MSPlatformBundle:Advert:index.html.twig', array('id' => 5));

	}

	public function menuAction()
	{
		//recuperer a partir de la BDD
		$listAdverts = array(
		  array('id' => 2, 'title' => 'Recherche dév Symfony2'),
		  array('id' => 5, 'title' => 'Mission Webmaster'),
		  array('id' => 9, 'title' => 'Stage PHP')
		);

		return $this->render('MSPlatformBundle:Advert:menu.html.twig', array(
		  'listAdverts' => $listAdverts
		));
	}


}
