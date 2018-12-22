<h1>Catalog</h1>
<? foreach ($goods as $good): ?>
    <div>
        <a href="/good/card?id=<?=$good->id?>"><?=$good->name?></a>
        <p><?=$good->description?></p>
        <p><?=$good->price?></p>
        <button class="add-to-card" data-id-good="<?=$good->id;?>">Add to cart</button>
    </div>
<? endforeach; ?>
