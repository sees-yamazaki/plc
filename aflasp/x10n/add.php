<!-- /**
		 * authenticity_tokenを埋め込む
		 * @param gm GUIManagerオブジェクトです。このメソッドでは利用しません。
		 * @param rec 登録情報のレコードデータです。このメソッドでは利用しません。
		 * @param args コマンドコメント引数配列です。 第一引数にモジュール名を指定します。
		 */
		function drawAuthenticityToken( &$gm, $rec, $args ){
			$this->addBuffer( '<input name="authenticity_token" type="hidden" value="'. h( SystemUtil::getAuthenticityToken() ) .'" />' );
		} -->




<?php include '../x10c/header.php'; ?>

<form name="sys_form" method="post" action="../regist.php?type=nUser&amp;by=form" enctype="multipart/form-data" style="margin: 0px 0px;">
<input name="post" type="hidden" value="check">
<input name="step" type="hidden" value="1">
<input name="authenticity_token" type="hidden" value="ea646112636b28cae5906ef02ca3cd58">
<div id="inc_side_body">

<div class="topics">HOME &gt; アフィリエイト会員登録 &gt; <span>入力フォーム</span> &gt; 入力内容の確認 &gt; 登録完了</div>

会員登録を行って頂くと、あなたのwebサイトにアフィリエイト広告を掲載して、報酬を得ることができます。<br>



<div class="search_list">
<dl>
<dt>ログイン用のメールアドレスとパスワードを半角英数で入力してください。</dt>
<dd>
<table class="search_list_table" summary="詳細テーブル">
<tbody><tr>
    <th>メールアドレス<span>※</span></th>
    <td>
		<input type="text" name="mail" value="" size="50" maxlength="128">


	<span class="info">
		※必ず受信可能なメールアドレスを入力してください。<br>
		入力されたメールアドレスにアクティベートメールを送信しますので、手順に従ってユーザー認証を行ってください。
	</span>

	</td>
</tr>
<tr>
    <th>メールアドレス(再入力)<span>※</span></th>
    <td><input type="text" name="mail_confirm" value="" size="50" maxlength="128">
</td>
</tr>
<tr>
    <th>パスワード<span>※</span></th>
    <td><input type="password" name="pass" size="25" maxlength="128">
</td>
</tr>
<tr>
    <th>パスワード(再入力)<span>※</span></th>
    <td><input type="password" name="pass_confirm" size="25" maxlength="128">
</td>
</tr>
</tbody></table>
</dd>
</dl>
</div>

<div class="search_list">
<dl>
<dt>お名前、住所、電話番号、必要に応じFAX番号を入力してください。</dt>
<dd>
<table class="search_list_table" summary="詳細テーブル">
<tbody><tr>
    <th>お名前<span>※</span></th>
    <td><input type="text" name="name" value="" size="25" maxlength="32">
</td>
</tr>
<tr>
    <th>現住所<span>※</span></th>
    <td>〒&nbsp;<input type="text" name="zip1" value="" size="3" maxlength="3">
&nbsp;-&nbsp;<input type="text" name="zip2" value="" size="4" maxlength="4">

    &nbsp;<select name="adds">
