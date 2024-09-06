<?php require 'layout/header.php'; ?>

<?php require 'layout/nav.php'; ?>

<hr class="mx-3 py-2">

<div class="container p-5">
    <div class="main">
        <form id="product_form" action="/product/store" method="post">
            <div id="mandatory" class="mandatory-text p-4">* Please note: all fields are MANDATORY</div>

            <div class="mb-3 w-50 p-1">
                <label for="sku" class="form-label">SKU</label>
                <input type="text" class="form-control" id="sku" name="sku" aria-describedby="skuHelp" placeholder="#sku">
                <div id="skuHelp" class="form-text"></div>
            </div>

            <div class="mb-3 w-50 p-1">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" placeholder="#name">
                <div id="nameHelp" class="form-text"></div>
            </div>

            <div class="mb-3 w-50 p-1">
                <label for="price" class="form-label">Price ($)</label>
                <input type="text" class="form-control" id="price" name="price" aria-describedby="priceHelp" placeholder="#price">
                <div id="priceHelp" class="form-text"></div>
            </div>

            <div class="mb-3 w-50 p-1">
                <label for="productType" class="form-label">Type Switcher:</label>
                <select id="type_switcher" name="switcher" class="form-control">
                    <option selected disabled>Select a type</option>
                    <option id="DVD" value="DVD">DVD</option>
                    <option value="Book">Book</option>
                    <option value="Furniture">Furniture</option>
                </select>
                <div id="switcherHelp" class="form-text"></div>
            </div>

            <div class="mb-3 w-50 p-1">
                <div class="mb-3 w-50 p-1" id="size_field" style="display: none;">
                    <label for="size" class="form-label">Size (MB):</label>
                    <input type="text" class="form-control" id="size" name="size" placeholder="Enter the size...">
                </div>

                <div class="mb-3 w-50 p-1" id="weight_field" style="display: none;">
                    <label for="weight" class="form-label">Weight (KG):</label>
                    <input type="text" class="form-control" id="weight" name="weight" placeholder="Enter the weight...">
                </div>

                <div class="mb-3 w-50 p-1" id="furniture_fields" style="display: none;">
                    <label for="height" class="form-label">Height (CM):</label>
                    <input type="text" class="form-control mb-2" id="height" name="height" placeholder="Enter the height...">

                    <label for="width" class="form-label">Width (CM):</label>
                    <input type="text" class="form-control mb-2" id="width" name="width" placeholder="Enter the width...">

                    <label for="length" class="form-label">Length (CM):</label>
                    <input type="text" class="form-control mb-2" id="length" name="length" placeholder="Enter the length...">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
            <button type="button" onclick="window.location.href='/product/index'" class="btn btn-danger">Cancel</button>
        </form>
    </div>
</div>
<?php require 'layout/footer.php'; ?>

<script>
    $(document).ready(function() {
        $('#product_form').on('submit', function(event) {
            event.preventDefault(); // Prevent the form from submitting

            // Clear previous errors
            $('.form-text').html('');

            // Create FormData object from the form
            let formData = new FormData(this);

            console.log('Form data:', formData);

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log('Server response:', response);
                    let result = JSON.parse(response);

                    if (result.success) {
                        window.location.href = '/product/index';
                    } else {
                        // Display new errors
                        for (let key in result.errors) {
                            $('#' + key + 'Help').html(result.errors[key]);
                        }
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('AJAX error:', textStatus, errorThrown);
                    alert('An error occurred while processing your request.');
                }
            });
        });
    });
    document.addEventListener('DOMContentLoaded', function() {
        let selector = document.getElementById('type_switcher');
        let sizeField = document.getElementById('size_field');
        let weightField = document.getElementById('weight_field');
        let furnitureFields = document.getElementById('furniture_fields');

        selector.addEventListener('change', function () {
            const selectedOption = selector.value;

            // Hide all fields initially
            sizeField.style.display = 'none';
            weightField.style.display = 'none';
            furnitureFields.style.display = 'none';

            // Show relevant fields based on selected option
            if (selectedOption === 'DVD') {
                sizeField.style.display = 'block';
            } else if (selectedOption === 'Furniture') {
                furnitureFields.style.display = 'block';
            } else if (selectedOption === 'Book') {
                weightField.style.display = 'block';
            }
        });
    });
    // document.addEventListener('DOMContentLoaded', function() {
    //     let generated_li = document.querySelector(".generated_li");
    //     let selector = document.getElementById('type_switcher');
    //
    //     selector.addEventListener('change', function () {
    //         const selectedOption = selector.value;
    //         generated_li.innerHTML = ''; // Clear previous inputs
    //
    //         // Show DVD specific fields and hide others
    //         if (selectedOption === 'DVD') {
    //             const dvd_label = document.createElement('label');
    //             dvd_label.setAttribute('for', 'size');
    //             dvd_label.textContent = "Size (MB):";
    //
    //             const dvd = document.createElement('input');
    //             dvd.type = 'text';
    //             dvd.name = 'size';
    //             dvd.id = 'size';
    //             dvd.placeholder = 'Enter the size...';
    //             dvd.className = 'form-control mb-3';
    //
    //             generated_li.appendChild(dvd_label);
    //             generated_li.appendChild(dvd);
    //
    //         } else if (selectedOption === 'Furniture') {
    //             // Show Furniture specific fields and hide others
    //             const height_label = document.createElement('label');
    //             height_label.setAttribute('for', 'height');
    //             height_label.textContent = 'Height (CM):';
    //
    //             const height = document.createElement('input');
    //             height.type = 'text';
    //             height.name = 'height';
    //             height.id = 'height';
    //             height.placeholder = 'Enter the height...';
    //             height.className = 'form-control mb-3';
    //
    //             const width_label = document.createElement('label');
    //             width_label.setAttribute('for', 'width');
    //             width_label.textContent = 'Width (CM):';
    //
    //             const width = document.createElement('input');
    //             width.type = 'text';
    //             width.name = 'width';
    //             width.id = 'width';
    //             width.placeholder = 'Enter the width...';
    //             width.className = 'form-control mb-3';
    //
    //             const length_label = document.createElement('label');
    //             length_label.setAttribute('for', 'length');
    //             length_label.textContent = 'Length (CM):';
    //
    //             const length = document.createElement('input');
    //             length.type = 'text';
    //             length.name = 'length';
    //             length.id = 'length';
    //             length.placeholder = 'Enter the length...';
    //             length.className = 'form-control mb-3';
    //
    //             generated_li.appendChild(height_label);
    //             generated_li.appendChild(height);
    //             generated_li.appendChild(width_label);
    //             generated_li.appendChild(width);
    //             generated_li.appendChild(length_label);
    //             generated_li.appendChild(length);
    //
    //         } else if (selectedOption === 'Book') {
    //             // Show Book specific fields and hide others
    //             const weight_label = document.createElement('label');
    //             weight_label.setAttribute('for', 'weight');
    //             weight_label.textContent = 'Weight (KG):';
    //
    //             const weight = document.createElement('input');
    //             weight.type = 'text';
    //             weight.name = 'weight';
    //             weight.id = 'weight';
    //             weight.placeholder = 'Enter the weight...';
    //             weight.className = 'form-control mb-3';
    //
    //             generated_li.appendChild(weight_label);
    //             generated_li.appendChild(weight);
    //         }
    //     });
    // });
</script>
</body>
</html>
