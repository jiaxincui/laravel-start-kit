<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class UpgradeController extends Controller
{
    private $fitVersion = '0.1.0';

    public function index()
    {
        return response()->json(['data' => [
            'data_version' => $this->getDataVersion(),
            'program_version' => config('settings.version'),
            'upgradable' => version_compare($this->getDataVersion(), $this->fitVersion) === 0
        ]]);
    }

    public function run()
    {
        abort_if(!request()->user()->isSuper(), 403, 'no permission');
        if (version_compare($this->getDataVersion(), $this->fitVersion) !== 0) {
            throw ValidationException::withMessages([
                'error' => ['当前版本不适合此升级程序'],
            ]);
        }
        //以上为模版

        // 升级逻辑

        //以下为模版
        $this->setDataVersion(config('settings.version'));
        return response()->json(['message' => '数据库已升级']);
    }

    public function getDataVersion()
    {
        return '';
    }

    public function setDataVersion($version)
    {
        return '';
    }
}
