<?php

function sendMail4Admin($subject, $message)
{
    $sys = getSystem();
    $subject2 = "【".$sys->site_title."】".$subject;

    $message .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    $message .= "■Smafee\n";
    $message .= $sys->home."\n";
    $message .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";

    $headers = 'From:"'.mb_encode_mimeheader($sys->mail_name).'" <'. trim($sys->mail_address).'>';
    mb_send_mail($sys->mail_address, $subject2, $message, $headers);
}

function sendMailFromAdmin($to, $subject, $message)
{
    $sys = getSystem();
    mb_language("Japanese");
    mb_internal_encoding("UTF-8");
    
    $subject2 = "【".$sys->site_title."】".$subject;

    $headers = 'From:"'.mb_encode_mimeheader($sys->mail_name).'" <'. trim($sys->mail_address).'>';
    $headers .= "\n";

    $sv=$_SERVER['SCRIPT_FILENAME'];
    if (strpos($sv, 'smafee.jp') !== false) {
        $headers .= 'Bcc: duplicate@smafee.jp';
    } elseif (strpos($sv, '510ti.com') !== false) {
        $headers .= 'Bcc: duplicate@smafee.jp';
    } else {
    }
    
    $message .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    $message .= "お問い合わせ\n";
    $message .= "https://smafee.jp/contact/\n";
    $message .= "このメールは、送信専用メールアドレスから配信されています。\n";
    $message .= "ご返信いただいてもお答えできませんので、ご了承ください。\n\n";
    $message .= "個人情報の取扱いについては個人情報保護方針をご覧下さい。\n";
    $message .= "https://smafee.jp/privacy/\n\n";
    $message .= "■Smafee\n";
    $message .= str_replace("a/", "", $sys->home)."\n";
    $message .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";

    mb_send_mail($to, $subject2, $message, $headers);
}

function mail_c02($LOGIN_ID, $cUser, $ad_name)
{
    $cuser = getCUser($cUser);
    $text .= $cuser->name."　様\n\n";


    $text = "いつもSmafeeのご利用ありがとうございます。\n";
    $text = "ユーザー様よりオファー（広告）の承認申請が到着致しました。\n";
    $text .= "下記内容をご確認ください。\n\n";
    
    $text .= "■オファーリクエスト情報━━━━━━━━━━━━━━━━━━━━\n";
    $text .= "オファー名　　：".$ad_name."\n";

    $nUser = getNuser($LOGIN_ID);
    $text .= "リクエスト者　：".$LOGIN_ID.$nUser->name."\n";

    $nuserX10 = getNuserX10($LOGIN_ID);
    $sns2 = empty($nuserX10->instagram) ? '' : "instagram:https://www.instagram.com/".$nuserX10->instagram."\n";
    $sns2 .= empty($nuserX10->facebook) ? '' : "facebook:https://www.facebook.com/".$nuserX10->facebook."\n";
    $sns2 .= empty($nuserX10->twitter) ? '' : "twitter:https://twitter.com/".$nuserX10->twitter."\n";
    $sns2 .= empty($nuserX10->youtube) ? '' : "youtube:https://www.youtube.com/channel/".$nuserX10->youtube."\n";
    $text .= empty($sns2) ? "SNSアカウントは設定されていません" : $sns2;
    $text .= "\n";
    $text .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
    
    $text .= "リクエストの承認確認は\n";
    $text .= "下記のアドレスよりログインしてご確認ください。\n";
    $text .= "https://smafee.jp/a/\n";
    
    $text .= "その他ご不明な点・ご質問などございましたら、\n";
    $text .= "Smafee サポートデスクもしくは担当者までお問い合わせください。\n\n";

    $to      = $cuser->mail;
    $subject = "参加リクエスト到着のお知らせ";
    $message = $text;
    sendMailFromAdmin($to, $subject, $message);
}

