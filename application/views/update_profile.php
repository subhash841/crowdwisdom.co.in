<div class="container-fluid">
    <div class="container px-0">
        <div class="row my-4 topics fade show">
            <div class="col ">
                <div class="bg-w-block py-4 d-block  ">
                    <div class="row mx-3 my-2 title-hr pb-3">
                        <div class="col-md-4 pr-0 "><h4 class="pr-2 bg-white position-relative z-depth-2 d-inline"><b>Form</b></h4></div>
                        <hr class="z-depth-0 d-none d-md-block one">
                    </div>
                    <div class="row mx-3 my-2 mt-5 ">
                        <div class="col-md-4 mb-5 mb-md-0 mx-auto">
                            <div class="border text-center z-depth-4">
                                <div class="d-grid">
                                    <div class="position-relative d-flex justify-content-left justify-content-md-center">
                                        <img src="<?= base_url() . "/images/common/11.png" ?>" class="border rounded-circle p-3 cust-form-logo position-absolute bg-white ">
                                    </div>
                                    <b class="mt-md-5 mb-3 pt-3">Alias</b>                                    
                                </div>

                                <div class="form-group border-top my-0 py-4 px-3">
                                    <input class="form-control" type="text" name="alias" id="alise" placeholder="ex. jd007p" value="<?= $user_detail[ 'alise' ] ?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-5 mb-md-0 mx-auto">
                            <div class="border text-center z-depth-4">
                                <div class="d-grid">
                                    <div class="position-relative d-flex justify-content-left justify-content-md-center">
                                        <img src="<?= base_url() . "/images/common/12.png" ?>" class="border rounded-circle p-3 cust-form-logo position-absolute bg-white  ">
                                    </div>
                                    <b class="mt-md-5 mb-3 pt-3">Part Affilation</b>
                                </div>

                                <div class="form-group border-top my-0 py-4 px-3">
                                    <select name="party_affiliation" id="party_affiliation" class="form-control">
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
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-2 mb-md-0 mx-auto">
                            <div class="border text-center z-depth-4">
                                <div class="d-grid">
                                    <div class="position-relative d-flex justify-content-left justify-content-md-center">
                                        <img src="<?= base_url() . "/images/common/13.png" ?>" class="border rounded-circle p-3 cust-form-logo position-absolute bg-white ">
                                    </div>
                                    <b class="mt-md-5 mb-3 pt-3">Location</b>
                                </div>

                                <div class="form-group border-top my-0 py-4 px-3">
                                    <select name="location" class="form-control" id="location">
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
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row mx-3 mt-4 ">
                        <div class="col-12 text-center">
                            <button class="mb-2 btn lg btn-outline-primary btn-primary rounded-btn mx-auto" id="update-btn">Submit</button>                            
                        </div>                        
                        <div class='m-auto col-md-5 float-right' id='alert_placeholder' ></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<script>
        $(function () {

            function showalert(message, alerttype) {
                $('#alert_placeholder').fadeIn('fast');
                $('#alert_placeholder').html("<div class ='alert alert-" + alerttype + "' >" + message + "<button type='button' class='close' data-dismiss='alert' aria-label='close'><span aria-hidden='true'>&times</span></button></div> ");
                setTimeout(function () {
                    $('#alert_placeholder').fadeOut('fast');
                }, 3000);
            }

            $('#update-btn').click(function () {
                var alias = $('[name=alias]').val();
                var party = $('#party_affiliation').val();
                var location = $('#location').val();
                if (alias == '') {
                    showalert('Please Enter Name', 'danger');
                } else if (party == '0') {
                    showalert('Please Select Party Affilation', 'danger');
                } else if (location == '0') {
                    showalert('Please Select Location ', 'danger');
                } else {
                    $.ajax({
                        url: 'update_user_profile',
                        type: 'POST',
                        data: {alias: alias, location: location, party_affiliation: party}
                    }).done(function (e) {
                        if (e)
//                            showalert('Data Updated Sucessfully', 'success');
                            showalert('Data Updated Sucessfully', 'success');
                        else
                            showalert('Please Try Again Later', 'danger');
                    }).fail(function (e) {
                        showalert('Please Try Again Later', 'danger');
                    });
                }

            }
            )
        }
        )
</script>