<?php
namespace Clinic\Entity;

interface PersonInterface
{
    function getId();
    function getEmail();
    function getName();
    function getSurname();
    function getJoined();
    function getPassword();
    function getAppointments($from, $to);
}