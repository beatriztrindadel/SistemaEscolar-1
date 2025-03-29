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

        <div class="roow">

          <div class="col-md-10">

            <div class="form-floating mb-3">
              <input type="text" class="form-control cpf" placeholder="CPF do Responsável" name="cpf" id="cpf">
              <label for="cpf">CPF do Responsável para incluir um novo aluno</label>
            </div>

          </div>

          <div class="d grid gap-2 col-md-2">

            <button type="button" id="btnSearchParent" class="btn btn-primary">Buscar responsável</button>

          </div>

          <div id="boxBtnNewParent" class="d-grid gap-2 col-md-2 d-none">

            <a href="<?php echo route_to('parents.new'); ?>" id="btnNewParent" class="btn btn-success">Cadastrar Responsável</a>

          </div>

        </div>


      </div>
      <div class="card-body pb-2">
        <div class="table-responsive">
          <table id="table" class="table aling-items-center mb-0">
            <thead class="align-bottom">
              <tr>
                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Ações</th>
                <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Nome</th>
                <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Email</th>
                <th class="px-6 py-3 pl-2 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Cpf</th>
                <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-gray-200 border-solid shadow-none tracking-none whitespace-nowrap"></th>
              </tr>
            </thead>
            <tbody>

              <?php foreach ($students as $student): ?>
                <tr>
                  <td class="align-middle pb-0">
                    <div>
                      <a href="<?= base_url('students/show/' . $student->code); ?>"
                        class="text-base font-bold rounded-lg bg-sky-500 p-2 text-black">
                        Detalhes
                      </a>
                    </div>
                  </td>

                  <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                    <div class="d-flex items-center justify-center">
                      <div>
                        <h6 class="mb-0 text-sm"><?php echo htmlspecialchars($student->name, ENT_QUOTES, 'UTF-8'); ?></h6>
                      </div>
                    </div>
                  </td>

                  <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                    <div class="d-flex items-center justify-center">
                      <div>
                        <h6 class="mb-0 text-sm"><?php echo htmlspecialchars($student->email, ENT_QUOTES, 'UTF-8'); ?></h6>
                      </div>
                    </div>
                  </td>

                  <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                    <div class="d-flex items-center justify-center">
                      <div>
                        <h6 class="mb-0 text-sm"><?php echo htmlspecialchars($student->cpf, ENT_QUOTES, 'UTF-8'); ?></h6>
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


<script>
  // buscamos o responsável quando preenchido o campo de cpf e renderizamos a view para criação de novo aluno
  document.addEventListener("DOMContentLoaded", function() {
    const cpfInput = document.getElementById("cpf");
    const btnSearchParent = document.getElementById("btnSearchParent");
    const boxBtnNewParent = document.getElementById("boxBtnNewParent");

    btnSearchParent.addEventListener("click", function() {

      // ocultamos o botão para criar o responsável
      boxBtnNewParent.className = 'd-none';

      const cpf = cpfInput.value;

      if (!cpf) {

        return;
      }

      btnSearchParent.disabled = true;
      btnSearchParent.textContent = "Aguarde...";

      // podemos buscar o responsável...

      const url = `<?php echo route_to('api.fetch.parent.by.cpf') ?>?cpf=${cpf}`;

      fetch(url)
        .then(response => response.json())
        .then(data => {

          btnSearchParent.disabled = false;
          btnSearchParent.textContent = "Buscar responsável";

          if (data.parent === null) {

            // exibimos o botão para criar o responsável
            boxBtnNewParent.className = 'd-block';

            Toastify({
              text: "Responsável não encontrado",
              duration: 10000,
              close: true,
              gravity: "top",
              position: "left",
            }).showToast();

            return;

          }

          const parentCode = data.parent.code;

          window.location.href = '<?php echo route_to('students.new'); ?>?parent_code=' + parentCode;
        })
        .catch(error => {
          console.error('Erro ao enviar requisição:', error);

          Toastify({
            text: "Erro ao buscar responsável",
            duration: 10000, // um pouco maior a duração
            close: true,
            gravity: "bottom",
            position: "right",
            backgroundColor: "#dc3545",
          }).showToast();
        });
    });
  });
</script>



<script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/mask/jquery.mask.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/mask/app.js'); ?>"></script>


<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">




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
        sortable: false,
      },

      {
        field: 'email',
        title: 'Email',
        sortable: false,
      },

      {
        field: 'cpf',
        title: 'CPF',
        sortable: false,
      },

    ]
  })
</script>
<?= $this->endSection() ?>