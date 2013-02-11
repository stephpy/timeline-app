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
    CONST USER_CLASS = 'Acme\DemoBundle\Document\User';
    CONST CAR_CLASS = 'Acme\DemoBundle\Document\Car';

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
        $chuck  = new EntryUnaware(self::USER_CLASS, '5111a4f4531e17820b000000');
        $vic    = new EntryUnaware(self::USER_CLASS, '5111a502531e17a418000000');
        $walter = new EntryUnaware(self::USER_CLASS, '5111a510531e17e60c000000');

        $coll->add($chuck); // chuck is added becase he's aware of ALL

        $subject    = $action->getSubject();
        $complement = $action->getComponent('complement');
        if (is_object($complement) && $complement->getModel() == self::USER_CLASS) {
            $coll->add(new Entry($complement));
        }

        if ($this->walterIsInAction($action) || $this->isKick($action) || $this->isCook($action)) {
            // if vic is subject, does not show ...
            if (!($subject->getModel() == self::USER_CLASS && $subject->getIdentifier() == 'vic')) {
                $coll->add($vic);
            }
        }

        if ($this->vicIsInAction($action) || $this->hasCar($action) || $this->isDrive($action) || $this->isCook($action)) {
            // if walter is subject, does not show ...
            if (!($subject->getModel() == self::USER_CLASS && $subject->getIdentifier() == 'walter')) {
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

        return ($subject->getModel() == self::USER_CLASS && $subject->getIdentifier() == 'vic') ||
            (is_object($complement) && $complement->getModel() == self::USER_CLASS && $complement->getIdentifier() == 'vic');

    }

    public function walterIsInAction($action)
    {
        $subject    = $action->getSubject();
        $complement = $action->getComponent('complement');

        return ($subject->getModel() == self::USER_CLASS && $subject->getIdentifier() == 'walter') ||
            (is_object($complement) && $complement->getModel() == self::USER_CLASS && $complement->getIdentifier() == 'walter');
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
