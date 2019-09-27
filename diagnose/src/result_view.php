<?php

// セッション開始
session_start();

// タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');


    $uSeq = $_POST['uSeq'];
    $an_id = $_POST['an_id'];

    try {

         require './db/users.php';
         $user = new cls_users();
         $user = getUser($uSeq);


        require './db/answers.php';
        $answered_notes = array();
        $answered_notes = getAnsweredNote($uSeq,$an_id);
            


        require './db/result.php';
        $resultArray = array(array(0,0,0,0,0,0),array(0,0,0,0,0,0),array(0,0,0,0,0,0));
        $resultTitle = array(array("",""),array("",""),array("",""),array("",""),array("",""),array("",""));

        $cnt=0;
        $maxValue=0;
        $answered_ymd1 = "";
        $answered_ymd2 = "";
        foreach($answered_notes as $answered_note){
            if($cnt==0){ $answered_ymd1 = substr($answered_note->an_answered_time,0,10); }
            if($cnt==1){ $answered_ymd2 = substr($answered_note->an_answered_time,0,10); }
            if($cnt==2){ break;}

            $results = getResults($answered_note->an_id);


            foreach($results as $result){
                $i = intval($result->types_id);

                $resultArray[$cnt][$i] = $result->sum_value;
                $resultTitle[$i][0] = $result->types_name;
                $resultTitle[$i][1] = $result->types_note;

                //最大VALUEの判断
                if($resultArray[$cnt][0]<$resultArray[$cnt][$i]){
                    $resultArray[$cnt][0] = $resultArray[$cnt][$i];
                }

            }

            $cnt++;
        }
        

    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }
?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <title>DIAGNOSE</title>
    <link rel="stylesheet" href="../css/main.css" />
    <link rel="stylesheet" href="../css/tab.css" />
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
    // ライブラリのロード
    // name:visualization(可視化),version:バージョン(1),packages:パッケージ(corechart)
    google.load('visualization', '1', {
        'packages': ['corechart']
    });

    // グラフを描画する為のコールバック関数を指定
    google.setOnLoadCallback(drawChart);

    // グラフの描画   
    function drawChart() {

        // 配列からデータの生成
        var data = google.visualization.arrayToDataTable([
            ['TYPE', '今回 <?php echo $answered_ymd1; ?>', '前回 <?php echo $answered_ymd2; ?>'],
            ['<?php echo $resultTitle[1][0]; ?>', <?php echo $resultArray[0][1]; ?> , <?php echo $resultArray[1][1]; ?>],
            ['<?php echo $resultTitle[2][0]; ?>', <?php echo $resultArray[0][2]; ?> , <?php echo $resultArray[1][2]; ?>],
            ['<?php echo $resultTitle[3][0]; ?>', <?php echo $resultArray[0][3]; ?> , <?php echo $resultArray[1][3]; ?>],
            ['<?php echo $resultTitle[4][0]; ?>', <?php echo $resultArray[0][4]; ?> , <?php echo $resultArray[1][4]; ?>],
            ['<?php echo $resultTitle[5][0]; ?>', <?php echo $resultArray[0][5]; ?> , <?php echo $resultArray[1][5]; ?>]
        ]);

        // オプションの設定
        var options = {
            title: '<?php echo $user->users_name; ?>さんの実施結果',
            pointSize: 4,
            legend: { position: 'bottom' }
        };

        // 指定されたIDの要素に折れ線グラフを作成
        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));

        // グラフの描画
        chart.draw(data, options);
    }
    </script>
