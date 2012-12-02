<?php

namespace Spy\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/demo/secured/timeline", name="timeline_demo")
     * @Template()
     */
    public function indexAction()
    {
        $user            = $this->fetchUser();

        $timelineManager = $this->get('spy_timeline.timeline_manager');
        $actionManager   = $this->get('spy_timeline.action_manager');

        $subject  = $actionManager->findOrCreateComponent($user);
        $timeline = $timelineManager->getTimeline($subject);

        return array(
            'timeline' => $timeline,
        );
    }

    /**
     * @Route("/demo/secured/timeline/add-action", name="timeline_demo_add_action")
     * @Template()
     */
    public function addAction(Request $request)
    {
        exit('ici');
        $verb = $request->get('verb');
        $cod  = $request->get('cod');
        $coi  = $request->get('coi');

        $user = new User($this->get('security.context')->getToken()->getUser());

        $entry = TimelineAction::create($user, $verb, $cod, $coi);

        $this->get('highco.timeline.manager')->push($entry);

        $this->get('session')->setFlash('success', 'Action added');
        return $this->redirect($this->get('router')->generate('timeline_demo'));
    }

    protected function fetchUser()
    {
        $user     = $this->get('security.context')->getToken()->getUser();

        return $this->get('doctrine.orm.entity_manager')
            ->getRepository('SpyDemoBundle:User')
            ->createQueryBuilder('u')
            ->where('u.username = :username')
            ->setParameter('username', $user->getUsername())
            ->getQuery()
            ->getSingleResult();
    }
}
