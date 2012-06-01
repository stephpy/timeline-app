<?php
namespace Spy\DemoBundle\Timeline;

use Highco\TimelineBundle\Spread\SpreadInterface;
use Highco\TimelineBundle\Spread\Entry\EntryCollection;
use Highco\TimelineBundle\Spread\Entry\Entry;
use Highco\TimelineBundle\Model\TimelineAction;

/**
 * Spread
 *
 * @uses SpreadInterface
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class Spread implements SpreadInterface
{
    CONST USER_CLASS = "\Spy\DemoBundle\Model\User";
    /**
     * {@inheritdoc}
     */
    public function supports(TimelineAction $timelineAction)
    {
        $subject = $timelineAction->getSubject();
        return $subject instanceof \Spy\DemoBundle\Model\User;
    }

    public function process(TimelineAction $timelineAction, EntryCollection $coll)
    {
        $entries = array();

        switch ($timelineAction->getSubject()->getUsername()) {
            case 'chuck':
                $entries[] = Entry::create(self::USER_CLASS, 2); // steven
                $entries[] = Entry::create(self::USER_CLASS, 3); // vic
                $entries[] = Entry::create(self::USER_CLASS, 4); // jack
                $entries[] = Entry::create(self::USER_CLASS, 5); // walter
                break;
            case 'steven':
                $entries[] = Entry::create(self::USER_CLASS, 1); // chuck
                $entries[] = Entry::create(self::USER_CLASS, 2); // steven
                $entries[] = Entry::create(self::USER_CLASS, 3); // vic
                $entries[] = Entry::create(self::USER_CLASS, 4); // jack
                $entries[] = Entry::create(self::USER_CLASS, 5); // walter
                break;
            case 'vic':
                $entries[] = Entry::create(self::USER_CLASS, 1); // chuck
                $entries[] = Entry::create(self::USER_CLASS, 5); // walter
                break;
            case 'jack':
                $entries[] = Entry::create(self::USER_CLASS, 1); // chuck
                $entries[] = Entry::create(self::USER_CLASS, 3); // vic
                $entries[] = Entry::create(self::USER_CLASS, 5); // walter
                break;
            case 'walter':
                $entries[] = Entry::create(self::USER_CLASS, 1); // chuck
                $entries[] = Entry::create(self::USER_CLASS, 3); // vic
                $entries[] = Entry::create(self::USER_CLASS, 4); // jack
                break;
            default:
                throw new \Exception('If you add user, look at spread ;)');
                break;
        }

        foreach ($entries as $entry) {
            $coll->set('GLOBAL', $entry);
        }
    }
}
