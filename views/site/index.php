<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Product 1</th>
            <th scope="col">Product 2</th>
            <th scope="col">All products</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">Without discount</th>
            <td><?= $product1Price ?></td>
            <td><?= $product2Price ?></td>
            <td><?= $productsPrice ?></td>
        </tr>
        <tr>
            <th scope="row">With discount</th>
            <td><?= $product1DiscountedPrice ?></td>
            <td><?= $product2DiscountedPrice ?></td>
            <td><?= $productsDiscountedPrice ?></td>
        </tr>
        </tbody>


    </table>

</div>
