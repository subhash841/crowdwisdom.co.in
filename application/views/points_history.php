<!--start of mobile view banner-->
<div class="col-12 d-sm-block d-md-none" id="mobileview">
    <ul class="nav nav-pills my-3 nav-fill">


        <li class="nav-item mr-3">
            <!--<a class="nav-link rounded-btn white" data-toggle="tab" href="JavaScript:Void(0)" id="walletlink">Wallet</a>-->
            <a class="nav-link active white rounded-btn" data-toggle="tab" href="#wallet" role="tab" aria-controls="home" aria-selected="true" id="walletlink">Wallet</a>
        </li>
        <li class="nav-item">
            <!--<a class="nav-link active rounded-btn white" data-toggle="tab" href="JavaScript:Void(0)" id="profilelink">Profile</a>-->
            <a class="nav-link white rounded-btn show" data-toggle="tab" href="#profile" role="tab" aria-controls="home" id="profilelink">Profile</a>
        </li>
    </ul>
</div>
<div>
    <div class="col-12 d-sm-block d-md-none position-relative d-flex align-items-center justify-content-center" id="mobileviewbanner">

        <div class="row no-gutters w-75 text-center">
            <div class="col-10"> 
                <h5 class="alias font-weight-normal"><?= $user_data[ 'alias' ]; ?></h5> 
                <input type="text" value="<?= $user_data[ 'alias' ]; ?>" class="d-none form-control name_edit" />
            </div>
            <div class="col-2">
                <a href="#" class="nameedit no-underline" data-id="<?= $user_data[ 'alias' ]; ?>"> 
                    <svg class='edit-icon d-inline-block' height="15px" style='fill:white;' viewBox="0 -1 401.52289 401" width="20px" xmlns="http://www.w3.org/2000/svg"><path d="m370.589844 250.972656c-5.523438 0-10 4.476563-10 10v88.789063c-.019532 16.5625-13.4375 29.984375-30 30h-280.589844c-16.5625-.015625-29.980469-13.4375-30-30v-260.589844c.019531-16.558594 13.4375-29.980469 30-30h88.789062c5.523438 0 10-4.476563 10-10 0-5.519531-4.476562-10-10-10h-88.789062c-27.601562.03125-49.96875 22.398437-50 50v260.59375c.03125 27.601563 22.398438 49.96875 50 50h280.589844c27.601562-.03125 49.96875-22.398437 50-50v-88.792969c0-5.523437-4.476563-10-10-10zm0 0"/><path d="m376.628906 13.441406c-17.574218-17.574218-46.066406-17.574218-63.640625 0l-178.40625 178.40625c-1.222656 1.222656-2.105469 2.738282-2.566406 4.402344l-23.460937 84.699219c-.964844 3.472656.015624 7.191406 2.5625 9.742187 2.550781 2.546875 6.269531 3.527344 9.742187 2.566406l84.699219-23.464843c1.664062-.460938 3.179687-1.34375 4.402344-2.566407l178.402343-178.410156c17.546875-17.585937 17.546875-46.054687 0-63.640625zm-220.257812 184.90625 146.011718-146.015625 47.089844 47.089844-146.015625 146.015625zm-9.40625 18.875 37.621094 37.625-52.039063 14.417969zm227.257812-142.546875-10.605468 10.605469-47.09375-47.09375 10.609374-10.605469c9.761719-9.761719 25.589844-9.761719 35.351563 0l11.738281 11.734375c9.746094 9.773438 9.746094 25.589844 0 35.359375zm0 0"/></svg> 
                    <p class="checksign text-white no-underline mt-2 d-none">&#x2714;</p> 
                </a>
            </div>
        </div>
        <!--        <div class="position-absolute" style="bottom: 10px; width: 88%;" id="profilebanner" >
                    <div>
                        <div class="float-left">                    
                            <img src="<?= base_url( "images/icons/wallet-icon.png" ) ?>" alt="" class="icon"/>
                            <h5 class="float-right ml-3 font-weight-normal mb-0 mt-1">Wallet</h5>
                        </div>
                        <div class="float-right">
                            <h5 class="float-left">&#x20b9;</h5>
                            <h5 class="float-right ml-1">0</h5>
                        </div>
                    </div>
                </div>-->

        <div style="position: absolute;bottom:10px;width: 100%" id="walletbanner">
            <div class="d-flex justify-content-around">
                <div class="d-flex justify-content-around">
                    <img src="<?= base_url( "images/icons/coins-icon.png" ) ?>" alt="" style="height: 25px;" class="icon"/>
                    <h5><?= $silver_points ?></h5>
                </div>
                <div class=" w-25 justify-content-around d-none">
                    <img src="<?= base_url( "images/icons/wallet-icon.png" ) ?>" alt="" style="height: 25px;" class="icon"/>
                    <h5 class="float-right ml-1">0</h5>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end of mobile view banner-->

