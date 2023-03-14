<?php
/**
 * This file is part of openai-swow
 *
 * @link    https://github.com/swow-cloud/openai-swow
 * @contact Peter he <847050412@qq.com>
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code
 */

declare(strict_types=1);

use Swow\PhpCsFixer\Config;

require __DIR__ . '/vendor/autoload.php';

return (new Config())
    ->setHeaderComment(
        projectName: 'openai-swow',
        projectLink: 'https://github.com/swow-cloud/openai-swow',
        contactName: 'Peter he',
        contactMail: '847050412@qq.com'
    )->setFinder(
        PhpCsFixer\Finder::create()
            ->in([
                __DIR__ . '/src',
            ])
            ->append([
                __FILE__,
                __DIR__ . '/rector.php',
            ])
    );
