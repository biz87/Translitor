<?php
/** @var xPDOTransport $transport */
/** @var array $options */
/** @var modX $modx */
if ($transport->xpdo) {
    $modx =& $transport->xpdo;

    $dev = MODX_BASE_PATH . 'Extras/translitor/';
    /** @var xPDOCacheManager $cache */
    $cache = $modx->getCacheManager();
    if (file_exists($dev) && $cache) {
        if (!is_link($dev . 'assets/components/translitor')) {
            $cache->deleteTree(
                $dev . 'assets/components/translitor/',
                ['deleteTop' => true, 'skipDirs' => false, 'extensions' => []]
            );
            symlink(MODX_ASSETS_PATH . 'components/translitor/', $dev . 'assets/components/translitor');
        }
        if (!is_link($dev . 'core/components/translitor')) {
            $cache->deleteTree(
                $dev . 'core/components/translitor/',
                ['deleteTop' => true, 'skipDirs' => false, 'extensions' => []]
            );
            symlink(MODX_CORE_PATH . 'components/translitor/', $dev . 'core/components/translitor');
        }
    }
}

return true;