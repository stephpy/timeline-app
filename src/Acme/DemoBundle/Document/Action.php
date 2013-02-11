<?php

namespace Acme\DemoBundle\Document;

use Spy\TimelineBundle\Document\Action as BaseAction;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * @ODM\Document
 */
class Action extends BaseAction
{
    /**
     * @ODM\Id
     */
    protected $id;

    /**
     * @ODM\ReferenceMany(targetDocument="ActionComponent", cascade={"all"})
     */
    protected $actionComponents;

    /**
     * @ODM\ReferenceOne(targetDocument="Component")
     */
    protected $subject;
}
