<?= $this->extend('Layouts/main') ?>

<?= $this->section('title') ?>
<?php echo $title; ?>
<?= $this->endSection() ?>

<?= $this->section('css') ?>
<!-- CSS adicional aqui -->
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6><?php echo $title; ?> </h6>
                <a href="<?php echo route_to('students'); ?>" class="btn" style="background:rgb(0, 0, 0); color: white; border-radius: 50px;">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
            <div class="card-body">
                <?php echo form_open(route_to('students.create'), ['class' => 'form-floating']); ?>
                <?php echo $this->include('Students/_form'); ?>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<!-- JS adicional aqui -->
<?= $this->endSection() ?>
