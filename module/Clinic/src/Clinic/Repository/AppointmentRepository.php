<?php
namespace Clinic\Repository;
use Doctrine\ORM\EntityRepository;

class AppointmentRepository extends EntityRepository
{
    /**
     * get appointments that have been visited
     * @return
     **/
    public function getToday()
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('a')
            ->from('Clinic\Entity\Appointment', 'a')
            ->where('a.confirmed = 1')
            ->andWhere('a.date >= :today')
            ->andWhere('a.date <= :tomorrow')
            ->orderBy('a.date')
            ->setParameter('today', new \DateTime("today"))
            ->setParameter('tomorrow', new \DateTime("tomorrow"));
        $query = $qb->getQuery();
        return $query->getResult();
    }

    /**
     * get appointments that have been visited
     * @return
     **/
    public function getVisited()
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('a')
            ->from('Clinic\Entity\Appointment', 'a')
            ->where('a.missed = 0')
            ->orderBy('a.date', 'DESC');
        $query = $qb->getQuery();
        return $query->getResult();
    }

    /**
     * get appointments that have been missed
     * @return
     **/
    public function getMissed()
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('a')
            ->from('Clinic\Entity\Appointment', 'a')
            ->where('a.missed = 1')
            ->andWhere('a.date <= :now')
            ->orderBy('a.date', 'DESC')
            ->setParameter('now', new \DateTime("now"));
        $query = $qb->getQuery();
        return $query->getResult();
    }

    /**
     * get confirmed appointments
     * @return
     **/
    public function getConfirmed()
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('a')
            ->from('Clinic\Entity\Appointment', 'a')
            ->where('a.confirmed = 1')
            ->orderBy('a.date', 'DESC');
            $query = $qb->getQuery();
        $query = $qb->getQuery();
        return $query->getResult();
    }

    /**
     * get unconfirmed appointments
     * @return
     **/
    public function getUnconfirmed()
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('a')
            ->from('Clinic\Entity\Appointment', 'a')
            ->where('a.confirmed = 0')
            ->orderBy('a.date', 'DESC');
        $query = $qb->getQuery();
        return $query->getResult();
    }
}