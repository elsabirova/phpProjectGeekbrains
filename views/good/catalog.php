<h1>Catalog</h1>
<? foreach ($goods as $good): ?>
    <div>
        <a href="/?c=good&a=card&id=<?=$good->id?>"><?=$good->name?></a>
        <p><?=$good->description?></p>
        <p><?=$good->price?></p>
        <button>Buy</button>
    </div>
<? endforeach; ?>
