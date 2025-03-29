<?= $this->extend('Layouts/main') ?>

<?= $this->section('title') ?>
<?php echo $title; ?>
<?= $this->endSection() ?>

<?= $this->section('css') ?>
<!-- Você pode adicionar CSS adicional aqui, se necessário -->
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="w-full max-w-full px-3 lg-max:mt-6 xl:w-5/10">
    <div class="relative flex flex-col h-full min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
        <div class="p-4 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
            <div class="flex flex-wrap -mx-3">
                <div class="flex items-center w-full max-w-full px-3 shrink-0 md:w-8/12 md:flex-none">
                    <h6 class="mb-0"><?php echo $title; ?></h6>
                </div>
                <div class="col-md-4 text-end">
                    <a class="me-1 btn btn-sm" href="<?php echo route_to('classes', $class->code); ?>">
                        <i class="fas fa-arrow-left text-secondary" data-bs-toggle="tooltip" data-placement="top" title="Voltar"></i>
                    </a>
                    <a class="me-1 btn btn-sm" href="<?php echo route_to('classes.edit', $class->code); ?>">
                        <i class="fas fa-edit text-secondary text-sm" data-bs-toggle="tooltip" data-placement="top" title="Editar"></i>
                    </a>

                    <?php echo form_open(
                        action: route_to('classes.destroy', $class->code),
                        attributes: ['class' => 'form-floating d-inline', 'onsubmit' => "return confirm('Tem certeza que deseja excluir?')"],
                        hidden: ['_method' => 'DELETE']


                    ); ?>

                    <button class="btn btn-sm" type="submit"><i class="leading-normal fas fa-trash text-danger text-sm" data-target="tooltip" data-placement="top" title="Excluir"></i></button>


                    <?php echo form_close(); ?>

                    <div data-target="tooltip" class="hidden px-2 py-1 text-center text-white bg-black rounded-lg text-sm" role="tooltip">
                        Edit Profile
                        <div class="invisible absolute h-2 w-2 bg-inherit before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-inherit before:content-['']" data-popper-arrow></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex-auto p-4">

            <hr class="h-px my-6 bg-transclass bg-gradient-to-r from-transclass via-white to-transclass" />
            <ul class="flex flex-col pl-0 mb-0 rounded-lg">
                <li class="relative block px-4 py-2 pt-0 pl-0 leading-normal bg-white border-0 rounded-t-lg text-sm text-inherit"><strong class="text-slate-700">Nome:</strong> &nbsp; <?php echo $class->name; ?></li>
                <li class="relative block px-4 py-2 pt-0 pl-0 leading-normal bg-white border-0 rounded-t-lg text-sm text-inherit"><strong class="text-slate-700">Descrição:</strong> &nbsp; <?php echo $class->description; ?></li>
                <li class="relative block px-4 py-2 pl-0 leading-normal bg-white border-0 border-t-0 text-sm text-inherit"><strong class="text-slate-700">Criado:</strong> &nbsp; <?php echo $class->created_at->humanize(); ?></li>
                <li class="relative block px-4 py-2 pl-0 leading-normal bg-white border-0 border-t-0 text-sm text-inherit"><strong class="text-slate-700">Atualizado:</strong> &nbsp; <?php echo $class->updated_at->humanize(); ?></li>
                



            </ul>
        </div>
    </div>
</div>


<div class="space-y-6">
    <div class="bg-white shadow rounded p-4">
        <div class="flex items-center justify-between">
            <h6 class="mb-0">Horários das turmas</h6>
            <a class="btn btn-sm ml-4" href="<?php echo route_to('schedules', $class->code); ?>">
                <i class="fas fa-calendar text-secondary text-sm" title="Gerenciar horários"></i>
            </a>
        </div>
        <div class="table-responsive mt-3">
            <?php echo $class->schedules(); ?>
        </div>
    </div>

    <div class="bg-white shadow rounded-2xl p-4">
        <h6 class="mb-3">Estudantes matriculados na turma no ano de - <?php echo date('Y'); ?></h6>
        <div class="table-responsive">
            <?php echo $class->students(); ?>
        </div>
    </div>
</div>






<?= $this->endSection() ?>

<?= $this->section('js') ?>
<!-- Se você precisar de JavaScript, pode adicionar aqui -->
<?= $this->endSection() ?>