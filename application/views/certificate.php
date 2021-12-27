<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <meta property="og:title" content="Finergized certified" />
        <meta property="og:url"content="http://test.sundaymobility.com/finergize/certificate/share/<?php echo $user['customer_id'] ?>" />
        <meta property="og:description" content="CONGRATULATIONS! YOU ARE CERTIFIED AS A POLITICAL ORACLE BY CROWDWISDOM" />
        <meta property="og:image" content="<?php echo $user['certificate_path'] ?>" />
        <meta property="og:image:width" content="600" />
        <meta property="og:image:height" content="593" />
        <style>
            body{
                margin: 0;
                background: #ddd;
                height: 100vh;
                text-align: center;
            }
            body .center{
                position: relative;
                top:50%; 
                transform: translateY(-50%);
            }
            body .center b{
                font-size: 26px;
            }
        </style>
    </head>
    <body>
        <?php
        ?>
        <div class="center">
            <b>Congratulations!!! your plan has been activated.</b><br/> 
            You will be redirected to the home page in 5 seconds...
        </div>
        <script>
        setTimeout(function (){
            window.location.href = "<?php echo base_url(); ?>";
        },5000);    
        </script>
    </body>
</html>
