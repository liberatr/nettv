<?php

/**
 * @file
 * Contains \Drupal\nettv\Plugin\Block\NetTVBlock.
 */

namespace Drupal\nettv\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\nettv\WatchCartoons;

/**
 * Provides a 'NetTVBlock' block.
 *
 * @Block(
 *  id = "nettv_basicinfo_block",
 *  admin_label = @Translation("NetTV BasicInfo Block"),
 * )
 */
class NetTVBlock extends BlockBase {

  /**
   * Drupal\nettv\WatchCartoons definition.
   *
   * @var Drupal\nettv\WatchCartoons $nettv_service
   */
  protected $nettv_service;

  /**
   * Constructor.
   */
  public function __construct(WatchCartoons $nettv_service) {
    $this->nettv_service = $nettv_service;
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    dsm('yo');
    dsm($this->nettv_service);
    $build = [];
    $build['nettv_basicinfo_block']['#markup'] = $this->nettv_service->getBasicInformation();

    return $build;
  }

}
