<div class="row center-align footer-stripe show-on-small hide-on-med-and-up">
    <a href="<?= base_url() ?>Blogs"><div class="col s6">Your Voice</div></a>
    <!--<a href="<?= base_url() ?>Forum"><div class="col s4">WisdomForum</div></a>-->
    <a href="<?= base_url() ?>"><div class="col s6">Predictions</div></a>
</div>
<div class="white center" style="min-height: 40vh;padding: 20px;max-height: 260px;">
    <div class="container">
        <img src="<?= base_url('images/logo/red-logo.png'); ?>" style="margin: 20px;width: 300px;" class="footer-logo" />
        <h6 style="margin: -35px 0px 50px 0;color: #232b3c ;font-size: 12px;">
            powered by <a href="https://www.sundaymobility.com" target="_blank" style="color:red;font-weight: bold;">Sunday Mobility</a>
        </h6>
        <label style="color:#b9c2d2">Copyright @ 2017 SC Polling Insights and consultancy services LLP</label>
    </div>
</div>
<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="<?php echo base_url(); ?>js/materialize.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/slick/slick.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.matchHeight.js"></script>
<!--<script type="text/javascript" src="<?php echo base_url(); ?>assets/Flipclock/js/jquery.flipTimer.js"></script>-->
<script src="<?php echo base_url(); ?>assets/jQueryCounter/js/jquery.countdown.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/jQueryCounter/js/lodash.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/Pagination/jquery.simplePagination.js" type="text/javascript"></script>
<script>
    $(function () {
        //initialize materilize select
        $('select').material_select();

        //initialize parallax effect
        $('.parallax').parallax();

        //initialize slick slider
        $('#slickslider').slick({
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 3
        });
    });

    $(document).ready(function () {
        $('.equal-height').matchHeight();
        $('.equal-height-child').matchHeight();
    });
</script>

<!--counter Template-->
<script type="text/template" id="main-example-template">
    <div class="time <%= label %>">
    <span class="count curr top"><%= curr %></span>
    <span class="count next top"><%= next %></span>
    <span class="count next bottom"><%= next %></span>
    <span class="count curr bottom"><%= curr %></span>
    <span class="label"><%= label %></span>
    </div>
</script>
<!--counter Initiate-->
<script type="text/javascript">
    $(window).on('load', function () {
        var labels = ['days', 'hours', 'minutes', 'seconds'],
                nextYear = '2017/12/18',
                template = _.template($('#main-example-template').html()),
                currDate = '00:00:00:00:00',
                nextDate = '00:00:00:00:00',
                parser = /([0-9]{2})/gi,
                $example = $('#main-example');
        // Parse countdown string to an object
        function strfobj(str) {
            var parsed = str.match(parser),
                    obj = {};
            labels.forEach(function (label, i) {
                obj[label] = parsed[i]
            });
            return obj;
        }
        // Return the time components that diffs
        function diff(obj1, obj2) {
            var diff = [];
            labels.forEach(function (key) {
                if (obj1[key] !== obj2[key]) {
                    diff.push(key);
                }
            });
            return diff;
        }
        // Build the layout
        var initData = strfobj(currDate);
        labels.forEach(function (label, i) {
            $example.append(template({
                curr: initData[label],
                next: initData[label],
                label: label
            }));
        });
        // Starts the countdown
        $example.countdown(nextYear, function (event) {
            var newDate = event.strftime('%d:%H:%M:%S'),
                    data;
            if (newDate !== nextDate) {
                currDate = nextDate;
                nextDate = newDate;
                // Setup the data
                data = {
                    'curr': strfobj(currDate),
                    'next': strfobj(nextDate)
                };
                // Apply the new values to each node that changed
                diff(data.curr, data.next).forEach(function (label) {
                    var selector = '.%s'.replace(/%s/, label),
                            $node = $example.find(selector);
                    // Update the node
                    $node.removeClass('flip');
                    $node.find('.curr').text(data.curr[label]);
                    $node.find('.next').text(data.next[label]);
                    // Wait for a repaint to then flip
                    _.delay(function ($node) {
                        $node.addClass('flip');
                    }, 50, $node);
                });
            }
        });
    });
</script>
</body>
</html>
