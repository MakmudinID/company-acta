<div class="styled-pagination text-center">
    <ul class="clearfix">
        <?php if ($pager->hasPrevious()) : ?>
            <li>
                <a href="<?= $pager->getFirst() ?>" aria-label="<?= lang('Pager.first') ?>">
                    <?= lang('Pager.first') ?>
                </a>
            </li>
            <li class="prev">
                <a href="<?= $pager->getPrevious() ?>"><?= lang('Pager.previous') ?></a>
            </li>
        <?php endif ?>
        <?php foreach ($pager->links() as $link) : ?>
            <li <?= $link['active'] ? 'class="active"' : '' ?>>
                <a href="<?= $link['uri'] ?>"><?= $link['title'] ?></a>
            </li>
        <?php endforeach ?>
        <?php if ($pager->hasNext()) : ?>
            <li class="next">
                <a href="<?= $pager->getNext() ?>"><?= lang('Pager.next') ?></a>
            </li>
            <li>
                <a href="<?= $pager->getLast() ?>">
                    <?= lang('Pager.last') ?>
                </a>
            </li>
        <?php endif ?>
    </ul>
</div>