<?php require('partials/head.php') ?>
<?php require('partials/nav.php') ?>

    <main>

        <div class="container mx-auto px-5 pb-6 pt-20 min-h-screen body-font text-gray-600">
            <form action="/delete-products" id="deleteProduct" method="post">
                <input type="hidden" name="_method" value="DELETE">
                <div class="-m-4 flex flex-wrap">

                    <?php foreach ($products as $product) : ?>
                        <div class="w-full p-4 md:w-1/2 lg:w-1/4">
                            <div class="delete-checkbox">
                                <label>
                                    <input name="products[]" type="checkbox" value="<?= $product->getId() ?>">
                                </label>
                                <div class="text-center -mt-6">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><?= $product->getSku() ?></h5>
                                    <p class="font-normal text-gray-700 dark:text-gray-400"><?= $product->getName() ?></p>
                                    <p class="font-normal text-gray-700 dark:text-gray-400"><?= $product->getPrice() ?></p>
                                    <p class="font-normal text-gray-700 dark:text-gray-400"><?= $product->getAttributes() ?></p>

                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>




                </div>
            </form>
        </div>



    </main>

<?php require('partials/footer.php') ?>