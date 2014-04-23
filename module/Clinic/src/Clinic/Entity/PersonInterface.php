<?php
namespace Clinic\Entity;

/** @ORM\MappedSuperClass */
class PersonInterface
{
    protected function getId();
    protected function getEmail();
    protected function getName();
    protected function getSurname();
    protected function getJoined();
    protected function getPassword();
    protected function getAppointments();
    protected function getAppointments(DateTime $fromDate, DateTime $toDate);
    protected function getAppointments(DateTime $date);
}