<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\Parse;

class GetData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'get data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $video = new Parse();
        // 先在本程式路徑 建立cookie.txt檔案權限777
        $video->cookie = 'cookie.txt';
        // 網頁位置
        $video->mainUrl = 'ju999.net';
        // 帳號
        $video->txtUser = '';
        // 密碼
        $video->txtPassword = 'QAZwsx888';
        // 取得 index url 並指向
        $video->setIndex();
        // 登入 取得 verify
        $video->login();
        // 取得線路資訊
        $video->getLine();
        // SSO 登入
        $video->sso();
        // 取得列表
        $list = $video->getList();
        // 如果沒爬到資料則重新爬
        while(!$list)
        {
            $list = $video->getList();
        }
        //爬到資料後存進資料庫
        $data = array(
                'content' => preg_replace('/\s(?=)/', '', $list),
                'updated_at' => \Carbon\Carbon::now('Asia/Taipei'),
            );

        \DB::table('data')
            ->where('id', 1)
            ->update($data);
    }
}
