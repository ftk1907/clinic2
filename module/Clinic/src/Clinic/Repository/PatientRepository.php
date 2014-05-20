<?php
namespace Clinic\Repository;
use Doctrine\ORM\EntityRepository;

class PatientRepository extends EntityRepository
{
    /**
     * gets verified patients
     **/
    public function getVerified()
    {
        return $this->_em->createQuery('SELECT a FROM Clinic\Entity\Patient a WHERE a.verified = 1')
                        ->getResult();
    }

    /**
     * gets verified patients
     **/
    public function getNotVerified()
    {
        return $this->_em->createQuery('SELECT a FROM Clinic\Entity\Patient a WHERE a.verified = 0')
                        ->getResult();
    }
}