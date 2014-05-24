<?php

defined('SYSPATH') or die('No direct script access.');

class ViewHead
{
   private static $scripts = array();
   private static $styles = array();
   private static $capturedScripts = '';

   private static $navigation = array('tab' => '', 'menu' => '');

   public static function addScript( $filename )
   {
      array_push(self::$scripts, $filename);
   }

   public static function addStyle( $filename )
   {
      array_push(self::$styles, $filename);
   }

   public static function hasScripts()
   {
      return (0 == count(self::$scripts)) ? false : true;
   }

   public static function hasCapturedScripts()
   {
      return ( '' == self::$capturedScripts ) ? false : true;
   }

   public static function hasStyles()
   {
      return (0 == count(self::$styles)) ? false : true;
   }

   public static function scriptCaptureStart()
   {
      ob_start();
   }

   public static function scriptCaptureEnd()
   {
      self::$capturedScripts .= ob_get_clean();
      ob_end_flush();
   }

   public static function getCapturedScripts()
   {
      return self::$capturedScripts;
   }

   public static function getNextScript()
   {
      $script = null;
      if( !($script = each(self::$scripts)) )
      {
         reset(self::$scripts);
         return false;
      }
      return $script['value'];
   }

   public static function getNextStyle()
   {
      $style = null;
      if( !($style = each(self::$styles)) )
      {
         reset(self::$styles);
         return false;
      }
      return $style['value'];
   }

   public static function setActiveTab( $name )
   {
      self::$navigation['tab'] = $name;
   }

   public static function setActiveMenu( $name )
   {
      self::$navigation['menu'] = $name;
   }

   public static function getActiveTab()
   {
      return self::$navigation['tab'];
   }

   public static function getActiveMenu()
   {
      return self::$navigation['menu'];
   }

   public static function renderMenu( $name )
   {
      $view = new View('scripts/menus/' . $name);
      return $view;
   }

}