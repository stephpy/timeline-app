<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\DemoBundle\Form\Model\Action;
use Acme\DemoBundle\Form\Type\AddActionFormType;
use Acme\DemoBundle\Form\Handler\AddActionFormHandler;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="home")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $form  = $this->createForm(new AddActionFormType(), new Action());

        if ($request->isMethod('POST')) {
            $this->get('acme.timeline.add_action.handler')->handle($form, $request);
        }

        return array(
            'form' => $form->createView(),
        );
    }

    /**
     * @Template()
     */
    public function timelineAction(Request $request)
    {
        $user = $this->get('doctrine.orm.entity_manager')
            ->getRepository('AcmeDemoBundle:User')
            ->findOneByUsername($request->get('subject', 'chuck'));

        if (!$user) {
            return new Response();
        }

        $actionManager   = $this->get('spy_timeline.action_manager');
        $timelineManager = $this->get('spy_timeline.timeline_manager');
        $subject         = $actionManager->findOrCreateComponent($user);
        $timeline        = $timelineManager->getTimeline($subject);

        return array(
            'user'     => $user,
            'timeline' => $timeline,
        );
    }
}
