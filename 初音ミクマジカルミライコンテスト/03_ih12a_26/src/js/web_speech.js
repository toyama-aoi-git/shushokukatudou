//＝＝＝＝＝＝＝＝音声認識を追加させる処理＝＝＝＝＝＝＝＝＝＝
// speechRecognition = new webkitSpeechRecognition(); 
// speechRecognition.onresult = console.log; 
// speechRecognition.start();


//＝＝＝＝＝＝＝＝＝＝音声認識の処理＝＝＝＝＝＝＝＝＝＝

let recognizing;
const recognition = new webkitSpeechRecognition();
recognition.lang = "ja-JP";
recognition.continuous = true;
recognition.interimResults = true;
reset();
recognition.onend = reset;

//音声認識の開始
recognition.onresult = (event) => {
    let final = "";
    let interim = "";
    for (let i = 0; i < event.results.length; ++i) {
        if (event.results[i].isFinal) {
        final += event.results[i][0].transcript + "<br>";
        } else {
        interim += event.results[i][0].transcript;
        }
    }
    final_span.innerHTML = final;
    interim_span.innerHTML = interim;
}



function reset() {
    recognizing = false;
    button.innerHTML = "音声入力";
}

//音声認識の終了
function toggleStartStop() {
    if (recognizing) {
        recognition.stop();
        reset();
    } else {
        recognition.start();
        recognizing = true;
        button.innerHTML = "Click to Stop";
        final_span.innerHTML = "";
        interim_span.innerHTML = "";
    }
}





//＝＝＝＝＝＝＝＝＝＝move_buttonが押された時の処理＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝


const Btn = document.getElementById('move_button');
const imgId = document.getElementById('modelGif');
console.log(imgId);

let i = 0;
Btn.addEventListener('click',()=>{ 
    i++;
    var spanText = document.getElementById('final_span');
    const text = spanText.textContent;  
    console.log(text);

    if (text == 'バク転') {
        imgId.src = "./img/jump.gif";
        var move = ('バク転');
    }
    
    if(text == '歩く' || text == "あるく" || text == "アルク"){
        imgId.src = "./img/walk.gif";
        var move = ('歩く');
    }

    if(text == "大谷翔平"){
        imgId.src = "./img/大谷翔平.gif";
        var move = ('大谷翔平');
    }

    if(text == "手を振る"){
        imgId.src = "./img/hand.gif";
        var move = ('手を振る');
    }

    if (text == '背景') {
        const Bg_image = document.getElementById('background');
        Bg_image.style.backgroundColor = 'blue';
        var move = "背景";
    }
    


    
    var log = document.getElementById('logBox');
    var newElement = document.createElement("p"); // p要素作成
    newElement.setAttribute("id",i); // p要素にidを設定
    log.prepend(newElement);
    const print = document.getElementById(i);
    print.innerText += move;
});


