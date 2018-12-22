<h1>Cart</h1>
<? if (empty($cart)): ?>
    Cart is empty.
<? else: ?>
    <table class="cart-table">
        <tr>
            <th>Product Details</th>
            <th>Price</th>
            <th>Quantity</th>
            <!--<th>Subtotal</th>-->
            <th>ACTION</th>
        </tr>
        <? foreach ($cart as $item):?>
            <tr>
                <td>
                    <!--<img src="img/into-cart.jpg" alt="product">-->
                    <p><?=$item->good_name ?></p>
                </td>
                <td>&#36;<?=$item->good_price ?></td>
                <td><input type="number" min="1" max="10000" value="<?=$item->quantity; ?>"></td>
                <!--<td>&#36;300</td>-->
                <td>
                    <button class="cart-delete" data-id-good="<?=$item->id;?>">Delete</button>
                </td>
            </tr>
        <? endforeach; ?>
    </table>
    <p>Amount : <?=$amount; ?></p>
    <p><a href="/order/">Checkout</a></p>
<? endif; ?>