</head>
<body>
   <?php include('./menu.php'); ?>
   <div id="content">
      <div class="nav">
         <span class="err"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></span>
      </div>
      <br>
      <div id="chart_div"></div>
      <div class="tabs">
         上段はグラフのポイントの高いタブを、下段はグラフの形に近いタブをご覧ください。
         <?php for($i=1; $i<6; $i++){ ?>
         <?php if($resultArray[0][0]==$resultArray[0][$i]){ ?>
         <input id="type<?php echo $i; ?>" type="radio" name="tab_item" checked>
         <?php }else{ ?>
         <input id="type<?php echo $i; ?>" type="radio" name="tab_item">
         <?php } ?>
         <label class="tab_item" for="type<?php echo $i; ?>"><?php echo $resultTitle[$i][0]; ?></label>
         <?php } ?>
         <?php for($i=1; $i<6; $i++){ ?>
         <div class="tab_content" id="type<?php echo $i; ?>txt">
            <div class="tab_content_description">
               <p class="c-txtsp"><?php echo $resultTitle[$i][1]; ?></p>
            </div>
         </div>
         <?php } ?>
      </div>
      <div class="tabs">
         <input id="typeA" type="radio" name="tab_item2" checked>
         <label class="tab_item2" for="typeA">への字型</label>
         <input id="typeB" type="radio" name="tab_item2">
         <label class="tab_item2" for="typeB">N型</label>
         <input id="typeC" type="radio" name="tab_item2">
         <label class="tab_item2" for="typeC">逆N型</label>
         <input id="typeD" type="radio" name="tab_item2">
         <label class="tab_item2" for="typeD">V型</label>
         <input id="typeE" type="radio" name="tab_item2">
         <label class="tab_item2" for="typeE">W型</label>
         <input id="typeF" type="radio" name="tab_item2">
         <label class="tab_item2" for="typeF">M型</label>
         <input id="typeG" type="radio" name="tab_item2">
         <label class="tab_item2" for="typeG">逆V型</label>
         <input id="typeH" type="radio" name="tab_item2">
         <label class="tab_item2" for="typeH">右肩下り型</label>
         <input id="typeI" type="radio" name="tab_item2">
         <label class="tab_item2" for="typeI">右肩上り型</label>
         <input id="typeJ" type="radio" name="tab_item2">
         <label class="tab_item2" for="typeJ">平坦型</label>
         <div class="tab_content" id="typeAtxt">
            <div class="tab_content_description">
               <p class="c-txtsp">エゴグラムは、その人の個性や特徴を示すものであって、「この型が理想的」という捉え方はしませんが、我が国ではへの字型エゴグラムの人が一番多いため、日本人の典型といわれています。<br>
                  <br>
                  への字型はNPが最も高く、A、FC、ACの順に低く、CPが最も低くなります。このタイプは5つの自我状態のバランスが良い状態といえ、他人との衝突やトラブルが生じにくい型といわれています。への字型が一番多いというのは、和を尊重する日本人らしいといえます。
               </p>
            </div>
         </div>
         <div class="tab_content" id="typeBtxt">
            <div class="tab_content_description">
               <p class="c-txtsp">N型エゴグラムは、NPとACが高く、CPとFCが低いタイプで、自分の子共に対するように、他人に対しても自分を犠牲にして献身的に尽くす優しい人です。<br>
                  <br>
                  面倒見が良く思いやりのある人ですが、自分の立場や技量を考えずに行動してしまう危うさがあるため、人に利用されたり、だまされたりしやすい型でもあります。また、劣等感の強い型でもあり、だまされたときの落胆ぶりが大きい傾向にあります。<br>
                  <br>
                  一番の短所は、人生や周囲に対する厳しい目に欠け優柔不断なところなので、そういった面を意識的に補う必要があります。
               </p>
            </div>
         </div>
         <div class="tab_content" id="typeCtxt">
            <div class="tab_content_description">
               <p class="c-txtsp">CPとFCが高値で、NPとACが低値の逆N型エゴグラムは、高い理想と旺盛な好奇心をもち、目標を見つけては邁進していく傾向があります。時代に先駆けた組織のカリスマ的リーダーになったり、クリエイティブなものを次々と創りだす芸術家なども多いようです。<br>
                  <br>
                  何としてでものし上がろうとする野心家タイプなので、目的のためなら手段を選ばない面もあり、他人を踏み台にしたり、ワンマンな態度をとってしまうこともあります。<br>
                  <br>
                  といっても、この型の良さが出れば、芸術な独創性が必要とされる分野で成功する可能性も大きいといえます。冷淡さや頑固さ、利己的な面を多少修正できれば、非常に有能な人材となる可能性を多分に秘めています。
               </p>
            </div>
         </div>
         <div class="tab_content" id="typeDtxt">
            <div class="tab_content_description">
               <p class="c-txtsp">V型エゴグラムは、CPとACが高く、FCあるいはAが低いタイプです。この型は、自分にも他人にも厳しく支配的なCPと、自分を押し殺し周囲に同調してしまうACが高いため、常に自己矛盾を感じてしまう傾向にあります。<br>
                  <br>
                  このタイプは、自分にも他人にも否定的で不満を覚えているにも関わらず、他人の評価を気にして遠慮がちになってしまうため、なかなか思っていることが言えずストレスを溜めこんでしまうことが少なくありません。
               </p>
            </div>
         </div>
         <div class="tab_content" id="typeEtxt">
            <div class="tab_content_description">
               <p class="c-txtsp">W型エゴグラムは、CP・AC・Aが高く、NPとFCが低いのが特徴です。W型エゴグラムは、V型エゴグラムと同じく、CPとACが高いため自己矛盾による葛藤をいつも感じていますが、加えてAも高いので、その悩みは深くなる傾向にあります。<br>
                  <br>
                  厭世タイプともいえ、時代や社会の情勢、自分の技量や立場を見抜ける観察眼を持ち、厳格で論理的な批判精神をも持っています。激しい自己否定感を抱いていることも少なくないため悩みがちですが、Aの論理的思考力を活かせば意識変革も難しくはありません。
               </p>
            </div>
         </div>
         <div class="tab_content" id="typeFtxt">
            <div class="tab_content_description">
               <p class="c-txtsp">M型エゴグラムは、NPとFCが高く、CP・AC・Aが低いのが特徴です。優しく朗らかでユーモアのセンスがあり、人付き合いが上手なので、クラスの人気者やムードメーカーになるタイプです。<br>
                  <br>
                  楽観主義者で、見通しが明るかろうが暗かろうが、いつも楽しいムードを醸し出しています。思いやりがあって面倒見もよく、好奇心や表現力に富んでいるなどの長所がたくさんある人なのですが、ルーズで気ままという欠点もあります。<br>
                  <br>
                  現実の生活に疎いため、人に利用されやすく調子に乗りやすいので、気を引き締めて地に足を着ける必要があります。
               </p>
            </div>
         </div>
         <div class="tab_content" id="typeGtxt">
            <div class="tab_content_description">
               <p class="c-txtsp">逆V型エゴグラムは、Aが高く、CPとACが低いタイプです。Aが高いので現実的・合理的なので仕事の能力は高いのですが、CPが低いため責任や義務を負ったり規則を守ることが好きではなく、また、ACが低いため協調性に乏しく、他人の意見に耳を貸さない傾向があります。<br>
                  <br>
                  頭でっかちの評論家タイプ、といわれることもあり、論理ばかり並べて行動や責任が伴わないと評されることもあります。
               </p>
            </div>
         </div>
         <div class="tab_content" id="typeHtxt">
            <div class="tab_content_description">
               <p class="c-txtsp">右肩下がり（左上がり）型エゴグラムは、CPが最も高値で、NP、A、FC、ACの順に低くなるのが特徴です。昔ながらの頑固親父タイプともいわれ、融通性に乏しく他人の意見を素直に聞き入れない傾向があるため、ACを高める必要があります。<br>
                  <br>
                  また、社会的な決まりの枠内でしか動けず、義理人情や常識を外れることがないため頼りになる人ではありますが、面白味に欠けるともいえるので、趣味や楽しみを持つことも大切です。
               </p>
            </div>
         </div>
         <div class="tab_content" id="typeItxt">
            <div class="tab_content_description">
               <p class="c-txtsp">右肩上がり型エゴグラムは、CPが最も低く、NP、A、FC、ACの順に高くなるのが特徴です。子供っぽいタイプともいわれ、素直で従順なので協調性は高いのですが、主体性や責任感に乏しい傾向があります。自己中心性や依存心が顔をのぞかせる場合もあります。<br>
                  <br>
                  責任感をできるだけ持つようにしてCPを高めるとともに、他人を思いやるようにしてNPを高めていくことが大切です。
               </p>
            </div>
         </div>
         <div class="tab_content" id="typeJtxt">
            <div class="tab_content_description">
               <p class="c-txtsp">・すべての自我状態が高い（14点以上）：超人タイプ<br>
                  責任感、優しさ、論理性、自由度、協調性、すべてを高い水準で兼ね備えている平坦型エゴグラムです。自我のバランスが良いため、一見平凡な人間に思われることが多いタイプですが、深く付き合うほど内面の奥深さが分かってくる人でもあります。<br>
                  <br>
                  ・すべての自我状態が普通（8～13点）：中庸タイプ<br>
                  5つすべての自我を過不足なく兼ね備えており、目立つタイプではありませんが自我バランスの良い人です。職業適性なども向き不向きは少ないですが、反面、非常に得意という分野も少ない傾向にあり、努力を怠ると処理能力が落ちやすいという欠点があります。<br>
                  <br>
                  ・すべての自我状態が低い（7点以下）<br>
                  すべての自我が極端に低い平坦型エゴグラムの場合、心の病が原因かもしれません。エゴグラムが示すのは、その人の固定された性格ではなく、その時々の自我の状態です。<br>
                  <br>
                  責任感、優しさ、論理性、自由度、協調性、すべてが初めから乏しいという人はめったにいないはずなので、うつ病や不安神経症である可能性があります。まずはFCを高められることが大切なので、楽しいと思えることを見つけ、没頭できるようになることを目指しましょう。
               </p>
            </div>
         </div>
      </div>
   </div>
</body>

</html>