function mail_c04($LOGIN_ID, $cUser, $ad_name)
{
    $cuser = getCUser($cUser);
    $text .= $cuser->name."　様\n\n";


    $text = "この度は、Smafeeのご利用ありがとうございます。\n";
    $text = "ユーザー様より投稿報酬の投稿確認申請が到着致しました。\n";
    $text .= "下記内容をご確認ください。\n\n";
            
    $text .= "■投稿確認依頼情報━━━━━━━━━━━━━━━━━━━━\n";
    $text .= "オファー名　　：".$ad_name."\n";

    $nUser = getNuser($LOGIN_ID);
    $text .= "リクエスト者　：".$LOGIN_ID.$nUser->name."\n";

    $nuserX10 = getNuserX10($LOGIN_ID);
    $sns2 = empty($nuserX10->instagram) ? '' : "instagram:https://www.instagram.com/".$nuserX10->instagram."\n";
    $sns2 .= empty($nuserX10->facebook) ? '' : "facebook:https://www.facebook.com/".$nuserX10->facebook."\n";
    $sns2 .= empty($nuserX10->twitter) ? '' : "twitter:https://twitter.com/".$nuserX10->twitter."\n";
    $sns2 .= empty($nuserX10->youtube) ? '' : "youtube:https://www.youtube.com/channel/".$nuserX10->youtube."\n";
    $text .= empty($sns2) ? "SNSアカウントは設定されていません" : $sns2;
    $text .= "\n";
    $text .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
            
    $text .= "投稿のご確認は上記のSNSをリンクをご確認いただくか\n";
    $text .= "下記のアドレスよりログインしてリクエスト一覧からご確認ください。\n";
    $text .= "https://smafee.jp/a/\n";
            
    $text .= "その他ご不明な点・ご質問などございましたら、\n";
    $text .= "Smafee サポートデスクもしくは担当者までお問い合わせください。\n\n";
            
    $to      = $cuser->mail;
    $subject = "投稿確認依頼到着のお知らせ";
    $message = $text;
    sendMailFromAdmin($to, $subject, $message);
}


function mail_n01($LOGIN_ID)
{
    $sys = getSystem();
    $nUser = getNuser($LOGIN_ID);

    $text = $nUser->name."　様\n\n";

    $text .= "この度は、【Smafee】にご登録いただき、誠にありがとうございます。\n";
    $text .= "お客さまの登録状況は、仮登録となっております。\n\n";

    $text .= "下記URLより、メールアドレスを認証の上、本登録の完了をお願いいたします。\n\n";
    
    $text .= "■認証URL━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";

    if (substr($sys->home, -1)=='/') {
        $sys->home = substr($sys->home, 0, -1);
    }
    $md5 = md5($LOGIN_ID . $nUser->mail);
    $text .= $sys->home."/x10u_activation.php?type=nUser&id=".$LOGIN_ID."&md5=".$md5;
    $text .= "\n";

    $text .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
            
    $text .= "※このメールに心当たりがない場合は、本メールの削除をお願いいたします。\n\n";

    $to      = $nUser->mail;
    $subject = "会員仮登録完了のお知らせ";
    $message = $text;
    sendMailFromAdmin($to, $subject, $message);
}


function mail_n02($LOGIN_ID)
{
    $sys = getSystem();
    $nUser = getNuser($LOGIN_ID);

    $text = $nUser->name."　様\n\n";

    $text .= "この度は、【Smafee】にご登録いただき、誠にありがとうございます。\n";
    $text .= "会員登録が完了いたしましたのでお知らせいたします。\n\n";

    $text .= "下記URLより、登録情報の変更および登録内容をご確認いただけます。\n\n";
    
    $text .= "■ログインURL━━━━━━━━━━━━━━━━━━━━━━━━━\n";

    $text .= str_replace("a/", "", $sys->home)."login\n";

    $text .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
            
    $text .= "※このメールに心当たりがない場合は、本メールの削除をお願いいたします。\n\n";

    $to      = $nUser->mail;
    $subject = "会員登録完了のお知らせ";
    $message = $text;
    sendMailFromAdmin($to, $subject, $message);
}



