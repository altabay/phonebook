<?php
defined('BASEPATH') OR exit('No direct script access allowed');
echo $header;
?>
<div class="container">
    <h1>Login</h1>
    <?php if (validation_errors()) : ?>
        <div class="col-12 col-md-4">
            <div class="alert alert-danger" role="alert">
                <?= validation_errors() ?>
            </div>
        </div>
    <?php endif; ?>
    <?php if (isset($error)) : ?>
        <div class="col-12 col-md-4">
            <div class="alert alert-danger" role="alert">
                <?= $error ?>
            </div>
        </div>
    <?php endif; ?>
    <?php echo form_open('/user/login_action', array('class' => 'col-12 col-md-4')); ?>
        <div class="form-group">
            <?php echo form_input('username', '', array('placeholder' => 'Username', 'class' => 'form-control')); ?>
        </div>
        <div class="form-group">
            <?php echo form_password('password', '', array('placeholder' => 'Password', 'class' => 'form-control')); ?>
        </div>
        <button class="btn btn-primary" type="submit">Login</button>
    </form>
</div>
<?php
echo $footer;
?>

