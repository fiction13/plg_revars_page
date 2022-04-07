<?php
/*
 * @package   plg_revars_page
 * @version   1.0.0
 * @author    Dmitriy Vasyukov - https://fictionlabs.ru
 * @copyright Copyright (c) 2022 Fictionlabs. All rights reserved.
 * @license   GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link      https://fictionlabs.ru/
 */

use Joomla\CMS\Application\CMSApplication;
use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\CMSPlugin;

defined('_JEXEC') or die;

class plgRevarsPage extends CMSPlugin
{
    /**
     * Application object
     *
     * @var    CMSApplication
     * @since  1.0.0
     */
    protected $app;

    /**
     * Affects constructor behavior. If true, language files will be loaded automatically.
     *
     * @var    boolean
     * @since  1.0.0
     */
    protected $autoloadLanguage = true;

    /**
     *
     * @return object[]
     *
     * @since 1.0.0
     */
    public function onRevarsAddVariables()
    {
        $document      = Factory::getDocument();
        $user          = Factory::getUser();
        $userFirstName = explode(' ', $user->name);
        $userLastName  = explode(' ', $user->name);
        $langShort     = explode('-', $document->getLanguage());

        return [
            (object)[
                'variable' => '{VAR_PAGE_TITLE}',
                'value' => $document->getTitle()
            ],
            (object)[
                'variable' => '{VAR_PAGE_LINK}',
                'value' => $document->getBase()
            ],
            (object)[
                'variable' => '{VAR_PAGE_LANGUAGE_FULL}',
                'value' => strtoupper($document->getLanguage())
            ],
            (object)[
                'variable' => '{VAR_PAGE_LANGUAGE_SHORT}',
                'value' => strtoupper(array_shift($langShort))
            ],
            (object)[
                'variable' => '{VAR_PAGE_DESCRIPTION}',
                'value' => $document->getDescription()
            ],
            (object)[
                'variable' => '{VAR_PAGE_USER_NAME}',
                'value' => $user->name
            ],
            (object)[
                'variable' => '{VAR_PAGE_USER_FNAME}',
                'value' => !$user->guest ? end($userFirstName) : ''
            ],
            (object)[
                'variable' => '{VAR_PAGE_USER_LNAME}',
                'value' => !$user->guest ? end($userLastName) : ''
            ],
            (object)[
                'variable' => '{VAR_PAGE_USER_USERNAME}',
                'value' => $user->username
            ],
            (object)[
                'variable' => '{VAR_PAGE_USER_EMAIL}',
                'value' => $user->email
            ]
        ];
    }
}