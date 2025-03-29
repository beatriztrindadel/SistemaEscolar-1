<?= $this->extend('Layouts/main') ?>

<?= $this->section('title') ?>
<?php echo $title; ?>
<?= $this->endSection() ?>

<?= $this->section('css') ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="flex flex-wrap -mx-3">
  <div class="flex-none w-full max-w-full px-3">
    <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
      <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
        <h6><?php echo $title; ?> </h6>
        <a href="<?php echo route_to('classes.new'); ?>" class="btn" style="background:rgb(0, 0, 0); color: white; border-radius: 50px;">
          <i class="fas fa-plus"></i>&nbsp;&nbsp;Nova
        </a>
      </div>
      <div class="card-body pb-2">
        <div class="table-responsive">
          <table id="table" class="table aling-items-center mb-0">
            <thead class="align-bottom">
              <tr>
                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Ações</th>
                <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Nome</th>
                <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Descrição</th>
                <th class="px-6 py-3 pl-2 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Criada</th>
                <th class="px-6 py-3 pl-2 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Editada</th>
                <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-gray-200 border-solid shadow-none tracking-none whitespace-nowrap"></th>
              </tr>
            </thead>
            <tbody>

              <?php foreach ($classes as $class): ?>
                <tr>
                  <td class="align-middle pb-0">
                    <div>
                    <a href="<?= base_url('classes/show/' . $class->code); ?>" 
   class="text-base font-bold rounded-lg bg-sky-500 p-2 text-black">
   Detalhes
</a>
                    </div>
                  </td>

                  <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                    <div class="d-flex items-center justify-center">
                      <div>
                        <h6 class="mb-0 text-sm"><?php echo htmlspecialchars($class->name, ENT_QUOTES, 'UTF-8'); ?></h6>
                      </div>
                    </div>
                  </td>

                  <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                    <div class="d-flex items-center justify-center">
                      <div>
                        <h6 class="mb-0 text-sm"><?php echo htmlspecialchars($class->description, ENT_QUOTES, 'UTF-8'); ?></h6>
                      </div>
                    </div>
                  </td>
                  <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                    <div class="d-flex items-center justify-center">
                      <div>
                        <h6 class="mb-0 text-sm"><?php echo $class->created_at->humanize(); ?></h6>
                      </div>
                    </div>
                  </td>

                  <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                    <div class="d-flex items-center justify-center">
                      <div>
                        <h6 class="mb-0 text-sm"><?php echo $class->updated_at->humanize(); ?></h6>
                      </div>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script>
  $('#table').bootstrapTable({
    search: true,
    pagination: true,
    pageSize: 20,
    paginationHAlign: 'left',
    paginationParts: ['pageList'],
    columns: [{
        field: 'action',
        title: 'Ações',
        sortable: false,
      },

      {
        field: 'name',
        title: 'Nome',
        sortable: true,
      },

      {
        field: 'description',
        title: 'Descrição',
        sortable: true,
      },

      {
        field: 'created_at',
        title: 'Criada em',
        sortable: true,
      },

      {
      field: 'updated_at',
        title: 'Atualizada em',
        sortable: true,
      },
    ],
    
  })
</script>
<?= $this->endSection() ?>