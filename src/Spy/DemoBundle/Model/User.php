<?php
namespace Spy\DemoBundle\Model;

use Symfony\Component\Security\Core\User\User as CoreUser;
/**
 * User
 *
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class User
{
    /**
     * Crappy method to have a getId for user model.
     */
    protected static $listUsers = array(
        1 => 'chuck',
        2 => 'steven',
        3 => 'vic',
        4 => 'jack',
        5 => 'walter',
    );

    public $user;

    /**
     * @param CoreUser $user user
     */
    public function __construct(CoreUser $user)
    {
        $this->user = $user;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return array_search($this->user->getUsername(), self::$listUsers);
    }

    /**
     * @return string
     */
    public function getUserName()
    {
        return $this->user->getUserName();
    }
}
