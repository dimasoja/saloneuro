<div class="<?php echo $type ?>_message">
   <?php if( is_array($messages) ): ?>
   <ul>
      <?php foreach( $messages as $message ): ?>
         <li> <?php echo $message ?> </li>
      <?php endforeach; ?>
   </ul>
   <?php else: ?>
      <?php echo $messages ?>
   <?php endif; ?>
</div>