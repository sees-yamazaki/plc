function ztoh(te) {
    var ts = te.value;
    ts = ts.replace(/[０-９Ａ-Ｚａ-ｚ]/g, function (es) {
        return String.fromCharCode(es.charCodeAt(0) - 65248);
    });
    te.value = ts;
}

function htoz(te) {
    var ts = te.value;
    ts = ts.replace(/[0-9A-Za-z]/g, function (es) {
        return String.fromCharCode(es.charCodeAt(0) + 65248);
    });
    te.value = ts;
}

function harf2wide(txt){
    str = hankana2zenkana(txt.value);
    str = hira2kana(str,true);
    txt.value = str;
    
}

var hankana2zenkana = function (str) {
    var kanaMap = {
        'ｶﾞ': 'ガ', 'ｷﾞ': 'ギ', 'ｸﾞ': 'グ', 'ｹﾞ': 'ゲ', 'ｺﾞ': 'ゴ',
        'ｻﾞ': 'ザ', 'ｼﾞ': 'ジ', 'ｽﾞ': 'ズ', 'ｾﾞ': 'ゼ', 'ｿﾞ': 'ゾ',
        'ﾀﾞ': 'ダ', 'ﾁﾞ': 'ヂ', 'ﾂﾞ': 'ヅ', 'ﾃﾞ': 'デ', 'ﾄﾞ': 'ド',
        'ﾊﾞ': 'バ', 'ﾋﾞ': 'ビ', 'ﾌﾞ': 'ブ', 'ﾍﾞ': 'ベ', 'ﾎﾞ': 'ボ',
        'ﾊﾟ': 'パ', 'ﾋﾟ': 'ピ', 'ﾌﾟ': 'プ', 'ﾍﾟ': 'ペ', 'ﾎﾟ': 'ポ',
        'ｳﾞ': 'ヴ', 'ﾜﾞ': 'ヷ', 'ｦﾞ': 'ヺ',
        'ｱ': 'ア', 'ｲ': 'イ', 'ｳ': 'ウ', 'ｴ': 'エ', 'ｵ': 'オ',
        'ｶ': 'カ', 'ｷ': 'キ', 'ｸ': 'ク', 'ｹ': 'ケ', 'ｺ': 'コ',
        'ｻ': 'サ', 'ｼ': 'シ', 'ｽ': 'ス', 'ｾ': 'セ', 'ｿ': 'ソ',
        'ﾀ': 'タ', 'ﾁ': 'チ', 'ﾂ': 'ツ', 'ﾃ': 'テ', 'ﾄ': 'ト',
        'ﾅ': 'ナ', 'ﾆ': 'ニ', 'ﾇ': 'ヌ', 'ﾈ': 'ネ', 'ﾉ': 'ノ',
        'ﾊ': 'ハ', 'ﾋ': 'ヒ', 'ﾌ': 'フ', 'ﾍ': 'ヘ', 'ﾎ': 'ホ',
        'ﾏ': 'マ', 'ﾐ': 'ミ', 'ﾑ': 'ム', 'ﾒ': 'メ', 'ﾓ': 'モ',
        'ﾔ': 'ヤ', 'ﾕ': 'ユ', 'ﾖ': 'ヨ',
        'ﾗ': 'ラ', 'ﾘ': 'リ', 'ﾙ': 'ル', 'ﾚ': 'レ', 'ﾛ': 'ロ',
        'ﾜ': 'ワ', 'ｦ': 'ヲ', 'ﾝ': 'ン',
        'ｧ': 'ァ', 'ｨ': 'ィ', 'ｩ': 'ゥ', 'ｪ': 'ェ', 'ｫ': 'ォ',
        'ｯ': 'ッ', 'ｬ': 'ャ', 'ｭ': 'ュ', 'ｮ': 'ョ',
        '｡': '。', '､': '、', 'ｰ': 'ー', '｢': '「', '｣': '」', '･': '・'
    };

    var reg = new RegExp('(' + Object.keys(kanaMap).join('|') + ')', 'g');
    return str
            .replace(reg, function (match) {
                return kanaMap[match];
            })
            .replace(/ﾞ/g, '゛')
            .replace(/ﾟ/g, '゜');
};

var hira2kana = function (str, opt) {
    str = str
            .replace(/[ぁ-ゔ]/g, function (s) {
                return String.fromCharCode(s.charCodeAt(0) + 0x60);
            })
            .replace(/ﾞ/g, '゛')
            .replace(/ﾟ/g, '゜')
            .replace(/(ウ゛)/g, 'ヴ')
            .replace(/(ワ゛)/g, 'ヷ')
            .replace(/(ヰ゛)/g, 'ヸ')
            .replace(/(ヱ゛)/g, 'ヹ')
            .replace(/(ヲ゛)/g, 'ヺ')
            .replace(/(ゝ゛)/g, 'ヾ')
            .replace(/ゝ/g, 'ヽ')
            .replace(/ゞ/g, 'ヾ');
    if (opt !== false) {
        str = str.replace(/ゕ/g, 'ヵ').replace(/ゖ/g, 'ヶ');
    }
    return str;
};

function sliceMaxLength(elem, maxLength) {  
    elem.value = elem.value.slice(0, maxLength);  
}  