function mail_n03($LOGIN_ID, $ad)
{
    $sys = getSystem();
    $nUser = getNuser($LOGIN_ID);
    $cuser = getCUser($ad->cuser);

    $text = $nUser->name."　様\n\n";

    $text .= "いつも【Smafee】をご利用いただき、誠にありがとうございます。\n";
    $text .= "承認制広告へのリクエストが完了いたしましたのでお知らせいたします。\n";
    $text .= "※リクエスト送信時の自動配信メールになります。\n";
    $text .= "まだ承認をおりたわけではございませんのでご注意下さい。\n\n";
    
    $text .= "オファー主（広告主）より参加の承認がおりましたら承認完了メールをお送り致しますので今しばらくお待ち下さいませ。\n\n";
            
    $text .= "■オファーリクエスト情報━━━━━━━━━━━━━━━━━━━━\n";
    $text .= "オファー名　　：".$ad->name."\n";
    if ($ad->adware_type=="0") {
        $text .= "オファータイプ：成果報酬型\n";
    } elseif ($ad->adware_type=="1") {
        $text .= "オファータイプ：クリック報酬型\n";
    } elseif ($ad->adware_type=="2") {
        $text .= "オファータイプ：投稿報酬型\n";
    } else {
        $text .= "オファータイプ：\n";
    }
    $text .= "成果単価　　　：".number_format($ad->money+$ad->click_money)."円\n";
    $text .= "オファー主　　：".$cuser->name."\n";
    $text .= "オファーURL　：".$sys->home."x10u_offer_detail.php?id=".$ad->id."\n";
    $text .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
            
    $text .= "※承認されるために下記を今一度ご確認頂けますと幸いです\n";
    $text .= "・オファー詳細画面の「承認目安」を達成している\n";
    $text .= "・SNSアカウントの設定を行う（ログイン後メニューの「設定変更」確認）\n\n";
    
    $text .= "※そのほか操作方法等はマニュアルをご確認下さい。\n";
    $text .= "・スマフィーのはじめ方\n";
    $text .= "https://smafee.jp/howto/\n";
    $text .= "\n\n";

    $to      = $nUser->mail;
    $subject = "承認制広告リクエスト完了のお知らせ";
    $message = $text;
    sendMailFromAdmin($to, $subject, $message);
}


function mail_n04($LOGIN_ID, $ad)
{
    $sys = getSystem();
    $nUser = getNuser($LOGIN_ID);
    $cuser = getCUser($ad->cuser);

    $text = $nUser->name."　様\n\n";

    $text .= "いつも【Smafee】をご利用いただき、誠にありがとうございます。\n";
    $text .= "承認制広告へのリクエストが承認されましたのでお知らせいたします。\n\n";
    
    $text .= "ログイン後のオファー詳細画面をご確認下さい。\n\n";
            
    $text .= "■オファーリクエスト情報━━━━━━━━━━━━━━━━━━━━\n";
    $text .= "オファー名　　：".$ad->name."\n";
    if ($ad->adware_type=="0") {
        $text .= "オファータイプ：成果報酬型\n";
    } elseif ($ad->adware_type=="1") {
        $text .= "オファータイプ：クリック報酬型\n";
    } elseif ($ad->adware_type=="2") {
        $text .= "オファータイプ：投稿報酬型\n";
    } else {
        $text .= "オファータイプ：\n";
    }
    $text .= "成果単価　　　：".number_format($ad->money+$ad->click_money)."円\n";
    $text .= "オファー主　　：".$cuser->name."\n";
    $text .= "オファーURL　：".$sys->home."x10u_offer_detail.php?id=".$ad->id."\n";
    $text .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";

    $text .= "※承認後の工程は広告タイプ別にマニュアルをご確認下さい。\n";
    $text .= "・スマフィーのはじめ方\n";
    $text .= "https://smafee.jp/howto/\n";
    $text .= "\n\n";

    $to      = $nUser->mail;
    $subject = "承認制広告リクエスト承認のお知らせ";
    $message = $text;

    sendMailFromAdmin($to, $subject, $message);
}


