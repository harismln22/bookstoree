<!-- Page Content -->
<div class="single-product">
    <div class="container">
        <div class="row" id="cart-items">
            <div class="col-md-12">
                <div class="section-heading">
                    <div class="line-dec"></div>
                    <h1>Cart</h1>
                </div>
            </div>
            <?php
            $total = 0;
            if (!empty($cart_items)) { // Jika keranjang tidak kosong
                foreach ($cart_items as $index => $item) {
                    $subtotal = $item['book']['price'] * $item['quantity'];
                    $total += $subtotal;
            ?>
                <!-- Item dalam Keranjang -->
                <div class="col-md-3">
                    <div class="product-slider">
                        <div id="slider" class="flexslider">
                            <ul class="slides">
                                <!-- Menampilkan cover_image -->
                                <img src="<?= $item['book']['cover_image'] ?>" alt="<?= $item['book']['title'] ?>" class="img-fluid" />
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="right-content">
                        <h4><?= $item['book']['title'] ?></h4>
                        <h6>Rp <?= number_format($item['book']['price'], 2, ',', '.') ?></h6>
                        <form action="<?= base_url() ?>cart/delete" method="post">
                            <input type="hidden" name="book_id" value="<?= $item['book']['_id']->{'$id'} ?>">
                            <label for="quantity-<?= $index ?>">Quantity:</label>
                            <div class="input-group mb-3" style="max-width: 150px;">
                                <div class="input-group-prepend">
                                    <button class="btn btn-outline-secondary" type="button" id="button-minus-<?= $index ?>">-</button>
                                </div>
                                <input name="quantity" type="number" class="form-control quantity-text" id="quantity-<?= $index ?>"
                                    value="<?= $item['quantity'] ?>" min="1">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" id="button-plus-<?= $index ?>">+</button>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-danger" value="Remove">
                        </form>
                        <div class="down-content">
                            <h6>Subtotal: Rp <span id="subtotal-<?= $index ?>"><?= number_format($subtotal, 2, ',', '.') ?></span></h6>
                        </div>
                    </div>
                    <hr>
                </div>
            <?php 
                }
            } else { 
                echo "<div class='col-md-12'><p>The cart is empty</p></div>";
            } ?>
            <div class="col-md-12">
                <div class="right-content float-right">
                    <h4>Total: Rp <span id="total-price"><?= number_format($total, 2, ',', '.') ?></span></h4>
                    <!-- Tampilkan tombol checkout hanya jika ada item -->
                    <?php if (!empty($cart_items)) { ?>
                        <a href="<?= base_url() ?>checkout/" class="btn btn-success mt-3" id="checkout-button" >Check Out</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Single Page Ends Here -->

<script>
    
    <?php foreach ($cart_items as $index => $item) { ?>
        document.getElementById('button-minus-<?= $index ?>').addEventListener('click', function() {
            var quantityInput = document.getElementById('quantity-<?= $index ?>');
            var currentValue = parseInt(quantityInput.value);
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
                updateSubtotal(<?= $index ?>, <?= $item['book']['price'] ?>);
                updateTotalPrice();
                updateQuantityInDB('<?= $item['book']['_id']->{'$id'} ?>', quantityInput.value);
            }
        });

        document.getElementById('button-plus-<?= $index ?>').addEventListener('click', function() {
            var quantityInput = document.getElementById('quantity-<?= $index ?>');
            var currentValue = parseInt(quantityInput.value);
            quantityInput.value = currentValue + 1;
            updateSubtotal(<?= $index ?>, <?= $item['book']['price'] ?>);
            updateTotalPrice();
            updateQuantityInDB('<?= $item['book']['_id']->{'$id'} ?>', quantityInput.value);
        });

        document.getElementById('quantity-<?= $index ?>').addEventListener('input', function() {
            updateSubtotal(<?= $index ?>, <?= $item['book']['price'] ?>);
            updateTotalPrice();
            updateQuantityInDB('<?= $item['book']['_id']->{'$id'} ?>', this.value);
        });

        function updateSubtotal(index, price) {
            var quantity = parseInt(document.getElementById('quantity-' + index).value);
            var subtotal = quantity * price;
            document.getElementById('subtotal-' + index).innerText = subtotal.toLocaleString('id-ID', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        }
    <?php } ?>

    function updateTotalPrice() {
        var total = 0;
        <?php foreach ($cart_items as $index => $item) { ?>
            var subtotal = parseInt(document.getElementById('subtotal-<?= $index ?>').innerText.replace(/\./g, '').replace(',', '.'));
            total += subtotal;
        <?php } ?>
        document.getElementById('total-price').innerText = total.toLocaleString('id-ID', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    }

    function updateQuantityInDB(book_id, quantity) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '<?= base_url() ?>cart/update_quantity', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('book_id=' + book_id + '&quantity=' + quantity);
    }

    <?php if (!empty($cart_items)) { ?>
        document.getElementById('checkout-button').addEventListener('click', function() {
        // Konfirmasi checkout
        var confirmCheckout = confirm("Are you sure you want to proceed with the checkout?");
        if (confirmCheckout) {
            // Data cart_items yang berisi item yang dipilih
            var cartItems = <?= json_encode($cart_items); ?>;
            
            // Kirim data ke server untuk mengurangi stok
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '<?= base_url() ?>books/updateStock', true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    alert('Checkout successful! Stock updated.');
                    window.location.href = '<?= base_url() ?>index.php';
                }
            };
            window.location.href = '<?= base_url() ?>index.php';
            xhr.send(JSON.stringify({ cart_items: cartItems }));
        }
    });

<?php } ?>

</script>