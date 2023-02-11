<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
      <?php if (isset($work)) {
            echo 'Update work '. $work->getWorkName();
            }
            else {
              echo 'Add work';
            }
        ?>
    </title>
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
          crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>

</head>
<body>
<main class="main container mt-5 border border-primary p-3">
    <h3 class="text-center">
      <?php if (isset($work)) {
            echo 'Update work: '. $work->getWorkName();
            }
            else {
              echo 'Add work';
            }
        ?>
    </h3>
    <form action=" <?php if (isset($work)) {
      echo '?action=update&work_id=' . $work->getWorkId();
    }
    else echo '?action=store' ?>" method="post">
        <div class="form-group">
            <label for="work_name">Work Name:</label>
            <input type="text" class="form-control" id="work_name" required
                   value="<?php if (isset($work)) {
                     echo $work->getWorkName();
                   } ?>" name="work_name">
        </div>
        <div class="form-group">
            <label for="starting_date">Starting Date:</label>
            <input type="datetime-local" class="form-control" id="starting_date"
                   required
                   name="starting_date" value="<?php if (isset($work)) {
              echo $work->getStartingDate();
            } ?>">
        </div>
        <div class="form-group">
            <label for="ending_date">Ending Date:</label>
            <input type="datetime-local" class="form-control" id="ending_date"
                   required
                   name="ending_date" value="<?php if (isset($work)) {
              echo $work->getEndingDate();
            } ?>">
        </div>
        <div class="form-group">
            <label for="status">Status:</label>
            <select class="form-control" id="status" name="status" required>
                <option value="<?php echo PLANNING ?>" <?php if (isset($work) && $work->getStatus() === PLANNING)
                  echo 'selected' ?> >Planning
                </option>
                <option value="<?php echo DOING ?>" <?php if (isset($work) && $work->getStatus() === DOING)
                  echo 'selected' ?>>Doing
                </option>
                <option value="<?php echo COMPLETE ?>"<?php if (isset($work) && $work->getStatus() === COMPLETE)
                  echo 'selected' ?>>Complete
                </option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">
          <?php if (isset($work)) {
            echo "Update work";
          }
          else {
            echo "Add work";
          }
          ?>
        </button>
        <a href="index.php" role="button" class="btn btn-danger">Cancel</a>
    </form>
    <script>
      $(document).ready(function () {
        $("form").submit(function (e) {
          let start = new Date($("#starting_date").val());
          let end = new Date($("#ending_date").val());
          if (start > end) {
            alert("The end date must be greater than or equal to the start date.");
            e.preventDefault();
          }
        });
      });
    </script>
</main>
</body>
</html>