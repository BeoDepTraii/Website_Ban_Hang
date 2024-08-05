<?php

namespace App\Views\Client\Components;

use App\Views\BaseView;

class Category extends BaseView
{
    public static function render($data = null)
    {
?>
                  
                    <?php
            foreach ($data as $item) :
            ?>
                <a class="nav-link" href="/products/categories/<?= $item['id'] ?>"><?= $item['name'] ?></a>
            <?php
            endforeach;
            ?>

<?php
    }
}
