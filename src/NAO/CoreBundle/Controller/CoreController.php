<?php

namespace NAO\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use NAO\CoreBundle\Entity\Species;
use NAO\CoreBundle\Form\Type\SpeciesType;
use NAO\CoreBundle\Entity\Observation;
use NAO\CoreBundle\Form\Type\ObservationType;

class CoreController extends Controller
{
    public function indexAction(Request $request)
    {
        // Création du formulaire
        $observation = new Observation();
        $form = $this->createForm(SpeciesType::class, $observation);

        // Traitement du formulaire
        $speciesInfos = [];
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $species = $form->get('species')->getData();
            $speciesInfos = $em->getRepository('NAOCoreBundle:Species')->findBy(array('id' => $species->getId()));
        }

        // Affichage de la vue
        return $this->render('NAOCoreBundle:Core:index.html.twig', array(
            'form' => $form->createView(),
            'speciesInfos' => $speciesInfos
        ));
    }

    public function observationAction(Request $request)
    {
        // Création du formulaire
        $observation = new Observation();
        $form = $this->createForm(ObservationType::class, $observation);

        // Traitement du formulaire
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

        }

        // Affichage de la vue
        return $this->render('NAOCoreBundle:Core:observation.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function aboutAction()
    {
        // Affichage de la vue
        return $this->render('NAOCoreBundle:Core:about.html.twig');
    }

    public function contactAction()
    {
        // Affichage de la vue
        return $this->render('NAOCoreBundle:Core:contact.html.twig');
    }
}
