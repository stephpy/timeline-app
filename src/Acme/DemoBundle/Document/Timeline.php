<?php

namespace Acme\DemoBundle\Document;

use Spy\TimelineBundle\Document\Timeline as BaseTimeline;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * @ODM\Document
 */
class Timeline extends BaseTimeline
{
    /**
     * @ODM\Id
     */
    protected $id;

    /**
     * @ODM\ReferenceOne(targetDocument="Action", cascade={"all"})
     */
    protected $action;

    /**
     * @ODM\ReferenceOne(targetDocument="Component", cascade={"all"})
     */
    protected $subject;

    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }
}
