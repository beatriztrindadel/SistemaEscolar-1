<div class="row">
    <h6>Dados Pessoais</h6>
    <div class="col-md-5 mt-5">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" placeholder="Nome Completo" name="name" value="<?php echo old('name', $teacher->name); ?>" id="name">
            <label for="name">Nome completo</label>
        </div>
    </div>

    <div class="col-md-9">
        <div class="form-floating mb-3">
            <input type="email" class="form-control" placeholder="E-mail" name="email" value="<?php echo old('email', $teacher->email); ?>" id="email">
            <label for="email">E-mail</label>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-floating mb-3">
            <input type="tel" class="form-control phone" placeholder="Telefone" name="phone" value="<?php echo old('phone', $teacher->phone); ?>" id="phone">
            <label for="phone">Telefone</label>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-floating mb-3">
            <input type="text" class="form-control cpf" placeholder="CPF" name="cpf" value="<?php echo old('cpf', $teacher->cpf); ?>" id="cpf">
            <label for="cpf">CPF Válido</label>
        </div>
    </div>
</div>

<div class="row mt-4">
    <h6>Dados de Endereço</h6>

    <div class="col-md-2">
        <div class="form-floating mb-3">
            <input type="text" class="form-control cep" placeholder="CEP válido" name="postal_code" value="<?php echo old('postal_code', $teacher->address->postal_code); ?>" id="postal_code">
            <label for="postal_code">CEP válido</label>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-floating mb-5">
            <input type="text" class="form-control" placeholder="Rua" name="street" value="<?php echo old('street', $teacher->address->street); ?>" id="street">
            <label for="street">Rua</label>
        </div>
    </div>

    <div class="col-md-5">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" placeholder="N°" name="number" value="<?php echo old('number', $teacher->address->number); ?>" id="number">
            <label for="number">Número</label>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" placeholder="Cidade" name="city" value="<?php echo old('city', $teacher->address->city); ?>" id="city">
            <label for="city">Cidade</label>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" placeholder="Bairro" name="district" value="<?php echo old('district', $teacher->address->district); ?>" id="district">
            <label for="district">Bairro</label>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" placeholder="Estado" name="state" value="<?php echo old('state', $teacher->address->state); ?>" id="state">
            <label for="state">Estado</label>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-12">
        <button type="submit" class="btn" style="background:rgb(0, 0, 0); color: white; border-radius: 50px;">Salvar</button>
    </div>
</div>
<?php echo form_close(); ?>

<?= $this->section('js') ?>
<script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/mask/jquery.mask.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/mask/app.js'); ?>"></script>

<script>
    document.getElementById('postal_code').addEventListener('change', function() {
        const postal_code = this.value;
        if (postal_code.length === 9) {
            fetch(`https://viacep.com.br/ws/${postal_code}/json/`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('street').value = data.logradouro ?? '';
                    document.getElementById('district').value = data.bairro ?? '';
                    document.getElementById('city').value = data.localidade ?? '';
                    document.getElementById('state').value = data.uf ?? '';
                })
                .catch(error => {
                    console.log(`Erro ao buscar CEP: ${error}`);
                });
        }
    });
</script>
<?= $this->endSection() ?>
