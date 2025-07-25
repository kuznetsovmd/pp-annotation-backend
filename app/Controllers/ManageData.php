<?php

namespace App\Controllers;

use App\Models\Selection;
use App\Models\Policy;
use Engine\Config;
use Engine\Services\DebugService as Debug;
use Engine\Services\AuthService as Auth;
use Engine\Services\FileSystemService as FS;
use Engine\Request;
use Engine\View;
use Engine\Services\RedirectionService as Redirection;

/**
 * ManageData.php
 *
 * Controller class for loading annotation page.
 */
class ManageData
{

    /**
     * Goes to annotation page.
     *
     * @param Request $request
     */
    public static function toDataPage(Request $request)
    {
        $request->view = new View('data.php', [
            'title' => 'Data',
            'id' => Auth::authenticated(),
        ]);
    }

    /**
     * Uploads data for annotation.
     *
     * @param Request $request
     */
    public static function upload(Request $request)
    {
        Redirection::redirect('/home');

        $request->post_response = function () use ($request) {

            $descriptor = $request->parameters['descriptor'];
            $documents = $request->parameters['documents'];
            $key = $request->parameters['key'];
            $tmp_file = $request->parameters['files']['data']['tmp_name'];
            $hash = md5(md5(rand()));

            $archive = "$hash.zip";
            FS::resource($tmp_file, $archive);
            FS::unzip($archive, $hash);

            $json = json_decode(FS::read("$hash/$descriptor"), true);

            $portion = 100;
            $policies = [];
            foreach ($json as $row => $value) {
                $content = FS::read("$hash/$documents/{$value[$key]}");
                $policies[$value['policy_hash']] = str_replace("\r", '', $content);

                if ($portion-- < 1) {
                    Policy::create($policies);
                    $portion = 100;
                    $policies = [];
                }
            }
            Policy::create($policies);
            FS::rmdir($hash, true);

        };

    }

    /**
     * Gives annotation data for download.
     *
     * @param Request $request
     */
    public static function download(Request $request)
    {
        $hash = md5(rand());
        $file = "$hash.json";
        FS::write($file, json_encode(Selection::packWithUsers()));
        FS::download($file, true);
    }

}
