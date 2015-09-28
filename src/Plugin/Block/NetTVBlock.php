<?php

/**
 * @file
 * Contains \Drupal\nettv\Plugin\Block\NetTVBlock.
 *
 * This block plugin does the minimum amount of work to load the watch_shows service.
 * The service can be switched out if the new one exposes a getBasicInformation method.
 *
 * This block uses the ContainerFactoryPluginInterface to handle dependency injection,
 * (using the service container) so the service is loaded outside of the build() method.
 */

namespace Drupal\nettv\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\nettv\WatchCartoons;

/**
 * Provides a 'NetTVBlock' block.
 *
 * @Block(
 *  id = "nettv_basicinfo_block",
 *  admin_label = @Translation("NetTV BasicInfo Block"),
 * )
 */
class NetTVBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * Drupal\nettv\WatchCartoons definition.
   */
  protected $nettv_service;

  /**
   * Constructs a Drupal\Component\Plugin\PluginBase object.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @var string $nettv_service
   *   The basic info from the WatchCartoons service for this block.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, $nettv_service) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->nettv_service = $nettv_service;
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $build['nettv_basicinfo_block']['#markup'] = $this->nettv_service;

    return $build;
  }

    /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('nettv.watch_shows')->getBasicInformation()
    );
  }

}
