<?php

return [
    'required' => ':attributeは必須です',
    'email'    => '有効な:attribute形式で入力してください',
    'unique'   => 'この:attributeは既に登録されています',
    'confirmed'=> ':attributeが一致しません',
    'min'      => [
        'string' => ':attributeは:min文字以上で入力してください',
    ],
    // フォームの項目名を日本語に変換する設定
    'attributes' => [
        // 'name'     => 'アカウント名',
        'email'    => 'メールアドレス',
        'password' => 'パスワード',
        'password_confirmation' => '確認用パスワード',
    ],
];