<div class="container-fluid">
    <div class="row">
        <div class='col-md-2  bg-w-block pt-5 d-none d-lg-block d-xl-block d-md-block cust-height'>
            <div class='row'>
                <div class='col-12 '>
                    <div class="row no-gutters">
                        <div class="col-10">
                            <b class="alias"><?= $user_data[ 'alias' ]; ?></b>
                            <input type="text" value="" class="d-none form-control name_edit" />
                        </div>
                        <div class="col-2">
                            <a href="#" class="nameedit no-underline" data-id="<?= $user_data[ 'alias' ]; ?>">
                                <svg class='edit-icon d-inline-block' height="15px" viewBox="0 -1 401.52289 401" width="20px" xmlns="http://www.w3.org/2000/svg"><path d="m370.589844 250.972656c-5.523438 0-10 4.476563-10 10v88.789063c-.019532 16.5625-13.4375 29.984375-30 30h-280.589844c-16.5625-.015625-29.980469-13.4375-30-30v-260.589844c.019531-16.558594 13.4375-29.980469 30-30h88.789062c5.523438 0 10-4.476563 10-10 0-5.519531-4.476562-10-10-10h-88.789062c-27.601562.03125-49.96875 22.398437-50 50v260.59375c.03125 27.601563 22.398438 49.96875 50 50h280.589844c27.601562-.03125 49.96875-22.398437 50-50v-88.792969c0-5.523437-4.476563-10-10-10zm0 0"/><path d="m376.628906 13.441406c-17.574218-17.574218-46.066406-17.574218-63.640625 0l-178.40625 178.40625c-1.222656 1.222656-2.105469 2.738282-2.566406 4.402344l-23.460937 84.699219c-.964844 3.472656.015624 7.191406 2.5625 9.742187 2.550781 2.546875 6.269531 3.527344 9.742187 2.566406l84.699219-23.464843c1.664062-.460938 3.179687-1.34375 4.402344-2.566407l178.402343-178.410156c17.546875-17.585937 17.546875-46.054687 0-63.640625zm-220.257812 184.90625 146.011718-146.015625 47.089844 47.089844-146.015625 146.015625zm-9.40625 18.875 37.621094 37.625-52.039063 14.417969zm227.257812-142.546875-10.605468 10.605469-47.09375-47.09375 10.609374-10.605469c9.761719-9.761719 25.589844-9.761719 35.351563 0l11.738281 11.734375c9.746094 9.773438 9.746094 25.589844 0 35.359375zm0 0"/></svg>
                                <p class="checksign  mt-2 d-none">&#x2714;</p>
                            </a>
                        </div>


                    </div>
                    <hr>
                </div>
            </div>

            <div class="row">
                <div class='col-12 d-none d-lg-block d-xl-block d-md-block ' id="desktopview"> 
                    <ul class="nav flex-column" id="walletnav">
                        <li class="nav-item" >
                            <a class="nav-link" data-toggle="tab" href="#profile" role="tab" aria-controls="home" aria-selected="true"> 
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon mr-2" viewbox="0 0 27 27">
                                    <path fill-rule="evenodd"  
                                          d="M26.000,13.000 C26.000,5.832 20.168,-0.000 13.000,-0.000 C5.832,-0.000 -0.000,
                                          5.832 -0.000,13.000 C-0.000,16.786 1.628,20.199 4.219,22.576 L4.207,22.587 L4.629,
                                          22.943 C4.656,22.966 4.686,22.985 4.714,23.008 C4.938,23.193 5.170,23.370 5.406,
                                          23.540 C5.483,23.596 5.559,23.651 5.637,23.705 C5.890,23.879 6.149,24.044 6.413,
                                          24.200 C6.471,24.234 6.529,24.267 6.587,24.301 C6.877,24.466 7.173,24.621 7.476,
                                          24.764 C7.498,24.774 7.521,24.784 7.543,24.794 C8.531,25.253 9.585,25.590 10.687,
                                          25.789 C10.716,25.794 10.745,25.800 10.774,25.805 C11.117,25.864 11.463,25.911 11.813,
                                          25.943 C11.855,25.947 11.898,25.949 11.941,25.953 C12.290,25.981 12.643,26.000 13.000,
                                          26.000 C13.354,26.000 13.703,25.981 14.050,25.954 C14.094,25.950 14.138,25.947 14.182,
                                          25.944 C14.530,25.912 14.873,25.866 15.212,25.808 C15.241,25.803 15.271,25.798 15.300,
                                          25.792 C16.386,25.597 17.425,25.268 18.400,24.821 C18.436,24.804 18.472,24.788 18.508,
                                          24.771 C18.800,24.634 19.085,24.486 19.364,24.329 C19.434,24.290 19.503,24.250 19.572,
                                          24.209 C19.826,24.059 20.076,23.903 20.319,23.737 C20.407,23.677 20.492,23.614 20.579,
                                          23.552 C20.786,23.402 20.990,23.248 21.188,23.087 C21.232,23.052 21.279,23.021 21.322,
                                          22.984 L21.755,22.623 L21.742,22.612 C24.356,20.234 26.000,16.805 26.000,13.000 ZM0.945,
                                          13.000 C0.945,6.353 6.353,0.945 13.000,0.945 C19.647,0.945 25.055,6.353 25.055,
                                          13.000 C25.055,16.582 23.483,19.802 20.994,22.012 C20.855,21.916 20.715,21.830 20.572,
                                          21.758 L16.570,19.757 C16.210,19.577 15.987,19.216 15.987,18.814 L15.987,17.417 C16.080,
                                          17.302 16.178,17.173 16.279,17.030 C16.797,16.299 17.212,15.485 17.515,14.609 C18.114,
                                          14.324 18.501,13.727 18.501,13.054 L18.501,11.378 C18.501,10.968 18.351,10.571 18.082,
                                          10.258 L18.082,8.052 C18.106,7.807 18.193,6.422 17.192,5.280 C16.320,4.285 14.910,
                                          3.782 13.000,3.782 C11.090,3.782 9.680,4.285 8.808,5.279 C7.807,6.421 7.894,
                                          7.806 7.918,8.051 L7.918,10.258 C7.650,10.570 7.499,10.968 7.499,11.378 L7.499,
                                          13.053 C7.499,13.574 7.732,14.059 8.132,14.387 C8.515,15.887 9.303,17.022 9.594,
                                          17.407 L9.594,18.775 C9.594,19.161 9.384,19.516 9.045,19.701 L5.307,21.740 C5.188,
                                          21.804 5.070,21.880 4.952,21.965 C2.494,19.756 0.945,16.556 0.945,13.000 ZM20.071,
                                          22.753 C19.906,22.873 19.738,22.990 19.567,23.101 C19.489,23.152 19.411,23.203 19.331,
                                          23.253 C19.108,23.391 18.881,23.522 18.649,23.645 C18.598,23.672 18.546,23.697 18.495,
                                          23.724 C17.963,23.997 17.412,24.231 16.846,24.421 C16.826,24.428 16.806,24.435 16.786,
                                          24.442 C16.490,24.540 16.189,24.628 15.886,24.703 C15.885,24.703 15.884,24.703 15.883,
                                          24.703 C15.577,24.779 15.267,24.842 14.955,24.893 C14.946,24.895 14.938,24.897 14.929,
                                          24.898 C14.636,24.946 14.340,24.980 14.043,25.006 C13.990,25.011 13.938,25.014 13.885,
                                          25.018 C13.591,25.040 13.296,25.054 13.000,25.054 C12.700,25.054 12.401,25.040 12.104,
                                          25.018 C12.053,25.014 12.001,25.011 11.950,25.006 C11.650,24.979 11.352,24.944 11.057,
                                          24.896 C11.043,24.893 11.030,24.891 11.017,24.889 C10.392,24.784 9.777,24.630 9.178,
                                          24.430 C9.159,24.423 9.141,24.417 9.122,24.411 C8.825,24.310 8.531,24.197 8.242,
                                          24.074 C8.240,24.073 8.238,24.072 8.236,24.071 C7.963,23.953 7.695,23.823 7.430,
                                          23.685 C7.395,23.667 7.360,23.650 7.326,23.632 C7.085,23.503 6.848,23.363 6.615,
                                          23.217 C6.546,23.174 6.478,23.130 6.410,23.086 C6.195,22.945 5.983,22.799 5.777,
                                          22.645 C5.756,22.628 5.736,22.611 5.714,22.595 C5.729,22.587 5.745,22.578 5.760,
                                          22.570 L9.498,20.531 C10.140,20.180 10.540,19.508 10.540,18.775 L10.539,17.073 L10.431,
                                          16.941 C10.420,16.929 9.398,15.686 9.012,14.003 L8.969,13.815 L8.808,13.711 C8.580,
                                          13.564 8.444,13.318 8.444,13.053 L8.444,11.377 C8.444,11.157 8.537,10.953 8.708,
                                          10.799 L8.864,10.658 L8.864,8.025 L8.859,7.963 C8.858,7.952 8.718,6.815 9.519,
                                          5.902 C10.203,5.123 11.374,4.727 13.000,4.727 C14.620,4.727 15.787,5.120 16.473,
                                          5.893 C17.272,6.796 17.141,7.955 17.141,7.964 L17.136,10.659 L17.292,10.800 C17.462,
                                          10.953 17.556,11.158 17.556,11.378 L17.556,13.054 C17.556,13.391 17.326,13.697 16.997,
                                          13.798 L16.762,13.871 L16.687,14.105 C16.408,14.971 16.011,15.772 15.507,
                                          16.484 C15.383,16.658 15.262,16.813 15.159,16.932 L15.042,17.066 L15.042,
                                          18.814 C15.042,19.577 15.465,20.262 16.147,20.602 L20.149,22.603 C20.175,
                                          22.616 20.200,22.629 20.225,22.643 C20.175,22.681 20.123,22.716 20.071,22.753 Z"/>

                                </svg>Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#wallet" role="tab" aria-controls="home" aria-selected="true"> 
                                <svg class="icon mr-2" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 25 25">
                                    <path fill-rule="evenodd" 
                                          d="M23.000,11.180 L21.885,11.180 L21.885,5.883 C21.885,4.613 20.885,3.580 19.656,3.580 
                                          L18.146,3.580 L16.601,0.711 C16.366,0.272 15.918,-0.000 15.432,-0.000 C15.205,-0.000 
                                          14.980,0.060 14.782,0.174 L8.853,3.580 L2.229,3.580 C1.000,3.580 -0.000,4.613 -0.000,
                                          5.883 L-0.000,21.697 C-0.000,22.967 1.000,24.000 2.229,24.000 L19.656,24.000 C20.885,
                                          24.000 21.885,22.967 21.885,21.697 L21.885,17.053 L23.000,17.053 L23.000,11.180 L23.000,
                                          11.180 ZM19.656,4.501 C20.343,4.501 20.903,5.040 20.979,5.730 L19.303,5.730 L18.642,
                                          4.501 L19.656,4.501 ZM15.216,0.979 C15.425,0.858 15.706,0.943 15.822,1.158 L18.283,
                                          5.729 L6.946,5.729 L15.216,0.979 ZM20.993,21.697 C20.993,22.459 20.393,23.079 19.656,
                                          23.079 L2.229,23.079 C1.492,23.079 0.892,22.459 0.892,21.697 L0.892,5.883 C0.892,
                                          5.121 1.492,4.501 2.229,4.501 L7.249,4.501 L5.111,5.730 L2.508,5.730 C2.262,5.730 2.062,
                                          5.936 2.062,6.190 C2.062,6.445 2.262,6.651 2.508,6.651 L3.507,6.651 L19.799,
                                          6.651 L20.993,6.651 L20.993,11.181 L17.733,11.181 C16.219,11.181 14.986,12.454 14.986,
                                          14.018 L14.986,14.216 C14.986,15.780 16.219,17.053 17.733,17.053 L20.993,17.053 L20.993,
                                          21.697 L20.993,21.697 ZM22.108,16.132 L21.885,16.132 L17.733,16.132 C16.710,
                                          16.132 15.878,15.272 15.878,14.215 L15.878,14.017 C15.878,12.961 16.710,12.101 17.733,
                                          12.101 L21.885,12.101 L22.108,12.101 L22.108,16.132 ZM19.099,14.154 C19.099,
                                          14.716 18.658,
                                          15.171 18.114,15.171 C17.570,15.171 17.130,14.716 17.130,14.154 C17.130,13.592 17.570,
                                          13.137 18.114,13.137 C18.658,13.137 19.099,13.593 19.099,14.154 Z"/>
                                </svg>Wallet</a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="col">

            <div class="tab-content">
                <div class=" tab-pane fade" id="wallet"  role="tabpanel" >
                    <div class="row  pt-5">
                        <div class="col">
                            <b>Wallet</b>
                            <ul class="nav nav-pills mt-3 justify-content-center justify-content-md-start ">
                                <li class="nav-item mr-3 flex-fill flex-sm-grow-0">
                                    <a class="nav-link text-center active rounded-btn white" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">History</a>
                                </li>
                                <li class="nav-item flex-fill flex-sm-grow-0 d-none">
                                    <a class="nav-link  text-center rounded-btn white" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Passbook</a>
                                </li>
                            </ul>
                            <div class="tab-content mt-4">
                                <div class="tab-pane pointhistory fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="table-responsive">
                                        <table class="table">
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab"></div>
                            </div>



                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="profile"  role="tabpanel" >
                    <!--start of desktop view profile-->
                    <div class="d-none d-lg-block d-xl-block d-md-block">
                        <div class="row  pt-5 pb-3 mx-3">
                            <div class="col-sm-3">
                                <img src="<?= base_url( "images/icons/coins-icon.png" ) ?>" alt="" class="icon"/>
                                <b>Coins <span class="coinscount ml-5"><?= $this -> session -> userdata[ 'data' ][ 'silver_points' ] ?></span></b>
                            </div>
                            <!--<div class="col-sm-3">
                                <img src="<?= base_url( "images/icons/wallet-icon.png" ) ?>" alt="" class="icon"/>
                                <b>Wallet <span class="walletcount ml-5">100</span></b>
                            </div>-->
                        </div>
                        <div class="row mx-3 my-2 title-hr blue">
                            <div class="col-md-4 pr-0 "><h4 class="pr-2 bg-body position-relative z-depth-2 d-inline">Basic <b>Information</b></h4>
                            </div>
                            <hr class="z-depth-0 d-none d-md-block one">
                        </div>
                        <div class="row mx-md-3 p-3">
                            <div class="col  bg-w-block px-3 py-4">
                                <div class="row">
                                    <div class="col-md-2 col-6 mb-3">
                                        Alias
                                    </div>
                                    <div class="col-md-4 col-6 mb-3">
                                        <b class="main-alias"><?= $user_data[ 'alias' ] ?></b>
                                    </div>
                                    <div class="col-md-2 col-6 mb-3">
                                        Email id
                                    </div>
                                    <div class="col-md-4 col-6 mb-3">
                                        <b><?= $user_data[ 'email' ] ?></b>
                                    </div>

                                    <div class="col-md-2 col-6 mb-3">
                                        Party Affiliation
                                    </div>
                                    <div class="col-md-4 col-6 mb-3">
                                        <b><?= $user_data[ 'party_affiliation' ] ?></b>
                                    </div>
                                    <div class="col-md-2 col-6 mb-3">
                                        Location
                                    </div>
                                    <div class="col-md-4 col-6 mb-3">
                                        <b><?= $user_data[ 'location' ] ?></b>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-md-6 col-12">

                                <div class="row mx-md-3 my-2 title-hr blue">
                                    <div class="col-md-4 pr-0 "><h4 class="pr-2 bg-body position-relative z-depth-2 d-inline">Points <b>Details</b></h4>
                                    </div>
                                    <hr class="z-depth-0 d-none d-md-block one" />
                                    <div class="offset-md-4 col-md-3 load-btn-holder text-center d-none d-md-block">
                                        <a class="nav-link btn btn-outline-primary readmore rounded-btn z-depth-2" data-toggle="tab" href="#wallet" role="tab" aria-controls="home" aria-selected="false">History</a>
                                    </div>

                                </div>
                                <div class="row mx-md-3 p-3">
                                    <div class="col  bg-w-block p-3">
                                        <div class="row">
                                            <div class="col">
                                                Silver Points
                                            </div>
                                            <div class="col">
                                                <b><?= $this -> session -> userdata[ 'data' ][ 'silver_points' ] ?></b>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col">
                                                Gold Points
                                            </div>
                                            <div class="col">
                                                <b><?= $user_data[ 'total_gold' ] ?></b>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col">
                                                Diamond Points
                                            </div>
                                            <div class="col">
                                                <b>0</b>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6 col-12 d-none">
                                <div class="row mx-3 my-2 title-hr blue">
                                    <div class="col-md-4 pr-0 "><h4 class="pr-2 bg-body position-relative z-depth-2 d-inline">Game <b>Details</b></h4>
                                    </div>
                                    <hr class="z-depth-0 d-none d-md-block one" />
                                    <div class="offset-md-4 col-md-3 load-btn-holder text-center d-none d-md-block">
                                        <a href="/YourVoice" class="btn btn-outline-primary readmore rounded-btn load-more-voice-list z-depth-2">History</a>
                                    </div>
                                </div>
                                <div class="row mx-md-3 p-3">
                                    <div class="col  bg-w-block p-3">
                                        <div class="row">
                                            <div class="col">
                                                Game Played
                                            </div>
                                            <div class="col">
                                                <b>0</b>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col">
                                                Game Won
                                            </div>
                                            <div class="col">
                                                <b>0</b>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col">
                                                Pending Questions
                                            </div>
                                            <div class="col">
                                                <b>0</b>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end of desktop view profile-->

                    <!--start of mobile view profile-->
                    <div class=" d-sm-block d-md-none">
                        <div class="row mx-md-3 p-3">
                            <div class="col  bg-w-block p-3 clearfix">
                                <div class="row justify-content-between px-3">
                                    <div >
                                        <b class="font-weight-normal ">Points Details</b>
                                        <hr align='left' class="cust-hr" >
                                    </div>
                                    <div >
                                        <button class="btn btn-sm rounded-btn px-2 py-0 bg-primary text-white">History</button>
                                    </div>        
                                </div>

                                <div class="row " id="points">
                                    <div class="col-md-3 col-5 mb-1">
                                        <b>Silver Points</b>
                                    </div>
                                    <div class="col-md-3 col-7 mb-1">
                                        <b><?= $this -> session -> userdata[ 'data' ][ 'silver_points' ] ?></b>
                                    </div>
                                    <div class="col-md-3 col-5 mb-1">
                                        <b>Gold Points</b>
                                    </div>
                                    <div class="col-md-3 col-7 mb-1">
                                        <b><?= $user_data[ 'total_gold' ] ?></b>
                                    </div>
                                    <div class="col-md-3 col-5 mb-1">
                                        <b>Diamonds Points</b>
                                    </div>
                                    <div class="col-md-3 col-7 mb-1">
                                        <b>0</b>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row ">
                            <div class="col-md-6 col-12">
                                <div class="row mx-md-3 p-3">
                                    <div class="col  bg-w-block p-3">
                                        <div class="row justify-content-between px-3">
                                            <div >
                                                <b class="font-weight-normal ">Basic Information</b>
                                                <hr align='left' class="cust-hr" >
                                            </div>
                                            <div >
                                                <button class="btn btn-sm rounded-btn px-2 py-0 bg-primary text-white">History</button>
                                            </div>        
                                        </div>
                                        <div class="row " id="basicinfo">
                                            <div class="col-md-3 col-5 mb-1">
                                                <b>Alias</b>
                                            </div>
                                            <div class="col-md-3 col-7 mb-1">
                                                <b class="main-alias"><?= $user_data[ 'alias' ] ?></b>
                                            </div>
                                            <div class="col-md-3 col-5 mb-1">
                                                <b>Party Affiliation</b>
                                            </div>
                                            <div class="col-md-3 col-7 mb-1">
                                                <b><?= $user_data[ 'party_affiliation' ] ?></b>
                                            </div>
                                            <div class="col-md-3 col-5 mb-1">
                                                <b>Location</b>
                                            </div>
                                            <div class="col-md-3 col-7 mb-1">
                                                <b><?= $user_data[ 'location' ] ?></b>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12 d-none">

                                <div class="row mx-md-3 p-3">
                                    <div class="col  bg-w-block p-3">
                                        <div class="row justify-content-between px-3">
                                            <div >
                                                <b class="font-weight-normal ">Game Details</b>
                                                <hr align='left' class="cust-hr" >
                                            </div>
                                            <div >
                                                <button class="btn btn-sm rounded-btn px-2 py-0 bg-primary text-white">History</button>
                                            </div>        
                                        </div>
                                        <div class="row " id="gaminginfo">
                                            <div class="col-md-3 col-5 mb-1">
                                                <b>Games Played</b>
                                            </div>
                                            <div class="col-md-3 col-7 mb-1">
                                                <b>6</b>
                                            </div>
                                            <div class="col-md-3 col-5 mb-1">
                                                <b>Games Won</b>
                                            </div>
                                            <div class="col-md-3 col-7 mb-1">
                                                <b>2</b>
                                            </div>
                                            <div class="col-md-3 col-5 mb-1">
                                                <b>Pending Question </b>
                                            </div>
                                            <div class="col-md-3 col-7 mb-1">
                                                <b>5</b>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!--end of mobile view profile-->
                </div>
            </div>
        </div>
    </div>
