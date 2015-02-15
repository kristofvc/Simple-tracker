<?php

namespace SimpleTracker\AppBundle\Controller;

use SimpleTracker\Project\Project;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($slug)
    {
        $aProject = $this->get('simple_tracker.repository.project')->findOneBy(['slug' => $slug]);
        $formBuilder = $this->createFormBuilder($aProject, [ 'attr' => [ 'class' => 'project-form' ]]);
        $formBuilder->add('name', 'text', [ 'attr' => [ 'class' => 'name' ]]);
        $formBuilder->add('submit', 'submit');
        $form = $formBuilder->getForm();

        return $this->render('SimpleTrackerAppBundle:Default:index.html.twig', [ 'project' => $aProject, 'form' => $form->createView() ]);
    }
}
