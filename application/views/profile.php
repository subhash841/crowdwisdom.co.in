<?php
$_SESSION[ 'data' ][ 'tnc_agree' ] = "1";
?>
<div class="content container">
    <div class="row"><!--minus-m-t20 minus-m-t8 mb-12-->
        <div class="col m12 s12 plr15 equal-height">
            <form name="user_profile" id="user_profile" method="post">
                <div class="card z-depth-4"> <!--style="margin-top: 100px;"-->
                    <div class="card-content center">
                        <?php
                        $queryString = $this -> input -> get();

                        if ( ! empty( $queryString ) ) {
                                $this -> session -> set_userdata( 'querystring', $queryString );
                                $session_querystring = $this -> session -> userdata( 'querystring' );
                        } else {
                                $session_querystring = $this -> session -> userdata( 'querystring' );
                        }

                        if ( (@$session_querystring[ 'section' ] == "poll" && @$session_querystring[ 'p' ] == "gov" ) ) {
                                $style = 'style="height: 50vh;"';
                        } else if ( (@$session_querystring[ 'section' ] == "seat" && @$session_querystring[ 'e' ] == "tel" ) ) {
                                $style = 'style="height: 50vh;"';
                        } else {
                                $style = '';
                        }
                        if (!empty($_GET['showlocation'])) {
                            $show_location = 'true';
                        }
                        ?>
                        <div class="" <?= $style ?>
                            <div class="row">
                                <div class="col l4 m6 s12 offset-m3 offset-l4">
                                    <div class="input-field col s12">
                                        <input type="text" name="alise" id="alise" placeholder="ex. jd007p" value="<?= $user_detail[ 'alise' ] ?>"/>
                                        <label>Alias</label>
                                    </div>
                                </div>
                            </div>
                            <?php
//                            if ( (@$session_querystring[ 'section' ] == "poll" && @$session_querystring[ 'p' ] == "gov") || @$session_querystring[ 'section' ] == "seat" || @$session_querystring[ 'section' ] == "vote" || $show_location =='true') {
                                    ?>
                                    <div class="row">
                                        <div class="col l4 m6 s12 offset-m3 offset-l4">
                                            <div class="input-field col s12">
                                                <select name="location" id="location">
                                                    <option value="0" selected>Choose your location</option>
                                                    <?php
                                                    foreach ( $all_states as $states_list ) {
                                                            ?>
                                                            <option value="<?php echo $states_list[ 'id' ] ?>" <?php
                                                            if ( $user_detail[ 'location' ] == $states_list[ 'id' ] ) {
                                                                    echo 'selected="selected"';
                                                            }
                                                            ?>><?php echo $states_list[ 'name' ] ?></option>
                                                                    <?php
                                                            }
                                                            ?>
                                                </select>
                                                <label>Location</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col l4 m6 s12 offset-m3 offset-l4">
                                            <div class="input-field col s12">
                                                <select name="party_affiliation" id="party_affiliation">
                                                    <option value="0" selected>Choose Party Affiliation</option>
                                                    <?php
                                                    foreach ( $parties_list as $party ) {
                                                            ?>
                                                            <option value="<?= $party[ 'id' ] ?>"<?php
                                                            if ( $user_detail[ 'party_affiliation' ] == $party[ 'id' ] ) {
                                                                    echo 'selected="selected"';
                                                            }
                                                            ?>><?= $party[ 'name' ] ?></option>
                                                                    <?php
                                                            }
                                                            ?>
                                                </select>
                                                <label>Party Affiliation</label>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
