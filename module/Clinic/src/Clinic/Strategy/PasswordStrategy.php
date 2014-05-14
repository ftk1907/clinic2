<?php
namespace Clinic\Strategy;
use Zend\Stdlib\Hydrator\Strategy\DefaultStrategy;
use Zend\Crypt\Password\Bcrypt;

/**
* Encrypts and decrypts passwords from forms
*/
class PasswordStrategy extends DefaultStrategy
{

    private $_bcrypt;

    public function __construct()
    {
        $this->_bcrypt = new BCrypt();
    }

    /**
     * Encrypt password from feild
     *
     * @return Encrypted password
     **/
    function hydrate($value)
    {
        return $this->_bcrypt->create($value);
    }

    /**
     * Just return the value as it is
     *
     * @return Encrypted password
     **/
    public function extract($value)
    {
        return $value;
    }
}