<?php
namespace Clinic\Strategy;
use Zend\Stdlib\Hydrator\Strategy\DefaultStrategy;
use Zend\Crypt\Password\Bcrypt;

/**
* Encrypts and decrypts passwords from forms
*/
class PasswordStrategy extends DefaultStrategy
{
    /**
     * Encrypt password from field
     *
     * @return Encrypted password
     **/
    function hydrate($value)
    {
        $bcrypt = new BCrypt();
        return $bcrypt->create($value);
    }
}