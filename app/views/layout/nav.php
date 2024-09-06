<nav class="navbar">
    <div class="container-fluid">
        <h1 class="navbar-brand"><?= $title ?></h1>
        <span class="d-flex">
            <?php if ($title == 'Product List') : ?>
            <a href="/product/create" class="btn btn-dark m-2" type="submit">ADD</a>
                <button class="btn btn-dark m-2" id="delete-product-btn" type="submit">MASS DELETE</button>
            <?php endif; ?>
        </span>
    </div>
</nav>