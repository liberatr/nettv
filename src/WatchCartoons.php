<?php

/**
 * @file
 * Contains Drupal\nettv\WatchCartoons.
 *
 * This class is tied into Drupal's config, but it doesn't have to be.
 * As long as you implement a getBasicInformation() method, you can
 * rewrite this service without having to rewrite the block plugin code.
 *
 * This code also shows how to use the new form of the l() function.
 *
 */

namespace Drupal\nettv;

use Drupal\Core\Config\ConfigFactory;
use Drupal\Core\Url;

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
    $config = $this->config_factory->get('nettv.basic_information');

    return sprintf(
      'Playlists are sorted by %s and hold %d movies. Movie night is %s. Check out %s for more.',
      $config->get('playlist.sort'),
      $config->get('playlist.maxlength'),
      $config->get('movienight'),
      \Drupal::l('this website', Url::fromUri($config->get('url')))
    );
  }
}
