<?php
namespace Clinic\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

/** @ORM\Entity */
class Patient implements PersonInterface
{
    /** @ORM\Id @ORM\Column(type="integer") @ORM\GeneratedValue */
    protected $id;
    /** @ORM\Column(type="string", unique=true, nullable=false) */
    protected $email;
    /** @ORM\Column(type="string", nullable=false)  */
    protected $name;
    /** @ORM\Column(type="string", nullable=false) */
    protected $surname;
    /** @ORM\Column(type="datetime", nullable=false) */
    protected $joined;
    /** @ORM\Column(type="string", nullable=false) */
    protected $password;
    /** @ORM\Column(type="boolean", nullable=false) */
    protected $verified;
    /** @ORM\OneToMany(targetEntity="Appointment", mappedBy="patient") */
    protected $appointments;

    public function __construct()
    {
        $this->verified = 0;
        $this->joined   = new \DateTime("Now");
        $this->appointments = new ArrayCollection();
    }

    // Getters and Setters

    /**
     * Gets the value of id.
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the value of id.
     *
     * @param mixed $id the id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Gets the value of email.
     *
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Sets the value of email.
     *
     * @param mixed $email the email
     *
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Gets the value of name.
     *
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the value of name.
     *
     * @param mixed $name the name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Gets the value of surname.
     *
     * @return mixed
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Sets the value of surname.
     *
     * @param mixed $surname the surname
     *
     * @return self
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Gets the value of joined.
     *
     * @return mixed
     */
    public function getJoined()
    {
        return $this->joined;
    }

    /**
     * Sets the value of joined.
     *
     * @param mixed $joined the joined
     *
     * @return self
     */
    public function setJoined($joined)
    {
        $this->joined = $joined;

        return $this;
    }

    /**
     * Gets the value of password.
     *
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Sets the value of password.
     *
     * @param mixed $password the password
     *
     * @return self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Gets the value of verified.
     *
     * @return mixed
     */
    public function getVerified()
    {
        return $this->verified;
    }

    /**
     * Sets the value of verified.
     *
     * @param mixed $verified the verified
     *
     * @return self
     */
    public function setVerified($verified)
    {
        $this->verified = $verified;

        return $this;
    }

    /**
     * Gets the value of appointments.
     *
     * @return mixed
     */
    public function getAppointments($from = null, $to = null)
    {
        $appointments = $this->appointments;

        if($from instanceof \DateTime && $to instanceof \DateTime) {
            $criteria = Criteria::create()
                ->where(Criteria::expr()->gte('date', $from))
                ->andWhere(Criteria::expr()->lte('date', $to))
            ;
            $appointments = $appointments->matching($criteria);
        }

        return $appointments->toArray();

        // if(!is_string($period)) {
        //     return $appointments;
        // }

        // switch($period){
        //     case 'today':
        //         $from  = new \DateTime('today');
        //         $to    = new \DateTime('tomorrow');
        //         break;
        //     case 'tomorrow':
        //         $from     = new \DateTime('tomorrow');
        //         $interval = new \DateInterval('1 days');
        //         $to       = new \DateTime('tomorrow')->add($interval);
        //         break;
        //     case 'this month':
        //         $from     = new \DateTime('this month');
        //         $tomorrow = new \DateTime('next month');
        //         break;
        //     default:
        //         return $appointments;
        // }
    }

    /**
     * Sets the value of appointments.
     *
     * @param mixed $appointments the appointments
     *
     * @return self
     */
    public function setAppointments($appointments)
    {
        $this->appointments = $appointments;

        return $this;
    }
} // END public class Patients