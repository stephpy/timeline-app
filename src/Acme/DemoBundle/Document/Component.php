<?php

namespace Acme\DemoBundle\Document;

use Spy\TimelineBundle\Document\Component as BaseComponent;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * @ODM\Document
 */
class Component extends BaseComponent
{
    /**
     * @ODM\Id
     */
    protected $id;
}
