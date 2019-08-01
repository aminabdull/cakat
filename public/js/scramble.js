function shuffelWord(word) {
    var shuffledWord = '';
    var charIndex = 0;
    word = word.split('');
    while (word.length > 0) {
        charIndex = word.length * Math.random() << 0;
        shuffledWord += word[charIndex];
        word.splice(charIndex, 1);
    }
    return shuffledWord;
}
var words = document.getElementById('words_scramble_words').value;
var Base64 = {
    _keyStr: "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",
    encode: function(e) {
        var t = "";
        var n, r, i, s, o, u, a;
        var f = 0;
        e = Base64._utf8_encode(e);
        while (f < e.length) {
            n = e.charCodeAt(f++);
            r = e.charCodeAt(f++);
            i = e.charCodeAt(f++);
            s = n >> 2;
            o = (n & 3) << 4 | r >> 4;
            u = (r & 15) << 2 | i >> 6;
            a = i & 63;
            if (isNaN(r)) {
                u = a = 64
            } else if (isNaN(i)) {
                a = 64
            }
            t = t + this._keyStr.charAt(s) + this._keyStr.charAt(o) + this._keyStr.charAt(u) + this._keyStr.charAt(a)
        }
        return t
    },
    decode: function(e) {
        var t = "";
        var n, r, i;
        var s, o, u, a;
        var f = 0;
        e = e.replace(/[^A-Za-z0-9+/=]/g, "");
        while (f < e.length) {
            s = this._keyStr.indexOf(e.charAt(f++));
            o = this._keyStr.indexOf(e.charAt(f++));
            u = this._keyStr.indexOf(e.charAt(f++));
            a = this._keyStr.indexOf(e.charAt(f++));
            n = s << 2 | o >> 4;
            r = (o & 15) << 4 | u >> 2;
            i = (u & 3) << 6 | a;
            t = t + String.fromCharCode(n);
            if (u != 64) {
                t = t + String.fromCharCode(r)
            }
            if (a != 64) {
                t = t + String.fromCharCode(i)
            }
        }
        t = Base64._utf8_decode(t);
        return t
    },
    _utf8_encode: function(e) {
        e = e.replace(/rn/g, "n");
        var t = "";
        for (var n = 0; n < e.length; n++) {
            var r = e.charCodeAt(n);
            if (r < 128) {
                t += String.fromCharCode(r)
            } else if (r > 127 && r < 2048) {
                t += String.fromCharCode(r >> 6 | 192);
                t += String.fromCharCode(r & 63 | 128)
            } else {
                t += String.fromCharCode(r >> 12 | 224);
                t += String.fromCharCode(r >> 6 & 63 | 128);
                t += String.fromCharCode(r & 63 | 128)
            }
        }
        return t
    },
    _utf8_decode: function(e) {
        var t = "";
        var n = 0;
        var r = c1 = c2 = 0;
        while (n < e.length) {
            r = e.charCodeAt(n);
            if (r < 128) {
                t += String.fromCharCode(r);
                n++
            } else if (r > 191 && r < 224) {
                c2 = e.charCodeAt(n + 1);
                t += String.fromCharCode((r & 31) << 6 | c2 & 63);
                n += 2
            } else {
                c2 = e.charCodeAt(n + 1);
                c3 = e.charCodeAt(n + 2);
                t += String.fromCharCode((r & 15) << 12 | (c2 & 63) << 6 | c3 & 63);
                n += 3
            }
        }
        return t
    }
};
words = Base64.decode(words);
var words_scramble_array = words.split(',');

