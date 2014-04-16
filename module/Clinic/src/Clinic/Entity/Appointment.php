<?php
namespace Clinic\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 **/
class Appointment
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     **/
    protected $id;
    /** @ORM\Column(type="boolean", nullable=true) **/
    protected $confirmed = false;
    /** @ORM\Column(type="datetime", nullable=false) **/
    protected $date;
    /** @ORM\Column(type="boolean", nullable=true) **/
    protected $missed = true;
    /**
     * @ORM\JoinColumn(name="doctor", referencedColumnName="id", nullable=false)
     * @ORM\ManyToOne(targetEntity="Doctor", inversedBy="appointments")
     **/
    protected $doctor;
    /**
     * @ORM\JoinColumn(name="practitioner", referencedColumnName="id", nullable=true)
     * @ORM\ManyToOne(targetEntity="Practitioner", inversedBy="appointments")
     **/
    protected $practitioner;
    /**
     * @ORM\JoinColumn(name="patient", referencedColumnName="id", nullable=false)
     * @ORM\ManyToOne(targetEntity="Patient", inversedBy="appointments")
     **/
    protected $patient;

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
     * Gets the value of confirmed.
     *
     * @return mixed
     */
    public function getConfirmed()
    {
        return $this->confirmed;
    }

    /**
     * Sets the value of confirmed.
     *
     * @param mixed $confirmed the confirmed
     *
     * @return self
     */
    public function setConfirmed($confirmed)
    {
        $this->confirmed = $confirmed;

        return $this;
    }

    /**
     * Gets the value of date.
     *
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Sets the value of date.
     *
     * @param mixed $date the date
     *
     * @return self
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Gets the value of missed.
     *
     * @return mixed
     */
    public function getMissed()
    {
        return $this->missed;
    }

    /**
     * Sets the value of missed.
     *
     * @param mixed $missed the missed
     *
     * @return self
     */
    public function setMissed($missed)
    {
        $this->missed = $missed;

        return $this;
    }

    /**
     * Gets the value of doctor.
     *
     * @return mixed
     */
    public function getDoctor()
    {
        return $this->doctor;
    }

    /**
     * Sets the value of doctor.
     *
     * @param mixed $doctor the doctor
     *
     * @return self
     */
    public function setDoctor($doctor)
    {
        $this->doctor = $doctor;

        return $this;
    }

    /**
     * Gets the value of practitioner.
     *
     * @return mixed
     */
    public function getPractitioner()
    {
        return $this->practitioner;
    }

    /**
     * Sets the value of practitioner.
     *
     * @param mixed $practitioner the practitioner
     *
     * @return self
     */
    public function setPractitioner($practitioner)
    {
        $this->practitioner = $practitioner;

        return $this;
    }

    /**
     * Gets the value of patient.
     *
     * @return mixed
     */
    public function getPatient()
    {
        return $this->patient;
    }

    /**
     * Sets the value of patient.
     *
     * @param mixed $patient the patient
     *
     * @return self
     */
    public function setPatient($patient)
    {
        $this->patient = $patient;

        return $this;
    }
}