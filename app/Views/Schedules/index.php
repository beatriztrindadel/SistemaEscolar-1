<?php // @intelephense-ignore-next-line 
?>
<?= $this->extend('Layouts/main') ?>

<?php // @intelephense-ignore-next-line 
?>
<?= $this->section('title') ?>
<?php echo $title; ?>
<?php // @intelephense-ignore-next-line 
?>
<?= $this->endSection() ?>

<?php // @intelephense-ignore-next-line 
?>
<?= $this->section('content') ?>
<div class="flex flex-wrap -mx-3">
  <div class="flex-none w-full max-w-full px-3">
    <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
      <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
        <h6><?php echo $title; ?></h6>
        <a href="<?php echo route_to('classes.show', $class->code); ?>"
          class="btn shadow-md"
          style="background: rgb(0, 0, 0); color: white; border-radius: 50px;">
          <i class="fas fa-eye"></i> Detalhes
        </a>
      </div>
      <div class="card-body pb-2">
        <div class="row">
          <div class="col-md-12 mb-3">
            <div class="col-md-4">
              <div class="form-floating mb-3">
                <label>Turma</label>
                <br>
                <input type="text"
                  class="form-control"
                  readonly
                  value="<?php echo $class->name; ?>">
              </div>
            </div>
            <div class="col-md-12">
              <label for="schedule">Horários da turma</label>
              <div id="scheduleContainer">
                <!-- Adc pelo script -->
              </div>
            </div>
          </div>
        </div>
        <button class="btn btn-sm mt-3 badge bg-dark shadow-md"
          style="border-radius: 50px;"
          id="addSchedule">
          <i class="fas fa-plus"></i>
        </button>
        <hr>
        <div class="row">
          <div class="col-md-4">
            <button class="btn bg-gradient-dark shadow-md"
              style="border-radius: 50px;"
              id="generateSchedule">
              Gerar Horário
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php // @intelephense-ignore-next-line 
?>
<?= $this->endSection() ?>

<?php // @intelephense-ignore-next-line 
?>
<?= $this->section('js') ?>



<?php // @intelephense-ignore-next-line 
?>

<script>
  // quando for renderiza a view e a class já tiver horários,
  // colocamos um ouvinte no clique do botão 'btn-remove'
  document.querySelectorAll('.btn-remove').forEach(button => {
    button.addEventListener('click', function() {
      this.parentNode.remove();
    });
  });
</script>

