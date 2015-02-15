<?php

namespace SimpleTracker\AppBundle\Controller;

use SimpleTracker\Project\Project;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request, $slug)
    {
        $aProject = $this->get('simple_tracker.repository.project')->findOneBy(['slug' => $slug]);
        if (!$aProject) {
            throw $this->createNotFoundException();
        }

        $formBuilder = $this->createFormBuilder($aProject, [ 'attr' => [ 'class' => 'project-form' ]]);
        $formBuilder->add('name', 'text', [ 'attr' => [ 'class' => 'name' ]]);
        $formBuilder->add('submit', 'submit');
        $form = $formBuilder->getForm();

        $form->handleRequest($request);
        if ($request->getMethod() == 'POST') {
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($aProject);
                $em->flush();
            }
        }

        return $this->render('SimpleTrackerAppBundle:Default:index.html.twig', [ 'project' => $aProject, 'form' => $form->createView() ]);
    }
}
