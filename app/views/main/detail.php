<section class="detail py-5">
    <div class="container">
        <div class="row">
            <? if (!empty($data['image'])) { ?>
            <div class="col-12">
                <div style="width: 100%; height: 600px; overflow: hidden; background-image: url('<?=$data['image'];?>'); background-size: cover; background-position: center; background-repeat: no-repeat; border-radius: 10px;"></div>
            </div>
            <? } ?>
            <? if (!empty($data['title'])) { ?>
            <div class="col-12">
                <h1 class="pt-5"><?=$data['title'];?></h1>
                <span class="badge bg-<?= !empty($colors) ? $colors[rand(0, 4)] : 'primary';?>"><?=$data['category'];?></span>
            </div>
            <? } ?>
            <? if (!empty($data['detail_description'])) { ?>
            <div class="col-12 mt-4">
                <p class="fs-5 text-muted" style="white-space: pre-wrap;"><?=$data['detail_description'];?></p>
            </div>
            <? } ?>
            <? if (!empty($data['id'])) { ?>
            <div class="col-12 mt-4">
                <div class="d-flex">
                    <a href="/edit/<?=$data['id'];?>" class="btn btn-success">Редактировать</a>
                    <a href="/delete/<?=$data['id'];?>" class="btn btn-danger mx-3">Удалить</a>
                </div>
            </div>
            <? } ?>
        </div>
    </div>
</section>

