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

    public $username;

    /**
     * @param mixed $user user
     */
    public function __construct($user)
    {
        if ($user instanceof CoreUser) {
            $this->username = $user->getUserName();
        } else {
            $this->username = $user;
        }
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->username;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return array_search($this->getUsername(), self::$listUsers);
    }

    /**
     * @return string
     */
    public function getUserName()
    {
        return $this->username;
    }

    /**
     * @param integer $id id
     *
     * @return User|null
     */
    static public function find($id)
    {
        if (!isset(self::$listUsers[$id])) {

            return null;
        }

        return new self(self::$listUsers[$id]);
    }
}
