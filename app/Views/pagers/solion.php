<div class="row mb-3">
    <div class="col-md-12 pagi-area text-center">
        <nav aria-label="navigation">
            <ul class="pagination">
                <?php if ($pager->hasPrevious()) : ?>
                    <li class="page-item">
                        <a class="page-link" href="<?= $pager->getFirst() ?>"><i class="fas fa-angle-double-left"></i></a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="<?= $pager->getPrevious() ?>"><?= lang('Pager.previous') ?></a>
                    </li>
                <?php endif ?>
                <?php foreach ($pager->links() as $link) : ?>
                    <li class="page-item <?= $link['active'] ? 'active"' : '' ?>">
                        <a class="page-link" href="<?= $link['uri'] ?>"><?= $link['title'] ?></a>
                    </li>
                <?php endforeach ?>
                <?php if ($pager->hasNext()) : ?>
                    <li class="page-item">
                        <a class="page-link" href="<?= $pager->getNext() ?>"><?= lang('Pager.next') ?></a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="<?= $pager->getLast() ?>"><i class="fas fa-angle-double-right"></i></a>
                    </li>
                <?php endif ?>
            </ul>
        </nav>
    </div>
</div>