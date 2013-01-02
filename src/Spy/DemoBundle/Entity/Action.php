<?php

namespace Spy\DemoBundle\Entity;

use Spy\TimelineBundle\Entity\Action as BaseAction;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="spy_timeline_action")
 */
class Action extends BaseAction
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="ActionComponent", mappedBy="action", cascade={"persist"})
     */
    protected $actionComponents;

    /**
     * @ORM\OneToMany(targetEntity="Timeline", mappedBy="action")
     */
    protected $timelines;
}
