<div class="comments">
    <div class="comments__form mt-4 mb-4">
        <form id="commentForm">
            <div class="form-row">
                <div class="col">
                    <input type="text" class="form-control" name="name" placeholder="Ваше имя">
                </div>
                <div class="col">
                    <input type="email" class="form-control" name="email" placeholder="name@example.com">
                </div>
            </div>
            <div class="form-group mt-3">
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Комментарий" name="body"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Добавить</button>
        </form>
    </div>

    <div class="comments__wrap">
        <?php foreach($data['items'] as $item): ?>
            <div class="comments__body">
                <div class="comment__body">
                    <?=$item["body"]?>
                </div>
                <div class="comment__autor">
                    <span class="comment__name"><?=$item["name"]?></span>
                    <span class="comment__mail">(<a href="mailto:<?=$item["email"]?>"><?=$item["email"]?></a>)</span>
                    <span class="comment__date"><?=$item["dtime"]?></span>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <nav>
        <ul class="pagination justify-content-center" id="paginator">
            <li class="page-item disabled"><a class="page-link" href="#" aria-disabled="true">Страницы:</a></li>
            <?php for($i = 1; $i <= $data["pagesCount"]; $i++):?>
                <?php if($i==1):?>
                    <li class="page-item active"><span class="page-link"><?=$i?></span></li>
                <?php else:?>
                    <li class="page-item"><a class="page-link" href="#" data-pagenum="<?=$i?>"><?=$i?></a></li>
                <?php endif;?>
            <?php endfor;?>
        </ul>
    </nav>
</div>