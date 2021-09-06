<?php namespace GromIT\Instagram;

use Backend;
use Exception;
use GromIT\Instagram\Actions\SyncMediaAction;
use GromIT\Instagram\Dto\SyncMediaDto;
use GromIT\Instagram\Models\Account;
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

    public function registerSchedule($schedule)
    {
        $schedule->call(

            /** @throws Exception */

            function () {

                $accounts = Account::query()->get();
                if ($accounts->count()) {
                    foreach ($accounts as $account) {
                        SyncMediaAction::make()->execute(new SyncMediaDto([
                            'account_id' => $account->id,
                        ]));
                    }
                }
            })->dailyAt('09:00');
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
