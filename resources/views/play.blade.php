<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>Word Scramble</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <!-- Styles -->
        <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('/css/common_bootstrap_style.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('/css/custom.css') }}" rel="stylesheet" type="text/css">

    </head>
    <body>

    <div id="main_menu_container">

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div id="game_container_main">
                    <div class="col-xs-1 col-sm-6 col-md-6 col-lg-6">
                        <div id="game-options">
                            <ul>                   
                                <li><a href="javascript:void(0);" id="check_word" class="button_opt left btn btn-warning" title="" onclick="check();">Give Up</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <div class="score_bar">
                            <div id="timer">
                                <div class="display_time">Time&nbsp;&nbsp;&nbsp;<span id="time">10:00</span></div>
                            </div>
                            <div id="score_box">
                                <div class="display_time">Score:&nbsp;&nbsp;&nbsp;<span id="score">0</span></div>
                            </div>
                        </div>
                    </div>
                     <div id="main-game-wsr">
                        <div id="dragword"></div>
                    </div>
                </div>
            </div>
        </div>    

        <div class="row">

            <input type="hidden" id="scorecard" value="0">
            <input type="hidden" id="words_scramble_words" value="{{  app('request')->input('key') }}">

        </div>
                <!--MODAL-->

                   <div id="modal_correct" class="modal_correct">
                        <div class="content_correct">
                            <span class="close2" id="popup_close1" onclick="nextlevel();">&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            <p id="correct_answer">Correct Answer</p>
                            <input type="button" value="Next Word" title="Try Next Word" onclick="nextlevel();" class="btn btn-success" style="padding: 10px 25px;">
                        </div>
                    </div>

                    <div id="modal_game_over" class="modal_game_over">
                        <div class="content_game_over">
                            <span class="close2" id="popup_close3" onclick="close_click('{{ URL::to("/") }}');"></span>
                            <p id="game_over">Game Over</p>
                            <input type="button" value="Try Again" title="Try Again" onclick="close_click('{{ URL::to("/") }}');" class="btn btn-warning" style="padding: 10px 25px;">
                        </div>
                    </div>

                    <div id="modal_wrong" class="modal_wrong">
                        <div class="content_wrong">
                            <span class="close2" id="popup_close2" onclick="nextlevel();">&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            <p id="wrong_answer">Your Point Deducted -20</p>
                            <input type="button" value="Next Word" title="Try Next Word" onclick="nextlevel();" class="btn btn-danger" style="padding: 10px 25px;">
                        </div>
                    </div>

                    <div id="modal_loading" class="modal_loading" style="display: none;">
                        <div class="loading_wordscramble">Loading....</div>
                    </div>

                    <div id="modal_score" class="modal_score">
                        <div class="modal-score">
                            <div class="modal-header1">
                                <span class="close1" onclick="close_click('{{ URL::to("/") }}');">&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            </div>
                            <div class="modal-body1">
                                <div class="youwin" id="youwin">Congratulations</div>
                                <div class="scored-win">You Scored</div>
                                <div id="scorevalue" class="iscored-win">120</div>
                                
                                <div class="clear"></div>
                                <div class="row_submit">
                                    <form method="post" target="save-score" id="save-score-form">
                                    <center>
                                        <input id="save-score-input" type="text" name="username" value="" placeholder="Name">  
                                          
                                        <input type="hidden" name="gameid" id="gid" value="1">
                                        <input type="hidden" name="score" id="gamescore" value="">
                                        <input type="hidden" name="time" id="timetaken" value="300">
                                        <br>
                                        <input type="button" value="Submit" id="submit_score" class="btn btn-success" onclick="">
                                    </center>    

                                        <img id="submitloader" style="display:none;" src="{{ asset('/images/loader_002.gif') }}" border="0">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

    <div id="modal_submit" class="modal_submit">
        <div class="content_submit">
            <img src="{{ asset('/images/loader-big.gif') }}" alt="Loading"> Submitting your score, please wait...
        </div>
    </div>
    
    </body>

<footer>
    <script type="text/javascript" src="{{ asset('/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/jquery-ui.min.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('/js/jquery.ui.touch-punch.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/scramble.js') }}"></script>
    <script>

        $('#submit_score').click(function() {

            $.ajax({
                url: '{{ URL::to("/score") }}',
                type: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: $('#save-score-form').serialize(),

                timeout: 25000,

                beforeSend: function() {

                    $('#submitloader').show();
                },

                success: function(data) {
                    $('#submitloader').hide();
                    window.location.replace('{{ URL::to("/") }}');
                    console.log(data);
                },
                error: function(jqXHR, exception) {}
            });

            console.log($('#save-score-form').serialize());

                    });
            var words = document.getElementById('words_scramble_words').value;
            words = Base64.decode(words)

            console.log(words);

    </script>
</footer>

</html>
