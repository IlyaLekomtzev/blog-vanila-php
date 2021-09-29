<section class="add">
    <div class="container">
        <div class="row">
            <? if (isset($_GET['result']) && $_GET['result'] === 'success') { ?>
                <div class="col-12 mt-3">
                    <div class="alert alert-success" role="alert">
                        Статья успешно добавлена
                    </div>
                </div>
            <? } elseif (isset($_GET['result']) && $_GET['result'] === 'error') { ?>
                <div class="col-12 mt-3">
                    <div class="alert alert-danger" role="alert">
                        Произошла ошибка, попробуйте ещё
                    </div>
                </div>
            <? } ?>

            <?
            if (!empty($errors)){
                debug($errors);
            }
            ?>
            <div class="col-12">
                <div class="card my-3">
                    <h5 class="card-header">Добавление статьи</h5>
                    <div class="card-body">
                        <form action="/add/submit" method="POST">
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label for="title" class="form-label">Название</label>
                                    <input type="text" class="form-control" id="title" name="title" minlength="1" maxlength="255" required>
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="image" class="form-label">Ссылка на изображение</label>
                                    <input type="text" class="form-control" name="image" id="image" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label for="description" class="form-label">Описание для анонса</label>
                                    <textarea class="form-control" id="description" name="description" minlength="1" maxlength="255" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label for="full_description" class="form-label">Детальное описание</label>
                                    <textarea class="form-control" id="full_description" name="full_description" minlength="1" rows="15" required></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label for="category" class="form-label">Категория</label>
                                    <select class="form-select" id="category" name="category" required>
                                        <option value="Разработка" selected>Разработка</option>
                                        <option value="Дизайн">Дизайн</option>
                                        <option value="Администрирование">Администрирование</option>
                                        <option value="Менеджмент">Менеджмент</option>
                                        <option value="Маркетинг">Маркетинг</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Добавить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>