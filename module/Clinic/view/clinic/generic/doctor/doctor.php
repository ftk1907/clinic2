<?php $doctor = $this->doctor;
    $profileUrl = $this->url('admin', [
        'controller' => 'doctor','action' => 'profile','id' => $doctor->getId()
    ]);
    $editUrl = $this->url('admin', [
        'controller' => 'doctor', 'action' => 'edit', 'id' => $doctor->getId()
    ]);
    $deleteUrl = $this->url('admin', [
        'controller' => 'doctor', 'action' => 'delete', 'id' => $doctor->getId()
    ]);
?>
<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <img src="http://placehold.it/400x300" alt="...">
        <div class="caption">
            <h3>Dr. <?="{$doctor->getName()} {$doctor->getSurname()}"?></h3>
            <table class="table">
            <tr>
                <td><span class="label label-default">Joined:</span></td>
                <td><?= $doctor->getJoined()->format('d M Y') ?></td>
            </tr>
            <tr>
                <td colspan="2">
                    <a class="btn btn-default btn-xs" href="<?= $profileUrl ?>#practitioners">
                        <span class="glyphicon glyphicon-list"></span>
                        <span class="label label-info"><?= $doctor->getPractitioners()->count() ?></span>
                        Practitioners </a>
                    <a class="btn btn-default btn-xs" href="<?= $profileUrl ?>#appointments">
                        <span class="glyphicon glyphicon-calendar"></span>
                        <span class="label label-warning"><?= count($doctor->getAppointments()) ?></span>
                        Appointments </a>
                    <a class="btn btn-default btn-xs" href="<?= $profileUrl ?>">
                        <span class="glyphicon glyphicon-list-alt"></span>  Profile</a>
                    <a class="btn btn-default btn-xs" href="mailto:<?= $doctor->getEmail() ?>">
                        <span class="glyphicon glyphicon-envelope"></span> Email</a>
                    <a class="btn btn-default btn-xs" href="<?= $editUrl ?>">
                        <span class="glyphicon glyphicon-edit"></span>  Edit</a>
                    <a class="btn btn-default btn-xs" href="<?= $deleteUrl ?>">
                        <span class="glyphicon glyphicon-remove"></span>  Delete</a>
                </td>
            </tr>
            </table>
        </div>
    </div>
</div>