<?php

namespace OC\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


class HomeController extends Controller
{
    public function indexAction()
    {
        
        $adverts = array(
      array(
        'title'   => 'Recherche développpeur Symfony',
        'id'      => 1,
        'author'  => 'Alexandre',
        'content' => 'Nous recherchons un développeur Symfony débutant sur Lyon. Blabla…',
        'date'    => new \Datetime()),
      array(
        'title'   => 'Mission de webmaster',
        'id'      => 2,
        'author'  => 'Hugo',
        'content' => 'Nous recherchons un webmaster capable de maintenir notre site internet. Blabla…',
        'date'    => new \Datetime()),
      array(
        'title'   => 'Offre de stage webdesigner',
        'id'      => 3,
        'author'  => 'Mathieu',
        'content' => 'Nous proposons un poste pour webdesigner. Blabla…',
        'date'    => new \Datetime())
    );
        // array qui va contenir nos 3 derniers adverts
        $lastsAdverts = array();
        
        // ID minimum de l'article pour être dans les 3 derniers.
        $idLimit = count($adverts)-2;
        foreach($adverts as $advert)
        {
            // si l'id de l'article est supérieur au planché ID alors on ajoute adverts dans le tableau lasts.
            if ($advert['id'] >= $idLimit)
            {
               array_push($lastsAdverts, $advert); 
            }
            
        }

        return $this->render('OCCoreBundle:Home:index.html.twig', array ('lastsAdverts' => $lastsAdverts));
    }
    
    public function contactAction(Request $request)
    {
        $session = $request->getSession();
        
        $session->getFlashBag()->add('info','La page de contact sera bientôt disponible, merci de revenir plus tard');
        
        return $this->redirectToRoute('oc_core_homepage');
    }
}
