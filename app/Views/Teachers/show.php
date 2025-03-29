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
                    <a class="me-1 btn btn-sm" href="<?php echo route_to('teachers.edit', $teacher->code); ?>">
                        <i class="fas fa-arrow-left text-secondary text-sm" data-target="tooltip" data-placement="top" title="Voltar"></i>
                    </a>
                    <a class="me-1 btn btn-sm" href="<?php echo route_to('teachers.edit', $teacher->code); ?>">
                        <i class="leading-normal fas fa-user-edit text-secondary text-sm" data-target="tooltip" data-placement="top" title="Editar"></i>
                    </a>

                    <?php echo form_open(action: route_to('teachers.destroy', $teacher->code), 
                    attributes: ['class' => 'form-floating d-inline', 'onsubmit' => "return confirm('Tem certeza que deseja excluir?')"],
                    hidden: ['_method' => 'DELETE']
                    
                    
                    ); ?>

                    <button class ="btn btn-sm" type="submit"><i class="leading-normal fas fa-trash text-danger text-sm" data-target="tooltip" data-placement="top" title="Excluir"></i></button>
                 

                    <?php echo form_close(); ?>

                    <div data-target="tooltip" class="hidden px-2 py-1 text-center text-white bg-black rounded-lg text-sm" role="tooltip">
                        Edit Profile
                        <div class="invisible absolute h-2 w-2 bg-inherit before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-inherit before:content-['']" data-popper-arrow></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex-auto p-4">

            <hr class="h-px my-6 bg-transteacher bg-gradient-to-r from-transteacher via-white to-transteacher" />
            <ul class="flex flex-col pl-0 mb-0 rounded-lg">
                <li class="relative block px-4 py-2 pt-0 pl-0 leading-normal bg-white border-0 rounded-t-lg text-sm text-inherit"><strong class="text-slate-700">Nome Completo:</strong> &nbsp; <?php echo $teacher->name; ?></li>
                <li class="relative block px-4 py-2 pl-0 leading-normal bg-white border-0 border-t-0 text-sm text-inherit"><strong class="text-slate-700">Telefone:</strong> &nbsp; <?php echo $teacher->phone; ?></li>
                <li class="relative block px-4 py-2 pl-0 leading-normal bg-white border-0 border-t-0 text-sm text-inherit"><strong class="text-slate-700">Email:</strong> &nbsp; <?php echo $teacher->email;?></li>
                <li class="relative block px-4 py-2 pl-0 leading-normal bg-white border-0 border-t-0 text-sm text-inherit"><strong class="text-slate-700">CPF:</strong> &nbsp; <?php echo $teacher->cpf;?></li>
                <li class="relative block px-4 py-2 pl-0 leading-normal bg-white border-0 border-t-0 text-sm text-inherit"><strong class="text-slate-700">Criado:</strong> &nbsp; <?php echo $teacher->created_at->humanize();?></li>
                <li class="relative block px-4 py-2 pl-0 leading-normal bg-white border-0 border-t-0 text-sm text-inherit"><strong class="text-slate-700">Atualizado:</strong> &nbsp; <?php echo $teacher->updated_at->humanize();?></li>
                <li class="relative block px-4 py-2 pl-0 leading-normal bg-white border-0 border-t-0 text-sm text-inherit"><strong class="text-slate-700">Endereço:</strong> &nbsp; <?php echo $teacher->address->getFullAddress();?></li>


               
            </ul>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<!-- Se você precisar de JavaScript, pode adicionar aqui -->
<?= $this->endSection() ?>