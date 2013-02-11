<?php

namespace Acme\DemoBundle\Document;

use Spy\TimelineBundle\Document\ActionComponent as BaseActionComponent;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * @ODM\Document
 */
class ActionComponent extends BaseActionComponent
{
    /**
     * @ODM\Id
     */
    protected $id;

    /**
     * @ODM\ReferenceOne(targetDocument="Action")
     */
    protected $action;

    /**
     * @ODM\ReferenceOne(targetDocument="Component")
     */
    protected $component;
}
