<?php if (!empty($errors)) : ?>
    <div class="errors" role="alert">
        <ul class="list-group">
            <?php foreach ($errors as $error) : ?>
                <li class="list-group-item text-white" style="background-color:rgb(255, 8, 8); border: 1px solid #f5c6cb; margin-bottom: 5px; border-radius: 5px;">
                    <?= esc($error) ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
