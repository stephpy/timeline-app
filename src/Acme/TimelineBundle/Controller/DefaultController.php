<?php

namespace Acme\TimelineBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $steph = $this->getDoctrine()
            ->getRepository('AcmeDemoBundle:User')
            ->find(1);

        $car = $this->getDoctrine()
            ->getRepository('AcmeDemoBundle:Car')
            ->find(array('brand' => 'alfa', 'model' => 159));

        $actionManager = $this->get('spy_timeline.action_manager');
        $subject       = $actionManager->findOrCreateComponent($car);
        /*$cod           = $actionManager->findOrCreateComponent($steph);
        $coi           = $actionManager->findOrCreateComponent('Acme\DemoBundle\Entity\User', 2);

        $action        = $actionManager->create($subject, 'verb', array('directComplement' => $cod, 'indirectComplement' => $coi));
        $actionManager->updateAction($action);

        exit('oula');*/

        $timelineManager = $this->get('spy_timeline.timeline_manager');
        $timeline        = $timelineManager->getTimeline($subject);

        return $this->render('AcmeTimelineBundle:Default:index.html.twig', array(
            'timeline' => $timeline,
        ));
    }
}
