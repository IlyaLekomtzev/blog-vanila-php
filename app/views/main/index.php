<section class="title">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="py-5">Главная страница</h2>
            </div>
        </div>
    </div>
</section>

<section class="blog">
    <div class="container">
        <div class="row">
            <? if (!empty($news)) { ?>
                <? foreach ($news as $new) { ?>
                    <div class="col-4 mb-3">
                        <div class="card" style="width: 100%;">
                            <img src="<?=$new['image'];?>" class="card-img-top" alt="<?=$new['id'];?>">
                            <div class="card-body">
                                <h5 class="card-title"><?=$new['title'];?></h5>
                                <? if (!empty($new['description'])) { ?>
                                <p class="card-text"><?=$new['description'];?></p>
                                <? } ?>
                                <a href="/blog/<?=$new['slug'];?>" class="card-link">Подробнее</a>
                            </div>
                        </div>
                    </div>
                <? } ?>
            <? } else { ?>
                <h5>Список новостей пуст</h5>
            <? } ?>
        </div>
    </div>
</section>



