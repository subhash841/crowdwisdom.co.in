<div class="content container">
    <div class="row minus-m-t8"><!--mb-12-->
        <div class="col m12 s12 plr15 equal-height">
            <form name="user_profile" id="user_profile" method="post">
                <div class="card z-depth-4">
                    <div class="card-content center">
                        <div class="" style="height: 30vh;">
                            <div class="row">
                                <div class="col l4 m6 s12 offset-m3 offset-l4">
                                    <div class="input-field col s12">
                                        <select name="location" id="location">
                                            <option value="0" selected>Choose your location</option>
                                            <?php
                                            foreach ($all_states as $states_list) {
                                                ?>
                                                <option value="<?php echo $states_list['id'] ?>" <?php if ($user_detail['location'] == $states_list['id']) {
                                                echo 'selected="selected"';
                                            } ?>><?php echo $states_list['name'] ?></option>
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
                                            foreach ($parties_list as $party) {
                                            ?>
                                            <option value="<?= $party['id']?>"<?php if ($user_detail['party_affiliation'] == $party['id']) {
                                                echo 'selected="selected"';
                                            } ?>><?= $party['name']?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        <label>Party Affiliation</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <input class="btn btn-black btn-large" type="submit" name="save_profile" id="save_profile" value="Save">
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

            var location = $("#location").val();
            var party_affiliation = $("#party_affiliation").val();

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
                        window.location.assign("Dashboard");
                    }, 2000);
                }
            });
        });
    })
</script>