<?php
defined('BASEPATH') OR exit('No direct script access allowed');
echo $header;
?>
<div class="container">
    <?php if(isset($add_error)) : ?>
        <span class="error"><?php echo $add_error ?></span>
    <?php endif; ?>
    <?php if (validation_errors()) : ?>
        <div class="col-md-12">
            <div class="alert alert-danger" role="alert">
                <?= validation_errors() ?>
            </div>
        </div>
    <?php endif; ?>
    <?php if (isset($errors) && !empty($errors)) : ?>
        <div class="col-md-12">
            <div class="alert alert-danger" role="alert">
                <?php foreach($errors as $error) : ?>
                    <p><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <?php echo form_open('/dashboard/save_phone_action', array('class' => 'col-12 col-md-4')); ?>
        <div class="form-group">
            <?php echo form_input('name', htmlspecialchars_decode($record->name), array('placeholder' => 'Name', 'class' => 'form-control')); ?>
        </div>
        <div class="form-group">
            <?php echo form_input('phone', htmlspecialchars_decode($record->phone), array('placeholder' => 'Phone number', 'class' => 'form-control')); ?>
        </div>
        <div class="form-group">
            <?php echo form_textarea('note', htmlspecialchars_decode($record->note), array('placeholder' => 'Addition notes', 'class' => 'form-control')); ?>
        </div>
        <?php echo form_hidden('ID', $record->ID); ?>
        <button class="btn btn-primary" type="submit">Save</button>
    </form>
</div>
<?php
echo $footer;
?>

