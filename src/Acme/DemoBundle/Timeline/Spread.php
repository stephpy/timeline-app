<?php

namespace Acme\DemoBundle\Timeline;

use Spy\Timeline\Spread\SpreadInterface;
use Spy\Timeline\Model\ActionInterface;
use Spy\Timeline\Spread\Entry\EntryCollection;
use Spy\Timeline\Spread\Entry\EntryUnaware;
use Spy\Timeline\Spread\Entry\Entry;
use Acme\DemoBundle\Entity\Car;
use Acme\DemoBundle\Entity\User;

/**
 * Spread
 *
 * @uses SpreadInterface
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class Spread implements SpreadInterface
{
    CONST USER_CLASS = 'Acme\DemoBundle\Entity\User';
    CONST CAR_CLASS = 'Acme\DemoBundle\Entity\User';

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
        $chuck  = new EntryUnaware(self::USER_CLASS, 1);
        $vic    = new EntryUnaware(self::USER_CLASS, 2);
        $walter = new EntryUnaware(self::USER_CLASS, 3);

        $coll->add($chuck); // chuck is added becase he's aware of ALL

        $subject    = $action->getSubject();
        $complement = $action->getComponent('complement');
        if (is_object($complement) && $complement->getModel() == self::USER_CLASS) {
            $coll->add(new Entry($complement));
        }

        if ($this->walterIsInAction($action) || $this->isKick($action) || $this->isCook($action)) {
            // if vic is subject, does not show ...
            if (!($subject->getModel() == self::USER_CLASS && $subject->getIdentifier() == 2)) {
                $coll->add($vic);
            }
        }

        if ($this->vicIsInAction($action) || $this->hasCar($action) || $this->isDrive($action) || $this->isCook($action)) {
            // if walter is subject, does not show ...
            if (!($subject->getModel() == self::USER_CLASS && $subject->getIdentifier() == 3)) {
                $coll->add($walter);
            }
        }
    }

    protected function hasCar($action)
    {
        $subject    = $action->getSubject();
        $complement = $action->getComponent('complement');

        return $subject->getModel() == self::CAR_CLASS || (is_object($complement) && $complement->getModel() == self::CAR_CLASS);
    }

    public function vicIsInAction($action)
    {
        $subject    = $action->getSubject();
        $complement = $action->getComponent('complement');

        return ($subject->getModel() == self::USER_CLASS && $subject->getIdentifier() == 2) ||
            (is_object($complement) && $complement->getModel() == self::USER_CLASS && $complement->getIdentifier() == 2);

    }

    public function walterIsInAction($action)
    {
        $subject    = $action->getSubject();
        $complement = $action->getComponent('complement');

        return ($subject->getModel() == self::USER_CLASS && $subject->getIdentifier() == 3) ||
            (is_object($complement) && $complement->getModel() == self::USER_CLASS && $complement->getIdentifier() == 3);
    }

    public function isDrive($action)
    {
        return $action->getVerb() == 'drive';
    }

    public function isKick($action)
    {
        return $action->getVerb() == 'kick';
    }

    public function isCook($action)
    {
        return $action->getVerb() == 'cook';
    }
}
