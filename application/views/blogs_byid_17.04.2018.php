<style>
    h5,h6{
        letter-spacing: 1px;
    }
    .load_feeds{
        padding: 0;
        width: 40px;
        height: 40px;
        margin: 0 12px;
    }
    .page{
        background-color: white !important;
        color: #232b3c;
    }
    .page.current{
        background-color: #232b3c !important;
        color: white !important;
    }
    .pagination-container{
        padding:5% 0;
        padding-bottom: 10%;
    }
    .bottomborder{
        border-bottom:  1px solid #e0e7ea;
    }
    .blogsubject{
        font-size: 15px;
        text-transform: uppercase;
        color:#c3cad8;
        font-weight: 600;
    }
    .blogtitle{
        margin: 25px 0;
        font-size: 28px;
        font-weight: 600;
    }
    .blogdate{
        font-size: 15px;
        color:#c3cad8;
        font-weight: 500;
        margin: 15px 0;
    }
    .bloglinks{
        font-size: 18px;
        color:#c3cad8;
        font-weight: 500;
    }
    .bloglinks a{
        color: #45bce7;
    }
    .blogtext{
        font-size: 19px;

    }
    .blogimg{
        width:100%;
        height:440px;
    }
    .blogtext img{
        max-width: 500px;
    }


</style>

<style>
    .mtb3{

    }
    blockquote {

        font-style: italic;
        margin: 0.25em 0;
        padding: 0.35em 40px;
        line-height: 1.45;
        position: relative;
        color: #383838;
        border-left: none;
    }

    blockquote:before {
        font-family: poppins,sans-serif;
        display: block;
        padding-left: 10px;
        content: open-quote;
        font-size: 180px;
        position: absolute;
        left: -20px;
        top: -20px;
        color: #eff2f8;
    }
    blockquote:after {
        font-family: poppins,sans-serif;
        display: block;
        padding-left: 10px;
        content:close-quote;
        font-size: 180px;
        position: absolute;
        right: 50px;
        bottom: -20%;
        color: #eff2f8;
    }
    blockquote cite {
        color: #999999;
        font-size: 14px;
        display: block;
        margin-top: 5px;
    }

    blockquote cite:before {
        content: "\2014 \2009";
    }
    .blogtext ul li {
        list-style-type: disc;
        font-size:20px;
    }
    ul:not(.browser-default){
        padding-left: 25px;
    }
    blockquote div{
        margin: 8% 4%;
    }
    .blogcover{
        box-shadow: 0px 5px 25px #c3cad8;
        width:100%;
        height:100vh;
    }
    .link {
        position: fixed;
        top: 30vh;
        left: 0;
        z-index: 9999;
        /* background: #27334b; */
        background: #e70000;
        font-size: 12px;
    }
    .link a {
        color:#FFF;
        text-decoration: none;
    }
    .link:hover {
        background: #e70000;
    }
</style>
<!--<div class="banner1" style="min-height:90vh;">
    <img src="<?= base_url('images/blogs/coverblog.jpg'); ?>" class="blogcover">
</div>-->
<div class="white bottomborder">
    <div class="content container" >
        <?php if(!empty($blog_list)) {?>
        <?php
        if ($blog_list['subcategory_name'] == "Karnataka") {
            $linkurl = base_url() . "Karnataka/Home";
        } else if ($blog_list['subcategory_name'] == "Gujrat") {
            $linkurl = base_url() . "Gujrat/Home";
        } else {
            $linkurl = "#";
        }
        ?>
        <div class="btn btn-primary link"><a href="<?php echo $linkurl;?>">Prediction <?php echo $blog_list['subcategory_name'] ?></a></div>
        <div class="row" style="padding: 20px 0;">
            <h5 class="blogsubject" style=""><?php echo $blog_list['category_name'] ?></h5> 
            <h4 class="blogtitle" style=""><?php echo $blog_list['title'] ?></h4>

            <div class="bloglinks" style=""><!--By <a>Subhash Chabra</a> & <a>Amitabh Tiwari</a>--></div>
            <?php if($blog_list['image']!="default_blog.png") {?>
            <div style="text-align: center;"><img style="max-width: 100%;width:550px;" src="<?php echo base_url(); ?>images/blogs/<?php echo $blog_list['image'];?>" alt="Crowd Prediction"></div>
            <?php } ?>
            <div class="blogtext">
                <h5 class="blogdate" style=""><?php echo date('j-M-Y', strtotime($blog_list['blog_date'])); ?></h5>
                <?php $description= str_replace("&#34;", '\'', $blog_list['description']);?>
                <?php $description= str_replace("&nbsp;"," ", $blog_list['description']);?>
                <?=  $description ;?>
            </div>
        </div>
        <?php } else {?>
        <div class="row" style="padding: 20px 0;">
            <h4>No data found</h4>
        </div>
        
        <?php } ?>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.banner').css('display', 'none');
        $('#aboutus').css('display', 'none');
    })
</script>