<?php require 'layout/header.php'; ?>

<?php require 'layout/nav.php'; ?>

<hr class="mx-3 py-2">

<div class="container p-5">
    <!-- Product Cards -->
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">
        <?php foreach ($products as $product) : ?>
            <div class="col mt-2">
                <div class="card border-dark">
                    <div class="card-input">
                        <input type="checkbox" class="delete-checkbox form-check-input bg-dark m-2" name="product_selected[]" value="<?= $product['sku'] ?>">
                    </div>
                    <div class="card-body">
                        <p class="card-text text-center"><?= $product['sku'] ?></p>
                        <p class="card-text text-center"><?= $product['name'] ?></p>
                        <p class="card-text text-center"><?= $product['price'] ?> $</p>
                        <?php
                        if ($product['switcher'] == 'DVD') : ?>
<!--                        <p >14-28</p>-->
                        <p class="card-text text-center">Size: <?= $product['size'] ?>MB</p>
                        <?php elseif ($product['switcher'] == 'Book') : ?>
                        <p class="card-text text-center">Weight: <?= $product['weight'] ?>MB</p>
                        <?php elseif ($product['switcher'] == 'Furniture') : ?>
                        <p class="card-text text-center">Dimensions: <?= $product['height'] . 'x' . $product['width'] . 'x' . $product['length'] ?></p>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php require 'layout/footer.php'; ?>
<script>
    $(document).ready(function() {
        // Initially disable the delete button
        $('#delete-product-btn').prop('disabled', true);

        // Enable or disable the delete button based on checkbox selection
        $('.delete-checkbox').on('change', function() {
            if ($('.delete-checkbox:checked').length > 0) {
                $('#delete-product-btn').prop('disabled', false);
            } else {
                $('#delete-product-btn').prop('disabled', true);
            }
        });

        // Handle the form submission
        $('#delete-form').on('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            // Collect all selected checkboxes
            var selectedProducts = [];
            $('.delete-checkbox:checked').each(function() {
                selectedProducts.push($(this).val()); // Collect the SKU values
            });

            // If no products are selected, do nothing
            if (selectedProducts.length === 0) {
                alert('Please select at least one product to delete.');
                return;
            }

            // Send the selected product SKUs via AJAX to the server
            $.ajax({
                url: '/product/deleteProducts/'+selectedProducts, // Update with your actual delete route
                method: 'POST',
                data: {
                    product_selected: selectedProducts,
                },
                success: function () {
                    location.reload();
                },
                error: function() {
                    alert('An error occurred while trying to delete the products.');
                }
            });
        });
    });

    let generated_li = document.querySelector(".generated_li");
    let selector = document.getElementById('type_switcher');

    selector.addEventListener('change', function () {
        const selectedOption = selector.value;
        generated_li.textContent = '';

        if (selectedOption === 'DVD') {
            const dvd_label = document.createElement('label');
            dvd_label.textContent = "Size of DVD:";

            const dvd = document.createElement('input');
            dvd.type = 'number';
            dvd.step = '00.01';
            dvd.name = 'size_input';
            dvd.placeholder = 'Enter the size...';
            dvd.className = 'size-input dimension';

            generated_li.appendChild(dvd_label);
            generated_li.appendChild(dvd);

        } else if (selectedOption === 'Furniture') {
            const height_label = document.createElement('label');
            height_label.textContent = 'Height: ';

            const height = document.createElement('input');
            height.type = 'number';
            height.step = '00.01';
            height.name = 'height_input';
            height.placeholder = 'Enter the height... ';
            height.className = 'furniture-input dimension';

            const width_label = document.createElement('label');
            width_label.textContent = 'Width: ';

            const width = document.createElement('input');
            width.type = 'number';
            width.step = '00.01';
            width.name = 'width_input';
            width.placeholder = 'Enter the width...';
            width.className = 'furniture-input dimension';

            const length_label = document.createElement('label');
            length_label.textContent = 'Length: ';

            const length = document.createElement('input');
            length.type = 'number';
            length.step = '00.01';
            length.name = 'length_input';
            length.placeholder = 'Enter the length...';
            length.className = 'furniture-input dimension';

            const dimensionsDiv = document.createElement('div');
            dimensionsDiv.className = 'dimensions-div';

            generated_li.appendChild(dimensionsDiv);

            dimensionsDiv.appendChild(height_label);
            dimensionsDiv.appendChild(height);

            dimensionsDiv.appendChild(width_label);
            dimensionsDiv.appendChild(width);

            dimensionsDiv.appendChild(length_label);
            dimensionsDiv.appendChild(length);

            dimensionsDiv.appendChild(dimensionsError);

        } else if (selectedOption === 'Book') {

            const weight_label = document.createElement('label');
            weight_label.textContent = 'Weight of Book: '

            const weight = document.createElement('input');
            weight.type = 'number';
            weight.step = '00.01';
            weight.name = 'weight_input';
            weight.placeholder = 'Enter the weight... ';
            weight.className = 'weight-input dimension';

            generated_li.appendChild(weight_label);
            generated_li.appendChild(weight);
        }
    })
</script>
</body>
</html>
