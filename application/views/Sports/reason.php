<style>
    #reasonheader tr th:nth-child(2), .reasondata tr td:nth-child(2) {
        width: 11% !important;
        text-align: left;
    }
    .mobileview tr td:last-child {
        color: rgba(0,0,0,0.87);
        width: 11% !important;
    }
</style>
<div class="loadersmall loadreason" style="display:none"></div>
<div class="content container">
    <div class="row minus-m-t20"><!--minus-m-t8 mb-12--><!--minus-m-t20-->
        <div class="col m12 s12 plr15 equal-height">
            <div class="card z-depth-4"> <!--style="margin-top: 100px;"-->
                <div class="row plr15">
                    <div class="reason_cover coverleft ">
                        <h3 class="f40 mtb0-30 darkblue" style="display:inline">Prediction Reasons</h3>
                        <a href="<?php echo base_url() ?>Login?section=sc" class="btn hide btn-black savebtn right hide-on-med-and-down">Predict now</a>
                    </div>
                    <div class="center hide-on-large-only">
                        <a href="<?php echo base_url() ?>Login?section=sc" class="btn hide btn-black savebtn">Predict now</a>
                    </div>
                </div>
                <div class="card-content center" id='reasoncontent'>
                    <?php
                    $records = (@$current_page - 1) * 10;
                    foreach ($reasons as $key => $reason_forecast) {
                        ?>
                        <table class="reasondata webview hide-on-med-and-down">
                            <tbody>
                                <tr>
                                    <?php $records = $records + 1 ?>
                                    <td><?= $records ?>.</td>
                                    <td><!--$reason_forecast['party_affilication'] . ', ' . --><?= $reason_forecast['location'] ?></td>
                                    <?php
                                    foreach ($reasons[0]['forecast'] as $party_data):
                                        echo '<td class="partyhead">' . $party_data['abbreviation'] . '</td>';
                                    endforeach;
                                    ?>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><p><!--<img src="<?php echo base_url() ?>/images/common/seats.png"/>-->Score</p></td>
                                    <?php
                                    foreach ($reason_forecast['forecast'] as $forecast_data):
                                        ?>
                                        <td><?= $forecast_data['score_forecast'] ?></td>
                                        <?php
                                    endforeach;
                                    ?>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><!--<img src="<?php echo base_url() ?>/images/common/votes.png"/>-->Wicket</td>
                                    <?php
                                    foreach ($reason_forecast['forecast'] as $forecast_data):
                                        ?>
                                        <td><?= $forecast_data['wicket_forecast'] ?></td>
                                        <?php
                                    endforeach;
                                    ?>
                                </tr>
                                <tr>
                                    <td colspan="14"><hr /></td>
                                </tr>
                                <tr>
                                    <td colspan="14" class="display_reason">
                                        <p class="multiline-ellipsis wbba" data-id="<?= $key ?>"><?= htmlspecialchars($reason_forecast['reason']) ?></p>
                                        <?php if (strlen($reason_forecast['reason']) > 250) { ?>
                                            <a data-id="<?= $key ?>" class="button show_hide_reason">Read More</a>
                                        <?php } ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    <?php }
                    ?>
                    <?php
                    $records = (@$current_page - 1) * 10;
                    foreach ($reasons as $key => $reason_forecast) {
                        ?>
                        <table class="reasondata mobileview hide-on-large-only">
                            <tbody>
                                <tr>
                                    <?php $records = $records + 1 ?>
                                    <th colspan="3" class="left-align"><!--$reason_forecast['party_affilication'] . ', ' . --><?= $records ?>. <?= $reason_forecast['location'] ?></th>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td class="grayblue"><!--<img src="<?php echo base_url() ?>/images/common/seats.png"/>-->Score</td>
                                    <td class="grayblue"><!--<img src="<?php echo base_url() ?>/images/common/votes.png"/>-->Wicket</td>
                                </tr>
                                <?php
                                foreach ($reason_forecast['forecast'] as $forecast_data):
                                    ?>
                                    <tr>
                                        <th><?= $forecast_data['abbreviation'] ?></th>
                                        <td><?= $forecast_data['score_forecast'] ?></td>
                                        <td><?= $forecast_data['wicket_forecast'] ?></td>
                                    </tr>
                                    <?php
                                endforeach;
                                ?>
                                <tr>
                                    <td colspan="3" class="p-0"><hr /></td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="pt0">
                                        <p class="multiline-ellipsis wbba grayblue" data-id="<?= $key ?>"><?= htmlspecialchars($reason_forecast['reason']) ?></p>
                                        <?php if (strlen($reason_forecast['reason']) > 70) { ?>
                                            <a data-id="<?= $key ?>" class="button show_hide_reason right">Read More</a>
                                        <?php } ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    <?php }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="current_page" id="current_page" value="1">
    <?php if ($total_reasons > 10) { ?>
        <div class="row">
            <div class="" style="width:100%;text-align:center;">
                <div class="mypagination" style="display: inline-block"></div>
            </div>
        </div>
    <?php } ?>
</div>

<div id="forecastreason" class="modal">
    <div class="modal-content">
        <h4>Modal Header</h4>
        <p>A bunch of text</p>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
    </div>
</div>
<script>
    $(document).on('click', '.show_hide_reason', function (e) {
        var currid = $(this).attr('data-id');
        if ($(this).siblings().hasClass('multiline-ellipsis')) {
            var txt = "Read Less"
            $('.show_hide_reason[data-id="' + currid + '"]').text(txt);
            $(this).siblings('p[data-id="' + currid + '"]').removeClass('multiline-ellipsis');
            //$(this).next('.content').slideToggle(200);
        } else {
            var txt = "Read More"
            $('.show_hide_reason[data-id="' + currid + '"]').text(txt);
            $(this).siblings('p[data-id="' + currid + '"]').addClass('multiline-ellipsis');
        }

    });
</script>
<script>
<?php if ($total_reasons > 10) { ?>
        $(function () {
            $('.mypagination').pagination({
                items: "<?= $total_reasons; ?>",
                itemsOnPage: 10,
                displayedPages: 3,
                currentPage: "<?= $current_page; ?>",
                hrefTextPrefix: "<?= base_url() ?>Sports/Reasons/Page/",
                cssStyle: 'light-theme'
            });
        });
<?php } ?>
</script>