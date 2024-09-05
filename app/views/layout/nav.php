<nav class="navbar">
    <div class="container-fluid">
        <h1 class="navbar-brand">Product List</h1>
        <span class="d-flex">
            <?php if ($title == 'Products') : ?>
            <a href="/product/create" class="btn btn-dark m-2" type="submit">Add</a>
<!--            <form method="post" id="delete-form">-->
                <button class="btn btn-dark m-2" id="delete-product-btn" type="submit">Mass Delete</button>
<!--            </form>-->
            <?php endif; ?>
        </span>
    </div>
</nav>