function mail_n05($LOGIN_ID, $ad)
{
    $sys = getSystem();
    $nUser = getNuser($LOGIN_ID);
    $cuser = getCUser($ad->cuser);

    $text = $nUser->name."　様\n\n";

    $text .= "いつも【Smafee】をご利用いただき、誠にありがとうございます。\n";
    $text .= "承認制広告へのリクエストが非承認となってしまいましたのでお知らせいたします。\n\n";
    
    $text .= "※承認リクエストは再度行うことが出来ますが\n";
    $text .= "下記をご確認の上行って頂けますと承認されやすくなるかと思います。\n\n";

    $text .= "・オファー詳細画面の「承認目安」を達成している\n";
    $text .= "・SNSアカウントの設定を行う（ログイン後メニューの「設定変更」確認）\n\n";
            
    $text .= "■オファーリクエスト情報━━━━━━━━━━━━━━━━━━━━\n";
    $text .= "オファー名　　：".$ad->name."\n";
    if ($ad->adware_type=="0") {
        $text .= "オファータイプ：成果報酬型\n";
    } elseif ($ad->adware_type=="1") {
        $text .= "オファータイプ：クリック報酬型\n";
    } elseif ($ad->adware_type=="2") {
        $text .= "オファータイプ：投稿報酬型\n";
    } else {
        $text .= "オファータイプ：\n";
    }
    $text .= "成果単価　　　：".number_format($ad->money+$ad->click_money)."円\n";
    $text .= "オファー主　　：".$cuser->name."\n";
    $text .= "オファーURL　：".$sys->home."x10u_offer_detail.php?id=".$ad->id."\n";
    $text .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
            
    $text .= "そのほかオープンタイプのオファーへの参加などもご検討下さい\n";
    $text .= "・スマフィーのはじめ方\n";
    $text .= "https://smafee.jp/howto/\n";
    $text .= "\n\n";

    $to      = $nUser->mail;
    $subject = "承認制広告リクエスト非承認のお知らせ";
    $message = $text;
    sendMailFromAdmin($to, $subject, $message);
}



function mail_n10($LOGIN_ID, $ad)
{
    $sys = getSystem();
    $nUser = getNuser($LOGIN_ID);
    $cuser = getCUser($ad->cuser);

    $text = $nUser->name."　様\n\n";

    $text .= "いつも【Smafee】をご利用いただき、誠にありがとうございます。\n";
    $text .= "投稿報酬型広告への投稿確認リクエストが完了いたしましたのでお知らせいたします。\n";
    $text .= "※リクエスト送信時の自動配信メールになります。\n";
    $text .= "まだ承認をおりたわけではございませんのでご注意下さい。\n\n";
    
    $text .= "オファー主（広告主）より投稿の確認がおりましたら確認完了メールをお送り致しますので今しばらくお待ち下さいませ。\n\n";
            
    $text .= "■投稿確認情報━━━━━━━━━━━━━━━━━━━━\n";
    $text .= "オファー名　　：".$ad->name."\n";
    if ($ad->adware_type=="0") {
        $text .= "オファータイプ：成果報酬型\n";
    } elseif ($ad->adware_type=="1") {
        $text .= "オファータイプ：クリック報酬型\n";
    } elseif ($ad->adware_type=="2") {
        $text .= "オファータイプ：投稿報酬型\n";
    } else {
        $text .= "オファータイプ：\n";
    }
    $text .= "成果単価　　　：".number_format($ad->money)."円\n";
    $text .= "オファー主　　：".$cuser->name."\n";
    $text .= "オファーURL　：".$sys->home."x10u_offer_detail.php?id=".$ad->id."\n";

    $text .= "リクエスト者　：".$LOGIN_ID.$nUser->name."\n";

    // $nuserX10 = getNuserX10($LOGIN_ID);
    // $sns2 = empty($nuserX10->instagram) ? '' : "instagram:https://www.instagram.com/".$nuserX10->instagram."\n";
    // $sns2 .= empty($nuserX10->facebook) ? '' : "facebook:https://www.facebook.com/".$nuserX10->facebook."\n";
    // $sns2 .= empty($nuserX10->twitter) ? '' : "twitter:https://twitter.com/".$nuserX10->twitter."\n";
    // $sns2 .= empty($nuserX10->youtube) ? '' : "youtube:https://www.youtube.com/channel/".$nuserX10->youtube."\n";
    // $text .= empty($sns2) ? "SNSアカウントは設定されていません" : $sns2;
    $text .= getNuserSNS($LOGIN_ID);
    $text .= "\n";
    $text .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
            
    $text .= "※投稿は上記で設定されているSNSアカウントを広告主が確認致します\n";
    $text .= "投稿したSNSと上記が一致していない場合はSNSアカウント設定より編集してください\n";
    $text .= "（ログイン後メニューの「設定変更」確認）\n\n";
    
    $text .= "※そのほか操作方法等はマニュアルをご確認下さい。\n";
    $text .= "・スマフィーのはじめ方\n";
    $text .= "https://smafee.jp/howto/\n";
    $text .= "\n\n";

    $to      = $nUser->mail;
    $subject = "投稿確認リクエスト完了のお知らせ";
    $message = $text;
    sendMailFromAdmin($to, $subject, $message);
}


