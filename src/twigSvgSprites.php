<?php

namespace Drupal\biko_svgsprites;

/**
 * extend Drupal's Twig_Extension class
 */
class twigSvgSprites extends \Twig_Extension {

  /**
   * {@inheritdoc}
   * Let Drupal know the name of your extension
   * must be unique name, string
   */
  public function getName() {
    return 'biko_svgsprites.twigSvgSprites';
  }

  /**
   * {@inheritdoc}
   * Return your custom twig function to Drupal
   */
  public function getFunctions() {
    return [
      new \Twig_SimpleFunction('svgSprite', array($this, 'svgSprite'),array('is_safe'=>array('html'))),
    ];
  }
  /**
   * {@inheritdoc}
   * Return your custom twig filter to Drupal
   */
  /*public function getFilters() {
    return [
      new \Twig_SimpleFunction('replace_tokens', [$this, 'replace_tokens']),
    ];
  }*/
  /**
   * Returns $_GET query parameter
   *
   * @param string $name
   *   name of the query parameter
   *
   * @return string
   *   value of the query parameter name
   */
  public static function svgSprite($name,$iconClass = null) {

    $theme_handler = \Drupal::service('theme_handler');
    $default_theme = $theme_handler->getDefault();
    $theme_path = $theme_handler->getTheme($default_theme)->getPath();
    $output = '<svg class="icon ' . $iconClass .' svg--' . $name . '-dims'  .  '">';
    $output .= '<use xlink:href="/' . $theme_path . '/assets/svg/sprite/sprite.svg#' . $name . '"></use></svg>';
    return $output;
  }

  /**
   * Replaces available values to entered tokens
   * Also accept HTML text
   *
   * @param string $text
   *   replaceable tokens with/without entered HTML text
   *
   * @return string
   *   replaced token values with/without entered HTML text
   */
  public function replace_tokens($text) {
    return \Drupal::token()->replace($text);
  }
}
