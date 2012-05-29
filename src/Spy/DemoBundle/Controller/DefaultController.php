<?php
namespace Spy\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

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
        $user = $this->get('security.context')->getToken()->getUser();
        $wall = $this->get('highco.timeline.manager')
                ->getWall(get_class($user), $user->getUsername());

        return array(
            'wall' => $wall,
        );
    }
}