function mail_n11($LOGIN_ID, $ad)
{
    $sys = getSystem();
    $nUser = getNuser($LOGIN_ID);
    $cuser = getCUser($ad->cuser);

    $text = $nUser->name."　様\n\n";

    $text .= "いつも【Smafee】をご利用いただき、誠にありがとうございます。\n";
    $text .= "投稿報酬型広告への投稿確認が完了いたしましたのでお知らせいたします。\n\n";

    $text .= "※投稿の即時削除防止のため現在は「未確定成果」となります\n";
    $text .= "14日〜30日程度で投稿が残っていることを広告主が確認次第「確定成果」となりますので決して投稿を削除なさらないようお願い致します。\n\n";
            
    $text .= "■投稿確認情報━━━━━━━━━━━━━━━━━━━━\n";
    $text .= "オファー名　　：".$ad->name."\n";
    if ($ad->adware_type=="0") {
        $text .= "オファータイプ：成果報酬型\n";
    } elseif ($ad->adware_type=="1") {
        $text .= "オファータイプ：クリック報酬型\n";
    } elseif ($ad->adware_type=="2") {
        $text .= "オファータイプ：投稿報酬型\n";
    } else {
        $text .= "オファータイプ：\n";
    }
    $text .= "成果単価　　　：".number_format($ad->money)."円\n";
    $text .= "オファー主　　：".$cuser->name."\n";
    $text .= "オファーURL　：".$sys->home."x10u_offer_detail.php?id=".$ad->id."\n";

    $text .= "リクエスト者　：".$LOGIN_ID.$nUser->name."\n";

    // $nuserX10 = getNuserX10($LOGIN_ID);
    // $sns2 = empty($nuserX10->instagram) ? '' : "instagram:https://www.instagram.com/".$nuserX10->instagram."\n";
    // $sns2 .= empty($nuserX10->facebook) ? '' : "facebook:https://www.facebook.com/".$nuserX10->facebook."\n";
    // $sns2 .= empty($nuserX10->twitter) ? '' : "twitter:https://twitter.com/".$nuserX10->twitter."\n";
    // $sns2 .= empty($nuserX10->youtube) ? '' : "youtube:https://www.youtube.com/channel/".$nuserX10->youtube."\n";
    // $text .= empty($sns2) ? "SNSアカウントは設定されていません" : $sns2;
    $text .= getNuserSNS($LOGIN_ID);
    $text .= "\n";
    $text .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
            
    $text .= "※投稿は上記で設定されているSNSアカウントを広告主が確認致します\n";
    $text .= "投稿したSNSと上記が一致していない場合はSNSアカウント設定より編集してください\n";
    $text .= "（ログイン後メニューの「設定変更」確認）\n\n";
    
    $text .= "※そのほか操作方法等はマニュアルをご確認下さい。\n";
    $text .= "・スマフィーのはじめ方\n";
    $text .= "https://smafee.jp/howto/\n";
    $text .= "\n\n";

    $to      = $nUser->mail;
    $subject = "投稿確認完了のお知らせ";
    $message = $text;
    sendMailFromAdmin($to, $subject, $message);
}

