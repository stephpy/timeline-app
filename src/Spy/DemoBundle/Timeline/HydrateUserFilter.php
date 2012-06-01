<?php
namespace Spy\DemoBundle\Timeline;

use Highco\TimelineBundle\Filter\FilterInterface;
use Spy\DemoBundle\Model\User;

/**
 * HydrateUserFilter
 *
 * @uses FilterInterface
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class HydrateUserFilter implements FilterInterface
{
    /**
     * filter
     *
     * @param mixed $results results
     *
     * @return void
     */
    public function filter($results)
    {
        foreach ($results as $result) {
            $result->setSubject(User::find($result->getSubjectId()));
        }

        return $results;
    }
}
