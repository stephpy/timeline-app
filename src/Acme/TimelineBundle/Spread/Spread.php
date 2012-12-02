<?php

namespace Acme\TimelineBundle\Spread;

use Spy\TimelineBundle\Spread\SpreadInterface;
use Spy\TimelineBundle\Model\ActionInterface;
use Spy\TimelineBundle\Spread\Entry\EntryCollection;
use Spy\TimelineBundle\Spread\Entry\EntryUnaware;

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
        $coll->add(new EntryUnaware('model', array('1', '2')));
        $coll->add(new EntryUnaware('some\othermodel', 1));
        $coll->add(new EntryUnaware('othermodel', 'aodadoa'));
    }
}
