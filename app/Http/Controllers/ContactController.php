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
        $ng_words = NgWord::all()->pluck('ng_word')->toArray();

        for($i=0; $i<count($ng_words); $i++) {
            if (strpos($content, $ng_words[$i]) !== false) {
                return response('不適切な単語が含まれている可能性があります。', 400);
            }
        }

        Contact::create([
            'name' => $name,
            'email' => $email,
            'content' => $content
        ]);

        return response('OK', 200);
    }

}
