<?php require APPROOT . '/Views/templates/header.php'; ?>
<?php require_once APPROOT . '/Helpers/DateHelper.php'; ?>
<div class="row mb-4">
    <div class="col-md-6">
        <h1>Calendario <?php echo $data['year']; ?></h1>
    </div>
    <div class="col-md-6 text-end">
        <div class="btn-group">
            <button class="btn btn-outline-primary" id="prev-year">&lt;&lt;</button>
            <button class="btn btn-outline-primary" id="prev-month">&lt;</button>
            <button class="btn btn-outline-primary" id="next-month">&gt;</button>
            <button class="btn btn-outline-primary" id="next-year">&gt;&gt;</button>
        </div>
    </div>
</div>

<div id="calendar-container" data-year="<?php echo $data['year']; ?>" data-month="<?php echo $data['month']; ?>">
    <h2><?php echo DateHelper::getMonthName($data['month']); ?> <?php echo $data['year']; ?></h2>
    
    <div class="table-responsive">
        <table class="table table-bordered" id="calendar-table">
            <thead>
                <tr>
                    <th>Lun</th>
                    <th>Mar</th>
                    <th>Mié</th>
                    <th>Jue</th>
                    <th>Vie</th>
                    <th>Sáb</th>
                    <th>Dom</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $daysInMonth = DateHelper::getDaysInMonth($data['year'], $data['month']);
                    $firstDayOfMonth = DateHelper::getFirstDayOfMonth($data['year'], $data['month']);
                    
                    $day = 1;
                    echo '<tr>';
                    
                    // Rellena los días del mes anterior
                    for ($i = 1; $i < $firstDayOfMonth; $i++) {
                        echo '<td class="text-muted"></td>';
                    }
                    
                    // Rellena los días del mes actual
                    for ($i = $firstDayOfMonth; $i <= 7; $i++) {
                        echo '<td data-date="' . $data['year'] . '-' . $data['month'] . '-' . $day . '">' . $day . '</td>';
                        $day++;
                    }
                    echo '</tr>';
                    
                    // Rellena el resto de las semanas
                    while ($day <= $daysInMonth) {
                        echo '<tr>';
                        for ($i = 1; $i <= 7 && $day <= $daysInMonth; $i++) {
                            echo '<td data-date="' . $data['year'] . '-' . $data['month'] . '-' . $day . '">' . $day . '</td>';
                            $day++;
                        }
                        // Rellena los días del mes siguiente
                        while ($i <= 7) {
                            echo '<td class="text-muted"></td>';
                            $i++;
                        }
                        echo '</tr>';
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventModalLabel">Añadir Evento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="eventForm">
                    <input type="hidden" id="eventDate">
                    <div class="mb-3">
                        <label for="eventTitle" class="form-label">Título</label>
                        <input type="text" class="form-control" id="eventTitle" required>
                    </div>
                    <div class="mb-3">
                        <label for="eventDescription" class="form-label">Descripción</label>
                        <textarea class="form-control" id="eventDescription" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="saveEvent">Guardar</button>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/Views/templates/footer.php'; ?>