function mail_n12($LOGIN_ID, $ad)
{
    $sys = getSystem();
    $nUser = getNuser($LOGIN_ID);
    $cuser = getCUser($ad->cuser);

    $text = $nUser->name."　様\n\n";

    $text .= "いつも【Smafee】をご利用いただき、誠にありがとうございます。\n";
    $text .= "投稿報酬型広告への投稿確認が否認となってしまいましたのでお知らせいたします。\n\n";

    $text .= "※投稿リクエストは再度行うことが出来ますが\n";
    $text .= "下記をご確認の上行って頂けますと承認されやすくなるかと思います。\n\n";
            
    $text .= "・SNSアカウントにて設定しているアカウントとは別のSNSで投稿した\n";
    $text .= "（ログイン後メニューの「設定変更」確認）\n";
    $text .= "・オファー主（広告主）が設定されている否認条件に該当\n";
    $text .= "・オファー主（広告主）が設定されているNGワードを使用している\n\n";

    $text .= "■投稿確認情報━━━━━━━━━━━━━━━━━━━━\n";
    $text .= "オファー名　　：".$ad->name."\n";
    if ($ad->adware_type=="0") {
        $text .= "オファータイプ：成果報酬型\n";
    } elseif ($ad->adware_type=="1") {
        $text .= "オファータイプ：クリック報酬型\n";
    } elseif ($ad->adware_type=="2") {
        $text .= "オファータイプ：投稿報酬型\n";
    } else {
        $text .= "オファータイプ：\n";
    }
    $text .= "成果単価　　　：".number_format($ad->money)."円\n";
    $text .= "オファー主　　：".$cuser->name."\n";
    $text .= "オファーURL　：".$sys->home."x10u_offer_detail.php?id=".$ad->id."\n";

    $text .= "リクエスト者　：".$LOGIN_ID.$nUser->name."\n";

    // $nuserX10 = getNuserX10($LOGIN_ID);
    // $sns2 = empty($nuserX10->instagram) ? '' : "instagram:https://www.instagram.com/".$nuserX10->instagram."\n";
    // $sns2 .= empty($nuserX10->facebook) ? '' : "facebook:https://www.facebook.com/".$nuserX10->facebook."\n";
    // $sns2 .= empty($nuserX10->twitter) ? '' : "twitter:https://twitter.com/".$nuserX10->twitter."\n";
    // $sns2 .= empty($nuserX10->youtube) ? '' : "youtube:https://www.youtube.com/channel/".$nuserX10->youtube."\n";
    // $text .= empty($sns2) ? "SNSアカウントは設定されていません" : $sns2;
    $text .= getNuserSNS($LOGIN_ID);
    $text .= "\n";
    $text .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
            
    $text .= "※投稿は上記で設定されているSNSアカウントを広告主が確認致します\n";
    $text .= "投稿したSNSと上記が一致していない場合はSNSアカウント設定より編集してください\n";
    $text .= "（ログイン後メニューの「設定変更」確認）\n\n";
    
    $text .= "※そのほか操作方法等はマニュアルをご確認下さい。\n";
    $text .= "・スマフィーのはじめ方\n";
    $text .= "https://smafee.jp/howto/\n";
    $text .= "\n\n";

    $to      = $nUser->mail;
    $subject = "投稿確認否認のお知らせ";
    $message = $text;
    sendMailFromAdmin($to, $subject, $message);
}


