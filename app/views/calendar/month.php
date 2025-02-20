<?php require APPROOT . '/Views/templates/header.php'; ?>
<?php require_once APPROOT . '/Helpers/DateHelper.php'; ?>
<div class="row mb-4">
    <div class="col-md-6">
        <h1><?php echo DateHelper::getMonthName($data['month']); ?> <?php echo $data['year']; ?></h1>
    </div>
    <div class="col-md-6 text-end">
        <a href="<?php echo URLROOT; ?>/calendar" class="btn btn-outline-secondary">Volver al Calendario</a>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <h2>Eventos de este mes</h2>
        <?php if(empty($data['events'])): ?>
            <p>No hay eventos programados para este mes.</p>
        <?php else: ?>
            <div class="list-group">
                <?php foreach($data['events'] as $event): ?>
                    <div class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1"><?php echo $event->title; ?></h5>
                            <small><?php echo date('d/m/Y', strtotime($event->date)); ?></small>
                        </div>
                        <p class="mb-1"><?php echo $event->description; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php require APPROOT . '/Views/templates/footer.php'; ?>