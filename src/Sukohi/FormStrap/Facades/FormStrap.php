<?php namespace Sukohi\FormStrap\Facades;

use Illuminate\Support\Facades\Facade;

class FormStrap extends Facade {

  /**
   * コンポーネントの登録名を取得
   *
   * @return string
   */
  protected static function getFacadeAccessor() { return 'form-strap'; }

}