function mail_n13($LOGIN_ID, $ad)
{
    $sys = getSystem();
    $nUser = getNuser($LOGIN_ID);
    $cuser = getCUser($ad->cuser);

    $text = $nUser->name."　様\n\n";

    $text .= "いつも【Smafee】をご利用いただき、誠にありがとうございます。\n";
    $text .= "投稿報酬型広告への投稿最終確認が完了いたしましたのでお知らせいたします。\n";
    $text .= "（確定成果となり報酬が確定致しましたお知らせになります）\n\n";

    $text .= "※最終確定致しましたが投稿は削除されないことをお薦めいたします。\n";
    $text .= "（オファー主より個別によい条件のオファーが受けられる事がございます）\n\n";

    $text .= "■オファー情報━━━━━━━━━━━━━━━━━━━━\n";
    $text .= "オファー名　　：".$ad->name."\n";
    if ($ad->adware_type=="0") {
        $text .= "オファータイプ：成果報酬型\n";
    } elseif ($ad->adware_type=="1") {
        $text .= "オファータイプ：クリック報酬型\n";
    } elseif ($ad->adware_type=="2") {
        $text .= "オファータイプ：投稿報酬型\n";
    } else {
        $text .= "オファータイプ：\n";
    }
    $text .= "成果単価　　　：".number_format($ad->money)."円\n";
    $text .= "オファー主　　：".$cuser->name."\n";
    $text .= "オファーURL　：".$sys->home."x10u_offer_detail.php?id=".$ad->id."\n";

    $text .= "リクエスト者　：".$LOGIN_ID.$nUser->name."\n";

    $text .= getNuserSNS($LOGIN_ID);
    $text .= "\n";
    $text .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
            
    $text .= "※是非そのほかのオファーもご検討下さい。（ログイン後、オファー一覧）\n";
    $text .= "https://smafee.jp/\n\n";
    
    $text .= "※そのほか操作方法等はマニュアルをご確認下さい。\n";
    $text .= "・スマフィーのはじめ方\n";
    $text .= "https://smafee.jp/howto/\n";
    $text .= "\n\n";

    $to      = $nUser->mail;
    $subject = "投稿最終確認完了(成果確定)のお知らせ";
    $message = $text;
    sendMailFromAdmin($to, $subject, $message);
}

function mail_n14($LOGIN_ID, $ad)
{
    $sys = getSystem();
    $nUser = getNuser($LOGIN_ID);
    $cuser = getCUser($ad->cuser);

    $text = $nUser->name."　様\n\n";

    $text .= "いつも【Smafee】をご利用いただき、誠にありがとうございます。\n";
    $text .= "投稿報酬型広告への投稿最終確認が否認となってしまいましたのでお知らせいたします。\n\n";

    $text .= "※投稿リクエストは再度行うことが出来ますが\n";
    $text .= "下記をご確認の上行って頂けますと承認されやすくなるかと思います。\n\n";

    $text .= "・SNSアカウントにて設定しているアカウントとは別のSNSで投稿した\n";
    $text .= "（ログイン後メニューの「設定変更」確認）\n";
    $text .= "・オファー主（広告主）が設定されている否認条件に該当\n";
    $text .= "・オファー主（広告主）が設定されているNGワードを使用している\n\n";

    $text .= "■投稿確認情報━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    $text .= "オファー名　　：".$ad->name."\n";
    if ($ad->adware_type=="0") {
        $text .= "オファータイプ：成果報酬型\n";
    } elseif ($ad->adware_type=="1") {
        $text .= "オファータイプ：クリック報酬型\n";
    } elseif ($ad->adware_type=="2") {
        $text .= "オファータイプ：投稿報酬型\n";
    } else {
        $text .= "オファータイプ：\n";
    }
    $text .= "成果単価　　　：".number_format($ad->money)."円\n";
    $text .= "オファー主　　：".$cuser->name."\n";
    $text .= "オファーURL　：".$sys->home."x10u_offer_detail.php?id=".$ad->id."\n";

    $text .= "リクエスト者　：".$LOGIN_ID.$nUser->name."\n";

    $text .= getNuserSNS($LOGIN_ID);
    $text .= "\n";
    $text .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
            
    $text .= "※投稿は上記で設定されているSNSアカウントを広告主が確認致します\n";
    $text .= "投稿したSNSと上記が一致していない場合はSNSアカウント設定より編集してください\n";
    $text .= "（ログイン後メニューの「設定変更」確認）\n\n";
    
    $text .= "※そのほか操作方法等はマニュアルをご確認下さい。\n";
    $text .= "・スマフィーのはじめ方\n";
    $text .= "https://smafee.jp/howto/\n";
    $text .= "\n\n";

    $to      = $nUser->mail;
    $subject = "投稿確認否認のお知らせ";
    $message = $text;
    sendMailFromAdmin($to, $subject, $message);
}