//                            }
                            ?>
                        </div>
                        <div class="center-align">
                            <button class="btn btn-black btn-large" type="submit" name="save_profile" id="save_profile" value="Save">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
        $(function () {
            $("#user_profile").on('submit', function (e) {
                e.preventDefault();

                var alise = $("#alise").val();
                var location = $("#location").val();
                var party_affiliation = $("#party_affiliation").val();

                if (alise == "") {
                    Materialize.Toast.removeAll();
                    Materialize.toast('Please enter alias name!', 4000);
                    return false;
                }
                if (location == "0") {
                    Materialize.Toast.removeAll();
                    Materialize.toast('Please select your location!', 4000);
                    return false;
                }
                if (party_affiliation == "0") {
                    Materialize.Toast.removeAll();
                    Materialize.toast('Please select party affiliation!', 4000);
                    return false;
                }

                $.ajax({
                    "url": "Profile/updateUserProfile",
                    "data": $(this).serialize(),
                    "method": "POST"
                }).done(function (result) {
                    result = JSON.parse(result);
                    if (result.status) {
                        Materialize.Toast.removeAll();
                        Materialize.toast(result.message + '!', 4000);
                        setTimeout(function () {
                            window.location.assign("<?= base_url() ?>Index");
<?php
//$session_querystring = $this -> session -> userdata( 'querystring' );
//if ( @$session_querystring[ 'section' ] == "discussion" ) {
//        ?>
//                                    window.location.assign("Forum");
        //<?php
//} else if ( @$session_querystring[ 'e' ] == "mp" ) {
//        ?>
//                                    window.location.assign("MP/Dashboard?a=2");
        //<?php
//} else if ( @$session_querystring[ 'e' ] == "ch" ) {
//        ?>
//                                    window.location.assign("Chhattisgarh/Dashboard?a=3");
        //<?php
//} else if ( @$session_querystring[ 'e' ] == "rj" ) {
//        ?>
//                                    window.location.assign("Rajasthan/Dashboard?a=4");
        //<?php
//} else if ( @$session_querystring[ 'e' ] == "tel" ) {
//        ?>
//                                    window.location.assign("Telangana/Dashboard?a=785465465");
        //<?php
//} else if ( @$session_querystring[ 'section' ] == "sc" ) {
//        ?>
//                                    window.location.assign("Sports/Dashboard");
        //<?php
//} else if ( @$session_querystring[ 'section' ] == "poll" ) {
//        $pid = "";
//        if ( @$session_querystring[ 'pid' ] ) {
//                $pid = @$session_querystring[ 'pid' ];
//        }
//        if ( @$session_querystring[ 'p' ] == "gov" ) {
//                ?>
//                                            window.location.assign("Poll/#elecforum&pid=//<?//= $pid ?>");
                //<?php
//        } else if ( @$session_querystring[ 'p' ] == "mon" ) {
//                ?>
//                                            window.location.assign("Poll/#stockforum&pid=//<?//= $pid ?>");
                //<?php
//        } else if ( @$session_querystring[ 'p' ] == "spo" ) {
//                ?>
//                                            window.location.assign("Poll/#sportforum&pid=//<?//= $pid ?>");
                //<?php
//        } else if ( @$session_querystring[ 'p' ] == "ent" ) {
//                ?>
//                                            window.location.assign("Poll/#movieforum&pid=//<?//= $pid ?>");
                //<?php
//        } else if ( @$session_querystring[ 'p' ] == "myp" ) {
//                ?>
//                                            window.location.assign("Poll/#mydiscuss");
                //<?php
//        } else if ( @$session_querystring[ 'p' ] == "pdp" ) {
//                $id = $session_querystring[ 'id' ];
//                $view = $session_querystring[ 'view' ];
//                ?>
//                                            window.location.assign("Poll/polldetail///<?//= $id ?>#<?= $view ?>");
                //<?php
//        } else {
//                ?>
//                                            window.location.assign("Poll");
                //<?php
//        }
//} else if ( @$session_querystring[ 'section' ] == "survey" ) {
//        ?>
//                                    window.location.assign("Survey");
        //<?php
//} else if ( @$session_querystring[ 'section' ] == "home" ) {
//        ?>
//                                    window.location.assign("//<?//= base_url() ?>Index");
        //<?php
//} else if ( @$session_querystring[ 'section' ] == "voice" ) {
//        ?>
//                                    window.location.assign("//<?//= base_url() ?>YourVoice");
        //<?php
//} else {
//        ?>
//                                    window.location.assign("Dashboard?section=//<?//= @$session_querystring[ 'section' ] ?>");
        //<?php
//}
?>

                        }, 2000);
}
                });
            });
        })
</script>