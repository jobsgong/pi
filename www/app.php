<?php
/**
 * Pi Engine (http://piengine.org)
 *
 * Pi Engine application entry
 *
 * @link            http://code.piengine.org for the Pi Engine source repository
 * @copyright       Copyright (c) Pi Engine http://piengine.org
 * @license         http://piengine.org/license.txt BSD 3-Clause License
 * @author          Taiwen Jiang <taiwenjiang@tsinghua.org.cn>
 */

define('APPLICATION_ENGINE', getenv('APPLICATION_ENGINE') ?: 'Standard');
define('PI_BOOT_ENABLE', 1);

include realpath('./boot.php');
