<?php namespace GromIT\Instagram;

use Backend;
use System\Classes\PluginBase;

/**
 * Instagram Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Instagram',
            'description' => 'Instagram lite-integration',
            'author'      => 'GromIT',
            'icon'        => 'icon-instagram'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {

    }

    public function registerSettings()
    {
        return [
            'instagram' => [
                'label'       => 'Instagram',
                'description' => 'Интеграция с сервисом Instagram',
                'category'    => 'Интеграции',
                'icon'        => 'icon-instagram',
                'url'         => Backend::url('gromit/instagram/accounts'),
                'order'       => 500,
                'keywords'    => 'instagram'
            ]
        ];
    }
}
