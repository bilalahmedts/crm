          

          

<?php if($message = Session::get('success')): ?>

  <div class="container mt-5"><?php echo alert_html( $message, 'success' ); ?></div>

<?php endif; ?>


<?php if($message = Session::get('danger')): ?>

  <div class="container mt-5"><?php echo alert_html( $message, 'danger' ); ?></div>


<?php endif; ?>


<?php if($message = Session::get('warning')): ?>

  <div class="container mt-5"><?php echo alert_html( $message, 'warning' ); ?></div>

<?php endif; ?>


<?php if($message = Session::get('info')): ?>

  <div class="container mt-5"><?php echo alert_html( $message, 'info' ); ?></div>

<?php endif; ?><?php /**PATH C:\xampp\htdocs\crm\resources\views/frontend/layouts/partials/notification.blade.php ENDPATH**/ ?>