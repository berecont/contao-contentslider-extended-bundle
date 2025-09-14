<?php

declare(strict_types=1);

namespace Berecont\ContentSliderExtendedBundle\ContaoManager;

use Berecont\ContentSliderExtendedBundle\BerecontContentSliderExtendedBundle;
use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;

final class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(BerecontContentSliderExtendedBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class]),
        ];
    }
}