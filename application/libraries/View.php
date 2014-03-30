<?php defined('BASEPATH') OR exit('No direct script access allowed');

class View
{
  /**
   * [$TLS TWIG LOADER STRING]
   * @var [Twig_Loader_String]
   */
  private static $TLS;
  /**
   * [$TES TWIG ENVIROMENT STRING]
   * @var [Twig_Enviroment]
   */
  private static $TES;
  /**
   * [$TLF TWIG LOADER FILESYSTEM]
   * @var [Twig_Loader_Filesystem]
   */
  private static $TLF;
  /**
   * [$TEF TWIG ENVIROMENT FILESYSTEM]
   * @var [Twig_Enviroment]
   */
  private static $TEF;

  /**
   * [__construct Implementation Twig]
   * @param array $TEFConfig [Twig Enviroment Filesystem Config]
   */
  function __construct($TEFConfig = array(
    'cache' => CACHEPATH, 
    'auto_reload' => true))
  {
    /**
     * Setting Twig Enviroment String
     */
    self::$TLS = new Twig_Loader_String();
    self::$TES = new Twig_Environment(self::$TLS);
    /**
     * Setting Twig Enviroment Filesystem
     */
    self::$TLF = new Twig_Loader_Filesystem(VIEWPATH);
    self::$TEF = new Twig_Environment(self::$TLF, $TEFConfig);
  }

  /**
   * [make Display or Render to File or String]
   * @param  [String]  $template [String or File]
   * @param  [Array]  $data     [Data]
   * @param  boolean $display
   * @return [NULL or String] [display or String]
   */
  static function make($template, $data = array(), $display = TRUE)
  {
    /**
     * [$TE Twig Enviroment]
     * @var [Twig_Enviroment]
     */
    $TE = (file_exists(VIEWPATH.$template) ? self::$TEF : self::$TES);
    if (!$display) return $TE->render($template, $data);
    $TE->display($template, $data);
  }
}

/* End of file View.php */
/* Location: ./application/libraries/View.php */