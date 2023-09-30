<?php

namespace TomatoPHP\TomatoAdmin\Services;

use Illuminate\Support\Collection;

class TomatoSlots
{
    private array $navAfterUserDropdown   = [];
    private array $navBeforeUserDropdown  = [];
    private array $navLeftSide            = [];
    private array $sidebarTop             = [];
    private array $sidebarBottom          = [];
    private array $footer                 = [];
    private array $dashboardBottom        = [];
    private array $dashboardTop           = [];
    private array $layoutButtons          = [];
    private array $layoutTitle            = [];
    private array $layoutTop              = [];
    private array $layoutBottom           = [];
    private array $logoSection            = [];

    /**
     * @param string $navAfterUserDropdown
     * @return $this
     */
    public function navAfterUserDropdown(string $navAfterUserDropdown): static
    {
        $this->navAfterUserDropdown[] = $navAfterUserDropdown;
        return $this;
    }

    /**
     * @param string $navBeforeUserDropdown
     * @return $this
     */
    public function navBeforeUserDropdown(string $navBeforeUserDropdown): static
    {
        $this->navBeforeUserDropdown[] = $navBeforeUserDropdown;
        return $this;
    }


    /**
     * @param string $navLeftSide
     * @return $this
     */
    public function navLeftSide(string $navLeftSide): static
    {
        $this->navLeftSide[] = $navLeftSide;
        return $this;
    }


    /**
     * @param string $sidebarTop
     * @return $this
     */
    public function sidebarTop(string $sidebarTop): static
    {
        $this->sidebarTop[] = $sidebarTop;
        return $this;
    }

    /**
     * @param string $sidebarBottom
     * @return $this
     */
    public function sidebarBottom(string $sidebarBottom): static
    {
        $this->sidebarBottom[] = $sidebarBottom;
        return $this;
    }

    /**
     * @param string $footer
     * @return $this
     */
    public function footer(string $footer): static
    {
        $this->footer[] = $footer;
        return $this;
    }

    /**
     * @param string $dashboardBottom
     * @return $this
     */
    public function dashboardBottom(string $dashboardBottom): static
    {
        $this->dashboardBottom[] = $dashboardBottom;
        return $this;
    }

    /**
     * @param string $dashboardTop
     * @return $this
     */
    public function dashboardTop(string $dashboardTop): static
    {
        $this->dashboardTop[] = $dashboardTop;
        return $this;
    }

    /**
     * @param string $layoutButtons
     * @return $this
     */
    public function layoutButtons(string $layoutButtons): static
    {
        $this->layoutButtons[] = $layoutButtons;
        return $this;
    }

    /**
     * @param string $layoutTitle
     * @return $this
     */
    public function layoutTitle(string $layoutTitle): static
    {
        $this->layoutTitle[] = $layoutTitle;
        return $this;
    }

    /**
     * @param string $layoutTop
     * @return $this
     */
    public function layoutTop(string $layoutTop): static
    {
        $this->layoutTop[] = $layoutTop;
        return $this;
    }

    /**
     * @param string $layoutBottom
     * @return $this
     */
    public function layoutBottom(string $layoutBottom): static
    {
        $this->layoutBottom[] = $layoutBottom;
        return $this;
    }

    /**
     * @param string $logoSection
     * @return $this
     */
    public function logoSection(string $logoSection): static
    {
        $this->logoSection[] = $logoSection;
        return $this;
    }

    /**
     * @return array
     */
    public function getNavAfterUserDropdown(): array
    {
        return $this->navAfterUserDropdown;
    }

    /**
     * @return array
     */
    public function getNavBeforeUserDropdown(): array
    {
        return $this->navBeforeUserDropdown;
    }

    /**
     * @return array
     */
    public function getNavLeftSide(): array
    {
        return $this->navLeftSide;
    }

    /**
     * @return array
     */
    public function getSidebarTop(): array
    {
        return $this->sidebarTop;
    }

    /**
     * @return array
     */
    public function getsidebarBottom(): array
    {
        return $this->sidebarBottom;
    }

    /**
     * @return array
     */
    public function getFooter(): array
    {
        return $this->footer;
    }

    /**
     * @return array
     */
    public function getdashboardBottom(): array
    {
        return $this->dashboardBottom;
    }

    /**
     * @return array
     */
    public function getDashboardTop(): array
    {
        return $this->dashboardTop;
    }

    /**
     * @return array
     */
    public function getLayoutButtons(): array
    {
        return $this->layoutButtons;
    }

    /**
     * @return array
     */
    public function getLayoutTitle(): array
    {
        return $this->layoutTitle;
    }

    /**
     * @return array
     */
    public function getLayoutTop(): array
    {
        return $this->layoutTop;
    }

    /**
     * @return array
     */
    public function getlayoutBottom(): array
    {
        return $this->layoutBottom;
    }

    /**
     * @return array
     */
    public function getLogoSection(): array
    {
        return $this->logoSection;
    }
}
