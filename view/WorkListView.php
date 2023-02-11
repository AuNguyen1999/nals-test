<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
          crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/fullcalendar@5.3.2/main.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/index.global.min.js'></script>

</head>
<body>
<main class="main container mt-5 border border-primary p-3">
    <div class="works">
        <ul class="nav nav-pills mb-3" id="list-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="list-tab" data-toggle="tab"
                   href="#list" role="tab" aria-controls="list" data-type="list"
                   aria-selected="true">List</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="calendar-tab" data-toggle="tab"
                   href="#calendar-content" role="tab"
                   data-type="calendar"
                   aria-controls="calendar-content"
                   aria-selected="false">Calendar</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="list">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Starting Date</th>
                        <th scope="col">Ending Date</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($works as $key => $work) {
                      echo '<tr>
                    <th scope="row">' . ($key + 1) . '</th>
                    <td>' . $work->getWorkName() . '</td>
                    <td>' . $work->getStartingDate() . '</td>
                    <td>' . $work->getEndingDate() . '</td>
                    <td>' . $work->getStatusDisplay() . '</td>
                    <td>
                    <a role="button" class="btn btn-info" href="?action=edit&work_id=' . $work->getWorkId() . '">Edit</a>
                    <a role="button" class="btn btn-danger" href="?action=delete&work_id=' . $work->getWorkId() . '">Delete</a>
                    </td>
                    </tr>';
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane" id="calendar-content">
              <?php
              $events = [];
              foreach ($works as $key => $work) {
                $events[] = [
                  'title' => $work->getWorkName(),
                  'start' => $work->getStartingDate(),
                  'end' => $work->getEndingDate(),
                  'color' => $work->getStatus() == PLANNING ? "#ecc67e" : ($work->getStatus() == DOING ? '#88a28b' : '#4e97d6'),
                ];
              }
              ?>
                <div id="calendar"></div>
            </div>
        </div>
    </div>
    <div class="mt-1">
        <a href="?action=add" class="btn btn-info" role="button">New Work</a>
    </div>
    <script>
      $(document).ready(function () {
        let events = <?php echo json_encode($events); ?>;
        let calendarEl = document.getElementById('calendar');
        let calendarInit = false
        $('#list-tab a').on('shown.bs.tab', function (e) {
          const $this = $(this);
          if ($this.data('type') === 'calendar' && !calendarInit) {
            let calendar = new FullCalendar.Calendar(calendarEl, {
              initialView: 'dayGridMonth',
              themeSystem: 'bootstrap',
              headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
              },
              height: 600,
              events: events
            });
            calendar.render();
            calendarInit = true;
          }
        })
      });
    </script>
</main>
</body>

</html>