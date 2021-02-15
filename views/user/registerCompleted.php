<?php
if(isset($_SESSION['register']) && $_SESSION['register'] == 'completed'): ?>
    <h2 style="text-align:center;">Register Completed!</h2>
<?php else: ?>
   <h2 style="text-align:center;">Register failed, please insert the data correctly!</h2>
<?php endif; ?>

<?php Utils::deleteSession('register'); ?>
