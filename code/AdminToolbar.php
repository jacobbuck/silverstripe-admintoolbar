<?php

class AdminToolbar extends Extension
{
    /**
     * Return rendered AdminToolbar
     * @return HTMLText
     */
    public function getAdminToolbar()
    {
        if (
            !Permission::check('CMS_ACCESS_CMSMain') ||
            !$this->owner ||
            $this->owner->getRequest()->getVar('CMSPreview') === '1' ||
            (defined('SHOW_ADMIN_TOOLBAR') && SHOW_ADMIN_TOOLBAR == false)
        ) {
            return;
        }

        $templateData = array(
            // Custom colors
            'BackgroundColor' => $this->config()->BackgroundColor,
            'ForegroundColor' => $this->config()->ForegroundColor,
            // Nav lists
            'PrimaryNav' => $this->getAdminToolbarPrimaryNav(),
            'SecondaryNav' => $this->getAdminToolbarSecondaryNav()
        );

        return $this->owner
            ->customise($templateData)
            ->renderWith('AdminToolbar');
    }

    /**
     * Get primary nav items
     * @return ArrayList
     */
    public function getAdminToolbarPrimaryNav()
    {
        $nav = ArrayList::create();

        $baseURL = Director::baseURL();

        $nav->push(ArrayData::create(array(
            'Label' => SiteConfig::current_site_config()->Title,
            'Link' => $baseURL,
            'Icon' => $baseURL . ADMINTOOLBAR_DIR . '/images/home.svg#Home'
        )));

        $nav->push(ArrayData::create(array(
            'Label' => _t('AdminToolbar.Admin', 'Admin'),
            'Link' => "{$baseURL}admin",
            'Icon' => $baseURL . ADMINTOOLBAR_DIR . '/images/cog.svg#Cog'
        )));

        // Show draft/published switcher if user can view draft content
        if (Permission::check('VIEW_DRAFT_CONTENT')) {
            if (Versioned::current_stage() === 'Stage') {
                $nav->push(ArrayData::create(array(
                    'Label' => _t('AdminToolbar.Draft', 'Draft'),
                    'Title' => _t('AdminToolbar.SwitchToPublishedSite', 'Switch to published site'),
                    'Link' => "{$this->owner->Link()}?stage=Live",
                    'Icon' => $baseURL . ADMINTOOLBAR_DIR . '/images/eye-with-line.svg#Eye_with_line'
                )));
            } elseif (Versioned::current_stage() === 'Live') {
                $nav->push(ArrayData::create(array(
                    'Label' => _t('AdminToolbar.Published', 'Published'),
                    'Title' => _t('AdminToolbar.SwitchToDraftSite', 'Switch to draft site'),
                    'Link' => "{$this->owner->Link()}?stage=Stage",
                    'Icon' => $baseURL . ADMINTOOLBAR_DIR . '/images/eye.svg#Eye'
                )));
            }
        }

        // Show edit link if user can edit content
        if (
            $this->owner->data()->ID > 0 &&
            $this->owner->data()->canEdit() &&
            $this->owner->data()->CMSEditLink()
        ) {
            // Generate friendly name. e.g. "AwesomePage" -> "Awesome Page"
            // @see FormField::name_to_label()
            $niceClassName = preg_replace("/([a-z]+)([A-Z])/", "$1 $2", $this->owner->data()->ClassName);

            $nav->push(ArrayData::create(array(
                'Label' => _t('AdminToolbar.EditThing', 'Edit {thing}',
                    array('thing' => $niceClassName)),
                'Link' =>"{$baseURL}{$this->owner->data()->CMSEditLink()}",
                'Icon' => $baseURL . ADMINTOOLBAR_DIR . '/images/new-message.svg#New_message'
            )));
        }

        return $nav;
    }

    /**
     * Get secondary nav items
     * @return ArrayList
     */
    public function getAdminToolbarSecondaryNav()
    {
        $secondaryNav = ArrayList::create();

        $baseURL = Director::baseURL();

        $secondaryNav->push(ArrayData::create(array(
            'Label' => _t('AdminToolbar.Name', 'Hi {name}',
                array('name' => Member::currentUser()->FirstName)),
            'Link' => "{$baseURL}admin/myprofile",
            'Icon' => $baseURL . ADMINTOOLBAR_DIR . '/images/user.svg#User'
        )));

        $secondaryNav->push(ArrayData::create(array(
            'Label' => _t('AdminToolbar.LogOut', 'Log out'),
            'Link' =>  "{$baseURL}Security/logout",
            'Icon' => $baseURL . ADMINTOOLBAR_DIR . '/images/log-out.svg#Log_out'
        )));

        return $secondaryNav;
    }

    /**
     * Get a configuration accessor for this class.
     * @see Object::config()
     * @return Config_ForClass|null
     */
    public static function config()
    {
        return Config::inst()->forClass(get_called_class());
    }
}
