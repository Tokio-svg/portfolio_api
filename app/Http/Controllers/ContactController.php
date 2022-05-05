<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\NgWord;

class ContactController extends Controller
{

    /**
     * 送信されたフォーム情報をチェックしてDBに保存
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->has('name')) {
            return response('お名前を入力してください。', 400);
        }

        if (!$request->has('email')) {
            return response('メールアドレスを入力してください。', 400);
        }

        if (!$request->has('content')) {
            return response('お問い合わせ内容を入力してください。', 400);
        }

        $name = $request->name;
        $email = $request->email;
        $content = $request->content;
        $ng_words = NgWord::all()->pluck('ng_word')->toArray();

        $include_keyword = in_array($content, $ng_words, true);
        if ($include_keyword) {
            return response('不適切な単語が含まれている可能性があります。', 400);
        }

        Contact::create([
            'name' => $name,
            'email' => $email,
            'content' => $content
        ]);

        return response('OK', 200);
    }

}
