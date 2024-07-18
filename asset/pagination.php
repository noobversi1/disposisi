<nav aria-label="...">
    <ul class="pagination">
        <?php if ($jumlahhalaman > 10) : ?>
            <?php if ($halamanaktif > 1) : ?>
                <li class="page-item">
                    <a href="?halaman=1" class="page-link"> First </a>
                </li>
                <li class="page-item">
                    <a href="?halaman=<?= $halamanaktif - 1; ?>" class="page-link"> &laquo; </a>
                </li>
            <?php endif; ?>
            <?php for ($i = 1; $i <= 3; $i++) : ?>
                <?php if ($i == $halamanaktif) : ?>
                    <li class="page-item active">
                        <a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a>
                    </li>
                <?php else : ?>
                    <li class="page-item" aria-current="page">
                        <a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a>
                    </li>
                <?php endif; ?>
            <?php endfor; ?>
            <?php for ($i = $jumlahhalaman - 2; $i <= $jumlahhalaman; $i++) : ?>
                <?php if ($i == $halamanaktif) : ?>
                    <li class="page-item active">
                        <a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a>
                    </li>
                <?php else : ?>
                    <li class="page-item" aria-current="page">
                        <a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a>
                    </li>
                <?php endif; ?>
            <?php endfor; ?>
            <?php if ($halamanaktif < $jumlahhalaman) : ?>
                <li class="page-item">
                    <a class="page-link" href="?halaman=<?= $halamanaktif + 1; ?>"> &raquo; </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="?halaman=<?= $jumlahhalaman; ?>"> Last </a>
                </li>
            <?php endif; ?>
        <?php else : ?>
            <?php if ($halamanaktif > 1) : ?>
                <li class="page-item">
                    <a class="page-link" href="?halaman=<?= $halamanaktif - 1; ?>">Previous</a>
                </li>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $jumlahhalaman; $i++) : ?>
                <?php if ($i == $halamanaktif) : ?>
                    <li class="page-item active">
                        <a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a>
                    </li>
                <?php else : ?>
                    <li class="page-item" aria-current="page">
                        <a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a>
                    </li>
                <?php endif; ?>
            <?php endfor; ?>
            <?php if ($halamanaktif < $jumlahhalaman) : ?>
                <li class="page-item">
                    <a class="page-link" href="?halaman=<?= $halamanaktif + 1; ?>">Next</a>
                </li>
            <?php endif; ?>
        <?php endif; ?>
    </ul>
</nav>
<p><small>Halaman : <?= $halamanaktif; ?> dari <?= $jumlahhalaman; ?> halaman</small></p>