</div>   


<script src="<?= base_url() ?>js/profile.js?v=0.6" type="text/javascript"></script>
<script>
        $('#profilelink').click(function () {
            $('#profilebanner').removeClass('d-none').addClass('d-block');
            $('#walletbanner').removeClass('d-block').addClass('d-none');
        });
        $('#walletlink').click(function () {
            $('#walletbanner').removeClass('d-none').addClass('d-block');
            $('#profilebanner').removeClass('d-block').addClass('d-none');
        });
        $('.nameedit').hover(function () {
            $(this).css({cursor: 'pointer'});
        });
        $('.nameedit').click(function (e) {
            var cont = $(this).closest(".row");
            e.preventDefault();
            $('.checksign', cont).removeClass('d-none');
            $('.edit-icon', cont).removeClass('d-inline-block').addClass('d-none');

            $('.alias', cont).addClass('d-none');
            $('.name_edit', cont).removeClass('d-none').val($(this).attr('data-id'));
        });

        $('.checksign').click(function () {

            var cont = $(this).closest(".row");
            var value = $('.name_edit', cont).val();
            $.post(base_url + 'Wallet/update_name', {name: value})
                    .done(function (e) {
                        e = jQuery.parseJSON(e);
                        if (e.status) {
                            $('.alias').html(e.name);
                            $('.nameedit').attr('data-id', e.name);
                            $('.name_edit').addClass('d-none');
                            $('.alias').removeClass('d-none');
                            $('.main-alias').html(e.name);
                            $('.edit-icon', cont).removeClass('d-none').addClass('d-inline-block');
                            $('.checksign', cont).addClass('d-none');
                        } else {
                            alert('please try again later');
                        }
                    });
        });

</script>
