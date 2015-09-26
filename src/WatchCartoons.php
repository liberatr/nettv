<?php

/**
 * @file
 * Contains Drupal\nettv\WatchCartoons.
 */

namespace Drupal\nettv;

use Drupal\Core\Config\ConfigFactory;

/**
 * Class WatchCartoons.
 *
 * @package Drupal\nettv
 */
class WatchCartoons {

  /**
   * Drupal\Core\Config\ConfigFactory definition.
   *
   * @var Drupal\Core\Config\ConfigFactory
   */
  protected $config_factory;
  /**
   * Constructor.
   */
  public function __construct(ConfigFactory $config_factory) {
    $this->config_factory = $config_factory;
  }

  public function getBasicInformation() {
    $config = $this->config_factory->get('nettv.watch_cartoons');

    return sprintf(
      'Playlists are sorted by %s and hold %d movies. Movie night is %s.',
      $config->get('playlist.sort'),
      $config->get('playlist.maxlength'),
      $config->get('movienight')
    );
  }
}
