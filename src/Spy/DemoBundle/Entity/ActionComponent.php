<?php

namespace Spy\DemoBundle\Entity;

use Spy\TimelineBundle\Entity\ActionComponent as BaseActionComponent;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="spy_timeline_action_component")
 */
class ActionComponent extends BaseActionComponent
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Spy\DemoBundle\Entity\Action")
     * @ORM\JoinColumn(name="action_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $action;

    /**
     * @ORM\ManyToOne(targetEntity="Spy\DemoBundle\Entity\Component")
     * @ORM\JoinColumn(name="component_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $component;
}