<script>
  // Array de disciplinas enviado pelo controller
  const subjects = <?php echo json_encode($subjects); ?>;

  // Array de professores enviado pelo controller
  const teachers = <?php echo json_encode($teachers); ?>;

  // Função para adicionar campos para adicionar horários de aula
  document.getElementById('addSchedule').addEventListener('click', function() {
    const container = document.getElementById('scheduleContainer');
    let scheduleField = document.createElement('div');
    scheduleField.className = 'mb-3';
    scheduleField.innerHTML = `
                <div class="row">
                    <div class="col-md">
                        <select class="form-select" name="day_of_week">
                            <option value="1">Segunda-feira</option>
                            <option value="2">Terça-feira</option>
                            <option value="3">Quarta-feira</option>
                            <option value="4">Quinta-feira</option>
                            <option value="5">Sexta-feira</option>
                        </select>
                    </div>
                    <div class="col-md">
                        <input type="time" class="form-control" name="start_at">
                    </div>
                    <div class="col-md">
                        <input type="time" class="form-control" name="end_at">
                    </div>
                    <div class="col-md">
                        <select class="form-select" name="subject_id">
                            <!-- Opções de disciplinas serão preenchidas dinamicamente -->
                        </select>
                    </div>
                    <div class="col-md">
                        <select class="form-select" name="teacher_id">
                            <!-- Opções de professores serão preenchidos dinamicamente -->
                        </select>
                    </div>
                </div>
            `;

    // Adiciona opções de disciplinas ao menu suspenso
    const subjectSelect = scheduleField.querySelector('select[name="subject_id"]');

    if (subjects.length === 0) {
      // Desabilita o dropdown
      subjectSelect.disabled = true;

      // Cria e adiciona a opção "Não há disciplinas"
      let option = document.createElement('option');
      option.text = "Não há disciplinas";
      option.value = "";
      subjectSelect.appendChild(option);
    } else {
      // Habilita o dropdown
      subjectSelect.disabled = false;

      // Adiciona as disciplinas ao dropdown
      subjects.forEach(function(subject) {
        let option = document.createElement('option');
        option.text = subject.name;
        option.value = subject.id;
        subjectSelect.appendChild(option);
      });
    }

    // Adiciona opções de professores ao menu suspenso
    const teacherSelect = scheduleField.querySelector('select[name="teacher_id"]');

    if (teachers.length === 0) {
      // Desabilita o dropdown
      teacherSelect.disabled = true;

      // Cria e adiciona a opção "Não há professores"
      let option = document.createElement('option');
      option.text = "Não há professores";
      option.value = "";
      teacherSelect.appendChild(option);
    } else {
      // Habilita o dropdown
      teacherSelect.disabled = false;
      teachers.forEach(function(teacher) {
        let option = document.createElement('option');
        option.text = teacher.name;
        option.value = teacher.id;
        teacherSelect.appendChild(option);
      });

    }



    // Adiciona o campo criado ao container
    container.appendChild(scheduleField);

    // Adiciona um botão de exclusão em cada linha de horário
    const deleteButton = document.createElement('button');
    deleteButton.innerHTML = '<i class="fas fa-trash"></i>';
    deleteButton.className = 'btn badge bg-danger btn-sm';
    deleteButton.addEventListener('click', function() {
      scheduleField.remove(); // Remove a linha de horário ao clicar no botão de exclusão
    });
    scheduleField.appendChild(deleteButton);

  });


  // botão de gerar horário
  const btnGenerateSchedule = document.getElementById('generateSchedule');

  // Função para gerar o horário
  btnGenerateSchedule.addEventListener('click', function() {
    const schedules = document.querySelectorAll('#scheduleContainer .row');
    const scheduleDetails = [];
    schedules.forEach(function(schedule) {
      const dayOfWeek = schedule.querySelector('select[name="day_of_week"]').value;
      const startAt = schedule.querySelector('input[name="start_at"]').value;
      const endAt = schedule.querySelector('input[name="end_at"]').value;
      const subjectId = schedule.querySelector('select[name="subject_id"]').value;
      const teacherId = schedule.querySelector('select[name="teacher_id"]').value;

      // todos os campos estão preenchidos?
      if (!dayOfWeek || !startAt || !endAt || !subjectId || !teacherId) {

        Toastify({
          text: 'Por favor, preencha todos os campos de horário e disciplina',
          close: true,
          duration: 10000, // um pouco maior a duração
          gravity: "top",
          position: "left",
          backgroundColor: "#dc3545",
        }).showToast();

        return;
      }

      scheduleDetails.push({
        day_of_week: parseInt(dayOfWeek),
        start_at: startAt,
        end_at: endAt,
        class_id: parseInt('<?php echo $class->id; ?>'),
        subject_id: parseInt(subjectId),
        teacher_id: parseInt(teacherId)
      });
    });


    // se estiver vazio, não fazemos nada
    if (scheduleDetails.length === 0) {

      return;
    }

    // desabilita o botão de gerar horário
    btnGenerateSchedule.disabled = true;
    btnGenerateSchedule.textContent = 'Por favor aguarde...';

    // o que será enviado no request
    const bodyRequest = {
      schedule_details: scheduleDetails,
    };

    // CSRF CODE PARA ENVIAR NO REQUEST
    let csrfTokenName = '<?php echo csrf_token(); ?>';
    let csrfTokenValue = '<?php echo csrf_hash(); ?>';

    // colocamos no body os dados de CSRF
    bodyRequest[csrfTokenName] = csrfTokenValue;

    // Enviar os dados com fetch API
    fetch('<?php echo route_to('schedules.store'); ?>', {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(bodyRequest)
      })
      .then(response => {
        if (!response.ok) {
          throw new Error('Erro ao enviar os horários.');
        }

        return response.json();
      })
      .then(data => {

        // redirecionamos para essa rota mesmo
        window.location.href = '<?php echo route_to('schedules', $class->code); ?>';
      })
      .catch(error => {
        console.error('Erro ao enviar requisição:', error);
        Toastify({
          text: "Erro ao enviar os horários",
          duration: 10000,
          close: true,
          gravity: "bottom",
          position: "right",
          backgroundColor: "#dc3545",
        }).showToast();
      });


  });
</script>

<?= $this->endSection() ?>