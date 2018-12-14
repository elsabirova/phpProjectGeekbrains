<h1>Cart</h1>
<p>
    <? foreach ($cart as $item) { ?>
    <p><?=$item->name?></p>
    <p><?=$item->price?></p>
    <?}?>
</p>