<option value="" selected="selected">未選択</option>
<option value="PF01">北海道</option>
<option value="PF02">青森県</option>
<option value="PF03">岩手県</option>
<option value="PF04">宮城県</option>
<option value="PF05">秋田県</option>
<option value="PF06">山形県</option>
<option value="PF07">福島県</option>
<option value="PF08">東京都</option>
<option value="PF09">神奈川県</option>
<option value="PF10">埼玉県</option>
<option value="PF11">千葉県</option>
<option value="PF12">茨城県</option>
<option value="PF13">栃木県</option>
<option value="PF14">群馬県</option>
<option value="PF15">山梨県</option>
<option value="PF16">新潟県</option>
<option value="PF17">長野県</option>
<option value="PF18">富山県</option>
<option value="PF19">石川県</option>
<option value="PF20">福井県</option>
<option value="PF21">愛知県</option>
<option value="PF22">岐阜県</option>
<option value="PF23">静岡県</option>
<option value="PF24">三重県</option>
<option value="PF25">大阪府</option>
<option value="PF26">兵庫県</option>
<option value="PF27">京都府</option>
<option value="PF28">滋賀県</option>
<option value="PF29">奈良県</option>
<option value="PF30">和歌山県</option>
<option value="PF31">鳥取県</option>
<option value="PF32">島根県</option>
<option value="PF33">岡山県</option>
<option value="PF34">広島県</option>
<option value="PF35">山口県</option>
<option value="PF36">徳島県</option>
<option value="PF37">香川県</option>
<option value="PF38">愛媛県</option>
<option value="PF39">高知県</option>
<option value="PF40">福岡県</option>
<option value="PF41">佐賀県</option>
<option value="PF42">長崎県</option>
<option value="PF43">熊本県</option>
<option value="PF44">大分県</option>
<option value="PF45">宮崎県</option>
<option value="PF46">鹿児島県</option>
<option value="PF47">沖縄県</option>
</select>
    &nbsp;<input type="text" name="add_sub" value="" size="48" maxlength="128">

</td></tr>
<tr>
    <th>電話番号<span>※</span></th>
    <td><input type="text" name="tel" value="" size="15" maxlength="15">
</td>
</tr>
<tr>
    <th>FAX番号</th>
    <td><input type="text" name="fax" value="" size="15" maxlength="15">
</td>
</tr>
</tbody></table>
</dd>
</dl>
</div>

<div class="search_list">
<dl>
<dt>アフィリエイト用バナーを掲載するページのURLを入力してください。</dt>
<dd>
<table class="search_list_table" summary="詳細テーブル">
<tbody><tr>
    <th>バナー掲載ＵＲＬ<span>※</span></th>
    <td><input type="text" name="url" value="http://" size="80" maxlength="256">
</td>
</tr>
</tbody></table>
</dd>
</dl>
</div>

<div class="search_list">
<dl>
<dt>アフィリエイト報酬の振込先を入力してください。</dt>
<dd>
<table class="search_list_table" summary="詳細テーブル">
<tbody><tr>
    <th width="25%">金融機関名<span>※</span></th>
    <td width="25%"><input type="text" name="bank" value="" size="30" maxlength="30">
</td>
    <th width="25%">金融機関番号<span>※</span></th>
    <td width="25%"><input type="text" name="bank_code" value="" size="6" maxlength="4">
</td>
</tr>
<tr>
    <th>支店名<span>※</span></th>
    <td><input type="text" name="branch" value="" size="30" maxlength="30">
</td>
    <th>支店番号<span>※</span></th>
    <td><input type="text" name="branch_code" value="" size="5" maxlength="3">
</td>
</tr>
<tr>
    <th>種別<span>※</span></th>
    <td colspan="3"><label><input type="radio" name="bank_type" value="1" checked="checked">普通</label>
<label><input type="radio" name="bank_type" value="2">当座</label>
<label><input type="radio" name="bank_type" value="4">貯蓄</label>
</td>
</tr>
<tr>
    <th>口座番号<span>※</span></th>
    <td colspan="3"><input type="text" name="number" value="" size="15" maxlength="7">
</td>
</tr>
<tr>
    <th>口座名義(カナ)<span>※</span></th>
    <td colspan="3"><input type="text" name="bank_name" value="" size="30" maxlength="30">
</td>
</tr>
</tbody></table>
</dd>
</dl>
</div>
<input name="parent" type="hidden" value="">


<div class="input_box">
<input type="submit" value="入力内容の確認" class="input_base">
<input type="reset" value="リセット" class="input_base">
</div>

</div><!--inc_side_body_END-->
</form>


<?php include '../x10c/footer.php'; ?>