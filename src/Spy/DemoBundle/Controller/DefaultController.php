<?php
namespace Spy\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Highco\TimelineBundle\Entity\TimelineAction;
use Spy\DemoBundle\Model\User;

/**
 * DefaultController
 *
 * @uses Controller
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class DefaultController extends Controller
{
    /**
     * @Route("/demo/secured/timeline", name="timeline_demo")
     * @Template()
     */
    public function indexAction()
    {
        $user = new User($this->get('security.context')->getToken()->getUser());
        $wall = $this->get('highco.timeline.manager')
                ->getWall(get_class($user), $user->getId());

        return array(
            'wall' => $wall,
        );
    }

    /**
     * @Route("/demo/secured/timeline/add-action", name="timeline_demo_add_action")
     * @Template()
     */
    public function addAction(Request $request)
    {
        $verb = $request->get('verb');
        $cod  = $request->get('cod');
        $coi  = $request->get('coi');

        $user = new User($this->get('security.context')->getToken()->getUser());

        $entry = TimelineAction::create($user, $verb, $cod, $coi);

        $this->get('highco.timeline.manager')->push($entry);

        $this->get('session')->setFlash('success', 'Action added');
        return $this->redirect($this->get('router')->generate('timeline_demo'));
    }
}
