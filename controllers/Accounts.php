<?php namespace GromIT\Instagram\Controllers;

use Backend\Behaviors\ListController;
use Backend\Classes\Controller;
use BackendMenu;
use GromIT\Instagram\Actions\CreateAccountAction;
use GromIT\Instagram\Actions\FindAccountAction;
use GromIT\Instagram\Actions\SyncMediaAction;
use GromIT\Instagram\Models\Account;
use GromIT\Instagram\Models\Media;
use GromIT\Instagram\Requests\CreateAccountRequest;
use GromIT\Instagram\Requests\FindAccountRequest;
use GromIT\Instagram\Requests\SyncMediasRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use InstagramScraper\Exception\InstagramException;
use InstagramScraper\Exception\InstagramNotFoundException;
use System\Classes\SettingsManager;

/**
 * Accounts Backend Controller
 */
class Accounts extends Controller
{
    public $implement = [
        ListController::class
    ];

    public $listConfig = 'config_list.yaml';

    public $hiddenActions = [
        'create',
        'update',
        'preview'
    ];

    public function __construct()
    {
        parent::__construct();

        $this->addCss('/plugins/gromit/instagram/assets/css/style.css');

        BackendMenu::setContext('October.System', 'system', 'settings');
        SettingsManager::setContext('GromIT.Instagram', 'instagram');
    }

    public function find_account()
    {
        $this->pageTitle = 'Добавить аккаунт';
    }

    public function account($recordId)
    {
        $account               = Account::query()->find($recordId);
        $this->vars['account'] = $account;
        $this->pageTitle       = $account->username;
    }

    /**
     * @return array
     * @throws \SystemException
     */
    public function onFindInstagramAccount(): array
    {
        $request = app(FindAccountRequest::class);

        try {
            $account = FindAccountAction::make()->execute($request->toDto());
        } catch (InstagramException $e) {
            $account = [];
        } catch (InstagramNotFoundException $e) {
            $account = [];
        }

        $partial = $this->makePartial('partials/form/account_finder_result', [
            'account' => $account
        ]);

        return [
            '#finder_result' => $partial,
        ];
    }

    /**
     * @throws \SystemException
     * @throws \Exception
     */
    public function onSaveInstagramAccount(): RedirectResponse
    {
        $request = app(CreateAccountRequest::class);

        CreateAccountAction::make()->execute($request->toDto());

        return redirect($this->actionUrl('/'));
    }

    /**
     * @throws \SystemException
     * @throws \Exception
     */
    public function onSyncInstagramAccountMedias()
    {
        $request = app(SyncMediasRequest::class);

        SyncMediaAction::make()->execute($request->toDto());

        return redirect()->refresh();
    }

    public function getMedias($accountId, $limit = 12): JsonResponse
    {
        $medias = Media::query()
            ->where('account_id', '=', $accountId)
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();

        $data = [];

        foreach ($medias as $media) {
            $data[$media->id] = [
                'type'           => $media->type,
                'link'           => $media->link,
                'caption'        => $media->caption,
                'likes_count'    => $media->likes_count,
                'comments_count' => $media->comments_count,
            ];
        }

        return $this->jsonResponse($data);
    }

    protected function jsonResponse($data, int $statusCode = 200): JsonResponse
    {
        return response()->json($data, $statusCode, [], JSON_UNESCAPED_UNICODE);
    }

}
