<div>
    <h2>Check product price</h2>
    <form wire:submit="checkPrice">
        <label>
            <span>Products (Insert product SKU's separated by commas please)</span><br>
            <textarea name="" id="" cols="30" rows="10" wire:model="product_code"></textarea>
            <br>
            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['product_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <em><?php echo e($message); ?></em>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> <!--[if ENDBLOCK]><![endif]-->
        </label>
        <br>
        <br>
        <label>
            <span>Account</span>
            <input type="text" wire:model="account_id">
            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['account_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <em><?php echo e($message); ?></em>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> <!--[if ENDBLOCK]><![endif]-->
        </label>

        <button type="submit">Check Price</button>
    </form>

    <p>The result is <?php echo e($result); ?></p>


</div>
<?php /**PATH /home/rmarques/projects/eci-test/resources/views/livewire/price-checker.blade.php ENDPATH**/ ?>