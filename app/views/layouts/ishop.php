<?php

use \wfm\View;

/** @var $this View */

?>
<?php $this->getPart('parts/header') ?>
<p>Title ishop</p>
<?= $this->content;?>
<?php $this->getDbLogs(); ?>
<?php $this->getPart('parts/footer') ?>
