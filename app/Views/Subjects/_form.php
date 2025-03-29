<div class="row">

    <div class="col-md-12">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" placeholder="Nome" name="name" value="<?php echo old('name', $subject->name); ?>" id="name">
            <label for="name">Nome</label>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-floating mb-3">
           <textarea name="description"  placeholder="Descrição" id="description" style="min-height: 150px !important;", class="form-control"><?php echo old('description', $subject->description); ?></textarea>
            <label for="description">Descrição</label>
        </div>
    </div>

</div>

<div class="row mt-3">
    <div class="col-md-12">
        <button type="submit" class="btn" style="background:rgb(0, 0, 0); color: white; border-radius: 50px;">Salvar</button>
    </div>
</div>


