<h1>Catalog</h1>
<p>
    <? foreach ($goods as $good) { ?>
        <h3><?=$good->name?></h3>
        <p><?=$good->description?></p>
        <p><?=$good->price?></p>
        <button>Buy</button>
    <?  } ?>
</p>