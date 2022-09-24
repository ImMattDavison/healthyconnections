<!DOCTYPE html>
<html lang="en">
    <?php if($user->is_logged_in() ){?>
        <!-- IF LOGGED IN THIS WILL SHOW -->
    <?php } else { ?>
        <!-- IF NOT LOGGED IN THIS WILL SHOW -->
    <?php } ?>
</html>