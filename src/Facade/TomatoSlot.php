<?php

namespace TomatoPHP\TomatoAdmin\Facade;

use Illuminate\Support\Facades\Facade;
use TomatoPHP\TomatoAdmin\Views\Widget;

/**
 *  @method static navAfterUserDropdown(string $navAfterUserDropdown)
 * @method static navBeforeUserDropdown(string $navBeforeUserDropdown)
 * @method static navLeftSide(string $navLeftSide)
 * @method static sidebarTop(string $sidebarTop)
 * @method static sidebarBottom(string $sidebarBottom)
 * @method static footer(string $footer)
 * @method static dashboardBottom(string $dashboardBottom)
 * @method static dashboardTop(string $dashboardTop)
 * @method static layoutButtons(string $layoutButtons)
 * @method static layoutTitle(string $layoutTitle)
 * @method static layoutTop(string $layoutTop)
 * @method static layoutBottom(string $layoutBottom)
 * @method static layoutButtoms(string $layoutButtoms)
 * @method static logoSection(string $logoSection)
 * @method array getNavAfterUserDropdown()
 * @method array getNavBeforeUserDropdown()
 * @method array getNavLeftSide()
 * @method array getSidebarTop()
 * @method array getSidebarBottom()
 * @method array getFooter()
 * @method array getDashboardDown()
 * @method array getDashboardTop()
 * @method array getLayoutButtons()
 * @method array getLayoutBottom()
 * @method array getLayoutTitle()
 * @method array getLayoutTop()
 * @method array getDashboardBottom()
 * @method array getLogoSection()
 */
class TomatoSlot extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'tomato-slot';
    }
}
