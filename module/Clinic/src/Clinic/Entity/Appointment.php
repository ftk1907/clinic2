<?php
namespace Clinic\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/** @ORM\Entity(repositoryClass="Clinic\Repository\AppointmentRepository") */
class Appointment
{
    /** @ORM\Id @ORM\Column(type="integer") @ORM\GeneratedValue */
    protected $id;
    /** @ORM\Column(type="boolean", nullable=true) **/
    protected $confirmed = false;
    /** @ORM\Column(type="datetime", nullable=false) **/
    protected $date;
    /** @ORM\Column(type="boolean", nullable=true) **/
    protected $missed = true;
    /** @ORM\Column(type="string", nullable=true) **/
    protected $complaints;
    /** @ORM\Column(type="string", nullable=true) **/
    protected $patientFeedback;
    /** @ORM\Column(type="string", nullable=true) **/
    protected $doctorFeedback;
    /** @ORM\Column(type="string", nullable=true) **/
    protected $practitionerFeedback;
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

    /**
     * Gets the value of complaints.
     *
     * @return mixed
     */
    public function getComplaints()
    {
        return $this->complaints;
    }

    /**
     * Sets the value of complaints.
     *
     * @param mixed $complaints the complaints
     *
     * @return self
     */
    public function setComplaints($complaints)
    {
        $this->complaints = $complaints;

        return $this;
    }

    /**
     * Gets the value of patientFeedback.
     *
     * @return mixed
     */
    public function getPatientFeedback()
    {
        return $this->patientFeedback;
    }

    /**
     * Sets the value of patientFeedback.
     *
     * @param mixed $patientFeedback the patient feedback
     *
     * @return self
     */
    public function setPatientFeedback($patientFeedback)
    {
        $this->patientFeedback = $patientFeedback;

        return $this;
    }

    /**
     * Gets the value of doctorFeedback.
     *
     * @return mixed
     */
    public function getDoctorFeedback()
    {
        return $this->doctorFeedback;
    }

    /**
     * Sets the value of doctorFeedback.
     *
     * @param mixed $doctorFeedback the doctor feedback
     *
     * @return self
     */
    public function setDoctorFeedback($doctorFeedback)
    {
        $this->doctorFeedback = $doctorFeedback;

        return $this;
    }

    /**
     * Gets the value of practitionerFeedback.
     *
     * @return mixed
     */
    public function getPractitionerFeedback()
    {
        return $this->practitionerFeedback;
    }

    /**
     * Sets the value of practitionerFeedback.
     *
     * @param mixed $practitionerFeedback the practitioner feedback
     *
     * @return self
     */
    public function setPractitionerFeedback($practitionerFeedback)
    {
        $this->practitionerFeedback = $practitionerFeedback;

        return $this;
    }
}