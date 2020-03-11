<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Without discount</th>
            <th scope="col">With discount</th>
            <th scope="col">Discounts</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($products as $product) {
            ?>
            <tr>
                <th scope="row">Product #<?= $product->getId() ?></th>
                <td><?= $product->getPrice() ?></td>
                <td><?= $discountManager->getDiscountedPrice($product) ?></td>
                <td>
                    <?php
                    foreach ($discountManager->getAppliedDiscounts($product) as $discount) {
                        echo $discount->getPercent() . '/ ';
                    }
                    ?>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>

    <h3>All price without discount: <?= $productsPrice ?></h3>
    <h3>All price with discount: <?= $productsDiscountedPrice ?></h3>

</div>
