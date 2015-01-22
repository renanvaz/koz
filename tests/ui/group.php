<article class="container-test <?php echo $reports['status'] ? '' : 'open'; ?>" <?php echo $reports['status'] ? 'u-pass' : 'u-error'; ?>>
    <header>
        <span class="fa fa-times red"></span>
        <span class="fa fa-check green"></span>
        <?php echo isset($reports['description']) ? '<h1>'.$reports['description'].'</h1>' : '' ?>
        <span class="fa fa-plus right gray"></span>
        <span class="fa fa-minus right gray"></span>
    </header>
    <section class="content">
        <?php foreach($reports['reports'] as $report): ?>
            <?php if (isset($report['reports'])): ?>
                <?php echo UCore::view('ui/group.php', ['reports' => $report]); ?>
            <?php else: ?>
                <div <?php echo $report['status'] ? 'u-pass' : 'u-error'; ?>>
                    <span class="fa fa-times red"></span>
                    <span class="fa fa-check green"></span>
                    <?php echo $report['description']; ?>
                    <?php if (!$report['status']): ?>
                    <div class="snippet"><?php echo UCore::getSnippet($report['trace']['file'], $report['trace']['line']); ?></div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </section>
</article>
