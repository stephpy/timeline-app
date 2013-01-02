<?php

namespace Spy\DemoBundle\Spread;

use Spy\Timeline\Spread\SpreadInterface;
use Spy\Timeline\Model\ActionInterface;
use Spy\Timeline\Spread\Entry\EntryCollection;
use Spy\Timeline\Spread\Entry\EntryUnaware;

/**
 * Spread
 *
 * @uses SpreadInterface
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class Spread implements SpreadInterface
{
    /**
     * {@inheritdoc}
     */
    public function supports(ActionInterface $action)
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function process(ActionInterface $action, EntryCollection $coll)
    {
        $coll->add(new EntryUnaware('model', array('1', '2')));
        $coll->add(new EntryUnaware('model2', array('1')));
        $coll->add(new EntryUnaware('othermodel', 'aodadoa'));
    }
}
