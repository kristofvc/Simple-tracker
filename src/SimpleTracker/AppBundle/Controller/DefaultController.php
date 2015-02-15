<?php

namespace SimpleTracker\AppBundle\Controller;

use SimpleTracker\Project\Project;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($slug)
    {
        return $this->render('SimpleTrackerAppBundle:Default:index.html.twig', [ ]);
    }
}
