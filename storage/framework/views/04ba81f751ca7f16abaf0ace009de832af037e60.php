
<!-- modal.blade.php -->
<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-body">
                <?php echo $__env->yieldContent('modal-content'); ?>
                <?php echo $__env->yieldContent('modal-state'); ?>
                <?php echo $__env->yieldContent('modal-city'); ?>
                <?php echo $__env->yieldContent('modal-area'); ?>
                <?php echo $__env->yieldContent('modal-postal'); ?>
            </div>
        </div>
    </div>
</div><?php /**PATH C:\wamp64\www\country_code\resources\views/modal.blade.php ENDPATH**/ ?>