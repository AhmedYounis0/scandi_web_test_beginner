<?php

namespace MVC\controllers;

use MVC\core\Controller;
use MVC\core\Database;
use MVC\models\Product;

class ProductController extends Controller
{
    public $productModel;

    public function __construct()
    {
        $this->productModel = new Product();
    }
    public function index()
    {
        $products = $this->productModel->getProducts();
        $this->view('products', ['products' => $products,'title'=>'Products']);
    }

    public function create()
    {
        $this->view('add-product',['title'=>'Add Product']);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->productModel->setSku($_POST['sku']);
            $this->productModel->setName($_POST['name']);
            $this->productModel->setPrice($_POST['price']);

            if (isset($_POST['switcher'])) {
                $switcher = $this->productModel->setSwitcher($_POST['switcher']);
                switch ($switcher) {
                    case 'DVD':
                        $this->productModel->setSize($_POST['size']);
                        break;
                    case 'Book':
                        $this->productModel->setSize($_POST['weight']);
                        break;
                    case 'Furniture':
                        $this->productModel->setHeight($_POST['height']);
                        $this->productModel->setWidth($_POST['width']);
                        $this->productModel->setLength($_POST['length']);
                        break;
                    default:
                        $this->productModel->setSwitcher(null);
                        break;
                }
            } else {
                $this->productModel->setSwitcher(null);
            }

            $validation = $this->productModel->validateProduct();
            if (empty($validation)) {
                $this->productModel->insert();
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'errors' => $validation]);
            }
        }
    }

    public function deleteProducts()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Validate the incoming data
            if (isset($_POST['product_selected']) && is_array($_POST['product_selected'])) {
                $productIds = $_POST['product_selected'];

                foreach ($productIds as $sku) {
                    $this->productModel->Delete($sku);
                }

                // Return a JSON response to the AJAX call
                echo json_encode(['status' => 'success']);
            } else {
                // Handle the case where no products were selected
                echo json_encode(['status' => 'error', 'message' => 'No products selected for deletion.']);
            }
        }
    }


}