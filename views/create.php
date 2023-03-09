<?php require('partials/head.php') ?>
<?php require('partials/nav.php') ?>


<main>


    <div class="container mx-auto px-5 pb-6 pt-20 min-h-screen body-font text-gray-600">
        <div class="-m-4 flex flex-wrap">

            <form id="product_form" action="/storeproduct" class="w-full p-4 lg:w-1/4" method="post">
                <div class="block p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 ">
                    <div>
                        <label for="sku" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">SKU</label>
                        <input v-model="text" type="text" name="sku" id="sku" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <div class="text-sm"><?= $errors['sku'] ?? '' ?></div>
                    </div>
                    <div>
                        <label for="name" class="block mt-4 mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                        <input type="text" name="name" id="name" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div>
                        <label for="price" class="block mt-4 mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                        <input type="text" name="price" id="price" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>

                    <label for="type" class="mt-4 block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type Switcher</label>


                    <select v-model="selected" name="type" id="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="dvd">DVD</option>
                        <option value="furniture">Furniture</option>
                        <option value="book">Book</option>

                    </select>

                </div>
                <div id="attributes">
                <div  v-if="selected == 'dvd'" class="block p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 ">

                    <div>
                        <label for="size" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Size (MB)</label>
                        <input type="text" id="size" name="attributes[size]" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <p class="text-sm mt-2">Please provide the size in megabytes when type DVD is selected</p>


                </div>
                <div  v-if="selected == 'furniture'" class="block p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700  ">
                    <div>
                        <label for="height" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Height (CM)</label>
                        <input type="text" id="height" name="attributes[height]" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div>
                        <label for="width" class="block mt-4 mb-2 text-sm font-medium text-gray-900 dark:text-white">Width (CM)</label>
                        <input type="text" id="width" name="attributes[width]" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div>
                        <label for="length" class="block mt-4 mb-2 text-sm font-medium text-gray-900 dark:text-white">Length (CM)</label>
                        <input type="text" id="length" name="attributes[length]" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <p class="text-sm mt-2">Please provide dimensions in HxWxL format when type Furniture is selected</p>



                </div>
                <div v-if="selected == 'book'" class="block p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700      ">
                    <div>
                        <label for="weight" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Weight (KG)</label>
                        <input type="text" id="weight" name="attributes[weight]" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <p class="text-sm mt-2">Please provide weight in kilograms when type book is selected</p>

                </div>
                </div>
            </form>



        </div>


</main>



<?php require('partials/footer.php') ?>
