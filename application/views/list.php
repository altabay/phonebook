<?php
defined('BASEPATH') OR exit('No direct script access allowed');
echo $header;
?>
<div class="container">
    <?php if(isset($add_success)) : ?>
        <span class="success"><?php echo $add_success ?></span>
    <?php endif; ?>
    <?php echo form_open('/dashboard/search', array('class' => 'form-inline')); ?>
        <div class="form-group">
            <?php echo form_input('search', '', array('placeholder' => 'Search', 'class' => 'form-control')); ?>
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Date added</th>
                <th>Additionl notes</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($phones as $key=> $phone): ?>
            <tr>
                <td><?php echo $phone->ID ?></td>
                <td><?php echo $phone->name ?></td>
                <td><?php echo $phone->phone ?></td>
                <td><?php echo $phone->date ?></td>
                <td><?php echo $phone->note ?></td>
                <td>
                    <a class="btn btn-warning" href="<?php echo base_url() ?>dashboard/phone_form/<?php echo $phone->ID ?>">Edit</a>
                    <a class="btn btn-danger" href="<?php echo base_url() ?>dashboard/delete_phone_action/<?php echo $phone->ID ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php echo $pages; ?>
</div>
<?php
echo $footer;
?>

