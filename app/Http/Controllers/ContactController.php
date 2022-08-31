<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendReminderMail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{

    /**
     * 送信されたフォーム情報をチェックしてメールを送信
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->name) {
            return response('お名前を入力してください。', 400);
        }

        if (!$request->email) {
            return response('メールアドレスを入力してください。', 400);
        }

        if (!$request->content) {
            return response('お問い合わせ内容を入力してください。', 400);
        }

        $name = $request->name;
        $email = $request->email;
        $content = $request->content;
        // $ng_words = NgwordsConst::NG_WORDS;

        // for($i=0; $i<count($ng_words); $i++) {
        //     if (strpos($content, $ng_words[$i]) !== false) {
        //         return response('不適切な単語が含まれている可能性があります。', 400);
        //     }
        // }

        // リマインダーメールを送信
        try {
            $data = [
                'name' => $name,
                'email' => $email,
                'content' => $content,
            ];
            Mail::to('re_zell@yahoo.co.jp')->send(new SendReminderMail($data));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response('メール送信処理にエラーが発生しました。', 400);
        }

        return response('OK', 200);
    }

}
