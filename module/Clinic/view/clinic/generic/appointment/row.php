<?php
$appointment = $this->appointment;
$id          = $appointment->getId();
$dateObj     = $appointment->getDate();
$date        = [
    'd' => $dateObj->format('d'),
    'm' => $dateObj->format('M'),
    'y' => $dateObj->format('Y'),
    'h' => $dateObj->format('h'),
    'i' => $dateObj->format('i'),
];
$patient        = $appointment->getPatient();
$practitioner   = $appointment->getPractitioner();
$doctor         = $appointment->getDoctor();
$yesIcon        = '<span class="glyphicon glyphicon-ok"></span>';
$noIcon         = '<span class="glyphicon glyphicon-remove"></span>';
$missed         = $appointment->getMissed();
$confirmed      = $appointment->getConfirmed();
$confirmedLabel = '<span class="label label-success">Confirmed</span>';
$visitedLabel   = '<span class="label label-success">Visited</span>';
$missButton     = ($missed)    ? $yesIcon . ' Attend'    : $noIcon  . ' Unattend';
$confirmButton  = ($confirmed) ? $noIcon  . ' Unconfirm' : $yesIcon . ' Confirm';
$missLabel      = ($missed)    ? '' : $visitedLabel;
$confirmLabel   = ($confirmed) ? $confirmedLabel : '';
$confirmUrl     = $this->url('admin', ['controller' => 'appointment', 'action' => 'confirm','id' => $id]);
$visitUrl       = $this->url('admin', ['controller' => 'appointment', 'action' => 'visit',  'id' => $id]);
$profileUrl     = $this->url('admin', ['controller' => 'appointment', 'action' => 'profile','id' => $id]);
$editUrl        = $this->url('admin', ['controller' => 'appointment', 'action' => 'edit',   'id' => $id]);
$deleteUrl      = $this->url('admin', ['controller' => 'appointment', 'action' => 'delete', 'id' => $id]);
$patientUrl =
    $this->url('admin', ['controller' => 'patient', 'action' => 'profile', 'id' => $patient->getId()]);
$doctorUrl  =
    $this->url('admin', ['controller' => 'doctor', 'action' => 'profile',  'id' => $doctor->getId()]);
$practitionerUrl =
    $this->url('admin', ['controller' => 'practitioner','action' => 'profile', 'id' => $practitioner->getId()]);
echo "
<tr>
    <td>{$appointment->getId()}</td>
    <td><strong>{$date['d']} {$date['m']}</strong> {$date['y']}</td>
    <td>{$date['h']}:{$date['i']}</td>
    <td><a href='{$patientUrl}'>{$patient->getName()} {$patient->getSurname()}</a></td>
    <td><a href='{$practitionerUrl}'>{$practitioner->getName()} {$practitioner->getSurname()}</a></td>
    <td><a href='{$doctorUrl}'>{$doctor->getName()} {$doctor->getSurname()}</a></td>
    <td>{$confirmLabel}</td>
    <td>{$missLabel}</td>
    <td align='right'>
        <a class='btn btn-default btn-xs' href='{$visitUrl}'>{$missButton}</a>
        <a class='btn btn-default btn-xs' href='{$confirmUrl}'>{$confirmButton}</a>
        <a class='btn btn-default btn-xs' href='{$profileUrl}'>
            <span class='glyphicon glyphicon-comment'></span>  Feedbacks</a>
        <a class='btn btn-default btn-xs' href='{$editUrl}'>
            <span class='glyphicon glyphicon-edit'></span>  Edit</a>
        <a class='btn btn-default btn-xs' href='{$deleteUrl}'>
            <span class='glyphicon glyphicon-remove'></span>  Delete</a>
    </td>
</tr>
";