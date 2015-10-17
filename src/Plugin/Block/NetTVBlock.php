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
 * 
 * ContainerFactoryPluginInterface only has one method you need to implement, which is
 * called create(). Create passes info along to the constructor that was loaded by the
 * service container. In this case I also loaded our block information in create().
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
  protected $basic_info;

  /**
   * Constructs a Drupal\Component\Plugin\PluginBase object.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @var string $basic_info
   *   The information from the WatchCartoons service for this block.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, $basic_info) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->basic_info = $basic_info;
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $build['nettv_basicinfo_block']['#markup'] = $this->basic_info;

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
      //this is not the only way to write this code. You may want to save the Service here instead of the string.
      $container->get('nettv.watch_shows')->getBasicInformation()
    );
  }

}