function mail_n16($LOGIN_ID)
{
    $sys = getSystem();
    $nUser = getNuser($LOGIN_ID);

    $text = $nUser->name."　様\n\n";

    $text .= "いつも【Smafee】をご利用いただき、誠にありがとうございます。\n\n";

    $text .= "ユーザー情報設定変更が完了したことをお知らせ致します。\n\n";

    $text .= "※SNSアカウントは常に最新の情報を設定お願い致します。\n";
    $text .= "承認制広告タイプはオファー主（広告主）が設定されたSNSアカウントを元に承認の可否を判断致します。\n\n";

    $text .= "変更内容の反映確認やユーザー情報を再度変更される場合は\n";
    $text .= "下記URLよりログインいただき再設定をお願い致します。\n\n";

    $text .= "■ログインURL━━━━━━━━━━━━━━━━━━━━\n";
    $text .= $sys->home."x10u_login.php\n";
    $text .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
            
    $text .= "※銀行口座につきましても変更があった場合はご設定の方お願い致します。\n";
    $text .= "お客様のご都合で振込エラーになった場合、再度お振り込みさせて頂く場合の手数料も差し引かせて頂いてのご入金になりますのでご注意下さい。\n\n";
    
    $text .= "※そのほか操作方法等はマニュアルをご確認下さい。\n";
    $text .= "・スマフィーのはじめ方\n";
    $text .= "https://smafee.jp/howto/\n";
    $text .= "\n\n";

    $to      = $nUser->mail;
    $subject = "ユーザー情報設定変更完了のお知らせ";
    $message = $text;
    sendMailFromAdmin($to, $subject, $message);
}

function mail_n17($rtnsID)
{
    $sys = getSystem();
    $rtns = getReturnss($rtnsID);
    $nUser = getNuser($rtns->owner);

    $text = $nUser->name."　様\n\n";

    $text .= "いつも【Smafee】をご利用いただき、誠にありがとうございます。\n\n";

    $text .= "振込手続きが完了したことをお知らせ致します。\n";
    $text .= "※お客様の口座へ着金しているお知らせではございません。\n\n";

    $text .= "金融機関の営業日ベースで７営業日が経過してもお客様が登録されている口座にご入金がされない場合は、トラブル等が起きていないかを確認させて頂きますので、お手数をおかけ致しますが、サポート窓口までご連絡下さい。 
    \n\n";

    $text .= "■報酬金額━━━━━━━━━━━━━━━━━━━━\n";
    $text .= number_format($rtns->cost)."円（この金額に振込手数料を引いた金額がお客様の口座に振り込まれます）\n";
    $text .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
            
    $text .= "※お客様のご都合で振込エラーになった場合、再度お振り込みさせて頂く場合の手数料も差し引かせて頂いてのお振り込みになりますのでご注意下さい。\n\n";
    
    $text .= "※そのほか操作方法等はマニュアルをご確認下さい。\n";
    $text .= "・スマフィーのはじめ方\n";
    $text .= "https://smafee.jp/howto/\n";
    $text .= "\n\n";

    $to      = $nUser->mail;
    $subject = "振込処理完了のお知らせ";
    $message = $text;
    sendMailFromAdmin($to, $subject, $message);
}
