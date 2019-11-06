var maxValue = 999; //ここに上限値を設定します

var start = false; //スタートボタンのフラグ
var stop100 = false; //100の位ストップ
var stop10 = false; //10の位ストップ
var stop1 = false; //1の位ストップ
var times = 0; //引いた回数
var shuffleIdA; //setInterval用の変数
var shuffleIdB; //setInterval用の変数
var shuffleIdC; //setInterval用の変数
var hitNo = 0;

//1～ MAXまでの番号を配列に追加
var nums = [];
for (i = 1; i <= maxValue; i++) {
  nums.push(i);
}

//配列の中身をランダムに並び替え
var rndm = function() {
  return Math.random() - .5
};
nums.sort(rndm);

function prepreBingo() {
  var i = nums[times];
  hitNo = ('000' + i).slice(-3);
  $('#numC').text(hitNo.slice(-1));
}

function preBingo() {
  $('#numB').text(hitNo.slice(1, 2));
}

//配列から値を取り出して#numに表示
function bingo() {
  $('#numA').text(hitNo.slice(0, 1));
  $('#num2').append('<li>' + hitNo + '</li>');
  times++;
  console.log(times)
}

//STARTボタンを押した後のシャッフルシーン用
function shuffleA() {
  shuffleIdA = setInterval(function() {
    var randomNum = Math.floor(Math.random() * 10);
    $('#numA').text(randomNum);
  }, 30);
}

function shuffleB() {
  shuffleIdB = setInterval(function() {
    var randomNum2 = Math.floor(Math.random() * 10);
    $('#numB').text(randomNum2);
  }, 30);
}

function shuffleC() {
  shuffleIdC = setInterval(function() {
    var randomNum3 = Math.floor(Math.random() * 10);
    $('#numC').text(randomNum3);
  }, 30);
}



function nextForm() {
  if (event.keyCode == 13) {


    //スタートボタン押下
    if (start == false && times <= (maxValue - 1)) {

      //$(this).text('STOP 1st');
      document.getElementById("roll1").play();
      shuffleA();
      shuffleB();
      shuffleC();
      start = true;

      //1の位ストップ
    } else if (stop1 == false && times < (maxValue - 1)) {
      //$(this).text('STOP 2nd');
      //document.getElementById("roll1").pause();
      //document.getElementById("roll2").play();
      //document.getElementById("roll1").play();
      clearInterval(shuffleIdC);
      prepreBingo();
      stop1 = true;

      //１0の位ストップ
    } else if (stop10 == false && times < (maxValue - 1)) {
      //$(this).text('STOP 3nd');
      //document.getElementById("roll1").pause();
      //document.getElementById("roll2").play();
      //document.getElementById("roll1").play();
      clearInterval(shuffleIdB);
      preBingo();
      stop10 = true;

      //MAX回目まで、ストップボタンをスタートボタンに切り替え
    } else if (times < (maxValue - 1)) {
      //$(this).text('START');
      //document.getElementById("roll1").pause();
      //document.getElementById("roll2").play();
      clearInterval(shuffleIdA);
      bingo();
      start = false;
      stop1 = false;
      stop10 = false;

      //MAX回目（最後）のシャッフル時のボタン処理
    } else if (start == true && times == (maxValue - 1)) {
      //$(this).text('END');
      clearInterval(shuffleIdA);
      clearInterval(shuffleIdB);
      clearInterval(shuffleIdC);
      bingo();
    }



  }
}
window.document.onkeydown = nextForm;



$(function() {

  //ボタン押下時のイベント
  $('#button').on('click', function() {
    //$(document.getElementById("body-text")).on('keypress', function() {


    //スタートボタン押下
    if (start == false && times <= (maxValue - 1)) {
      $(this).text('STOP 1st');
      //document.getElementById("roll1").play();
      shuffleA();
      shuffleB();
      shuffleC();
      start = true;

      //1の位ストップ
    } else if (stop1 == false && times < (maxValue - 1)) {
      $(this).text('STOP 2nd');
      //document.getElementById("roll1").pause();
      //document.getElementById("roll2").play();
      //document.getElementById("roll1").play();
      clearInterval(shuffleIdC);
      prepreBingo();
      stop1 = true;

      //１0の位ストップ
    } else if (stop10 == false && times < (maxValue - 1)) {
      $(this).text('STOP 3nd');
      //document.getElementById("roll1").pause();
      //document.getElementById("roll2").play();
      //document.getElementById("roll1").play();
      clearInterval(shuffleIdB);
      preBingo();
      stop10 = true;

      //MAX回目まで、ストップボタンをスタートボタンに切り替え
    } else if (times < (maxValue - 1)) {
      $(this).text('START');
      //document.getElementById("roll1").pause();
      //document.getElementById("roll2").play();
      clearInterval(shuffleIdA);
      bingo();
      start = false;
      stop1 = false;
      stop10 = false;

      //MAX回目（最後）のシャッフル時のボタン処理
    } else if (start == true && times == (maxValue - 1)) {
      $(this).text('END');
      clearInterval(shuffleIdA);
      clearInterval(shuffleIdB);
      clearInterval(shuffleIdC);
      bingo();
    }
  });
});