function play() {
    var play_word = words_scramble_array[0];
    var scrambleword = shuffelWord(play_word);
    for (var i = 0; i < scrambleword.length; i++) {
        var add_letter = document.createElement('div');
        add_letter.className = "letter";
        add_letter.innerHTML = scrambleword[i];
        document.getElementById('dragword').appendChild(add_letter);
    }
    $(function() {
        $("#dragword div").draggable({
            helper: "clone",
            cursor: "move",
            revert: "invalid"
        });
        initDroppable($("#dragword div"));
    });

    function initDroppable($elements) {
        $elements.droppable({
            activeClass: "ui-state-default",
            hoverClass: "ui-drop-hover",
            accept: ":not(.ui-sortable-helper)",
            over: function(event, ui) {
                var $this = $(this);
            },
            drop: function(event, ui) {
                var $this = $(this);
                var li1 = $('<div class="letter">' + ui.draggable.text() + '</div>')
                var linew1 = $(this).after(li1);
                var li2 = $('<div class="letter">' + $(this).text() + '</div>')
                var linew2 = $(ui.draggable).after(li2);
                $(ui.draggable).remove();
                $(this).remove();
                initDroppable($("#dragword div"));
                $("#dragword div").draggable({
                    helper: "clone",
                    cursor: "move",
                    revert: "invalid"
                });
                var scrambleword = "";
                $(".letter").each(function() {
                    scrambleword = scrambleword + $(this).text();
                });
                var scramble = scrambleword.substring(0, scrambleword.length - 1);
                if (scramble == words_scramble_array[0]) {
                    $(".letter").css("border", "1px solid #3CB371");
                    var score = document.getElementById('scorecard').value;
                    score = parseInt(score) + parseInt(100);
                    document.getElementById('scorecard').value = score;
                    document.getElementById('score').innerHTML = score;
                    document.getElementById('gamescore').value = score;
                    count = words_scramble_array.length;
                    if (count > 1) {
                        $('#modal_correct').show();
                    } else {
                        var score_card = $('#scorecard').val();
                        document.getElementById('scorevalue').innerHTML = score_card;
                        var a = $('#time').text();
                        var b = a.split(":");
                        var seconds = (+b[0]) * 60 + (+b[1]);
                        document.getElementById("timetaken").value = parseInt(seconds);
                        if ($('#save-score-input').val() != '') {
                            $("#modal_submit").show();
                            document.getElementById('submit_score').click();
                        } else {
                            $("#modal_score").show();
                        }
                    }
                } else {
                    $(".letter").css("border", "1px solid #D3D3D3");
                }
            }
        });
    }
}

function nextlevel() {
    words_scramble_array;
    words_scramble_array.shift();
    word_scramble_next_words = words_scramble_array.toString();
    word_scramble_next_words = Base64.encode(word_scramble_next_words);
    document.getElementById('words_scramble_words').value = word_scramble_next_words;
    $('#dragword').empty();
    $('#modal_correct').hide();
    $('#modal_wrong').hide();
    play();
}

function check() {
    var scrambleword = "";
    $(".letter").each(function() {
        var a = $(this).text();
        scrambleword = scrambleword + a;
    });
    if (scrambleword == words_scramble_array[0]) {
        $('#dragword > div').css("border", "1px solid #3CB371");
    } else if (scrambleword != words_scramble_array[0]) {
        $('#dragword > div').css("border", "1px solid #f46464");
        var score = $('#scorecard').val();
        score = parseInt(score) - parseInt(20);
        document.getElementById('scorecard').value = score;
        document.getElementById('score').innerHTML = score;
        document.getElementById('gamescore').value = score;
        var words = document.getElementById("words_scramble_words").value;
        var words = Base64.decode(words);
        var words_array = words.split(",");
        count = words_array.length;
        console.log(count);
        if (count > 1) {
            $('#modal_wrong').show();
        } else {
            var score_card = $('#scorecard').val();
            document.getElementById('scorevalue').innerHTML = score_card;
            var a = $('#time').text();
            var b = a.split(":");
            var seconds = (+b[0]) * 60 + (+b[1]);
            seconds = parseInt(600) - parseInt(seconds);
            document.getElementById("timetaken").value = parseInt(seconds);
            if (score_card > 0) {
                if ($('#save-score-input').val() != '') {
                    $("#modal_submit").show();
                    document.getElementById('submit_score').click();
                } else {
                    $("#modal_score").show();
                }
            } else {
                $("#modal_game_over").show();
            }
        }
    } else {
        $('#dragword > div').css("border", "1px solid #D3D3D3");
    }
}

function hide_loader() {
    $("#modal_loading").hide();
}

        function startTimer(duration, display) {
            var timer = duration,
                minutes, seconds;
            var __timer = setInterval(function() {
                minutes = parseInt(timer / 60, 10)
                seconds = parseInt(timer % 60, 10);
                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;
                display.textContent = minutes + ":" + seconds;
                if (--timer < 0) {
                    clearInterval(__timer);
                    timer = duration;
                    if (($('#time').text() == "00:00") && $('#scorecard').val() <= 0) {
                        document.getElementById("timetaken").value = 0;
                        document.getElementById("modal_game_over").style.display = "block";
                    } else {
                        document.getElementById("timetaken").value = 0;
                        var score_card = $('#scorecard').val();
                        document.getElementById('scorevalue').innerHTML = score_card;
                        if ($('#save-score-input').val() != '') {
                            $("#modal_submit").show();
                            document.getElementById('submit_score').click();
                        } else {
                            $("#modal_score").show();
                        }
                    }
                }
                if (document.getElementById('modal_score').style.display == "block" || document.getElementById('modal_submit').style.display == "block") {
                    clearInterval(__timer);
                    timer = duration;
                }
            }, 1000);
        }

        function close_click(url) {
            window.location = url;
        }

        $(document).ready(function() {
            setTimeout(hide_loader, 100);
            var fiveMinutes = 599,
                display = document.querySelector('#time');
            startTimer(fiveMinutes, display);
        });
        play();