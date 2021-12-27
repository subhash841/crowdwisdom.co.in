<!--<div class="container">
    <div class="row">
        <div class="col-6">
            <p style="font-family: 'PT Serif', serif;font-size: 20px;">CrowdWisdom is an innovative question based crowdsourcing platform. The Platform is designed to make decisions in your life easier by accessing the best experts in India and around the world </p>
        </div>
        <div class="col-6" style="padding: 10px;background-image: url('http://cw.localhost.com//images/aboutus/intro.png');background-repeat: no-repeat;background-position: right bottom; position: relative;">

        </div>
    </div>
</div>-->
<style>
    @import url('https://fonts.googleapis.com/css?family=PT+Serif:400i');
    @media(max-width: 600px)
    {
        .heading,.sub-heading,.how-it-works
        {
            text-align: center;
        }
        .intro-bg>img
        {
            transform: translate(0,10px);
        }


    }
    @media(max-width: 994px)
    {
        .intro
        {
            background-size: contain;
        }
    }
    @media(min-width: 995px)
    {
        .intro
        {
            background-size: 50%;
        }        
    }

    @media(min-width: 601px) and (max-width: 900px)
    {
        .intro-bg>img
        {
            transform: translate(0px,10px);
        }

    }
    @media(min-width: 901px) and (max-width: 1160px)
    {
        .intro-bg>img
        {
            transform: translate(0px,10px);
        }

    }
    @media(min-width: 1161px)
    {
        .intro-bg>img
        {
            transform: translate(0px,0px);
        }

    }


    @media (max-width: 490px)
    {
        .vision-img
        {
            width: 150px !important;
        }
        .vision-1
        {
            top: 120px !important;
            left: -110px !important;
        }
        .vision-2
        {
            top: -160px !important;
            left: 10px !important;
        }
        .vision-3
        {
            top: -420px !important;
            left: 120px !important;
        }
    }

    @media (max-width: 600px)
    {
        .vision-img
        {
            width: 150px !important;
        }
        .vision-1
        {
            top: 120px !important;
            left: -110px !important;
        }
        .vision-2
        {
            top: -140px !important;
            left: 10px !important;
        }
        .vision-3
        {
            top: -400px !important;
            left: 120px !important;
        }
    }

    @media (max-width: 850px)
    {
        .vision-img
        {
            width: 150px !important;
        }
        .vision-1
        {
            top: 0px !important;
            left: 50px !important;
        }
        .vision-2
        {
            top: -50px !important;
            left: 10px !important;
        }
        .vision-3
        {
            top: -100px !important;
            left: -50px !important;
        }

        .vision-h5
        {
            font-size: 11px !important;
        }
        .vision-p
        {
            width: inherit;
            font-size:6px !important;
        }
    }


    .intro-bg>.row
    {
        margin-bottom: 30px;
    }
    .intro-bg>.row:first-child
    {
        margin-top: 10px;
    }


    .heading
    {
        font-size: 18px !important;
        font-weight: 500 !important;
        margin-top: 20px;
        font-size:18px;
        font-weight: 600;
    }
    .sub-heading{
        font-size: 16px;
        color: rgba(49, 50, 55, 0.34) !important;

    }
    .parent-height
    {
        height: inherit;
        margin: 0 auto;
        display: block;
    }
    .float-left
    {
        float: left!important;
    }
    .float-right
    {
        float: right !important;
    }
    .pad-top-15
    {
        padding-top: 25px;
    }
    .text-center
    {
        text-align: center;
    }
    .mt-13
    {
        margin-top: 13px;
    }
    .fsize-16       
    {
        font-size: 16px;
    }
    .vision-text
    {
        padding: 5px 25px;
        font-size: 17px;
    }
    .abtpage ul:not(.browser-default)>li {
        list-style-type: disc !important;
    }
    .bluish-grey-text
    {
        color:#8293b7;
    }

    .white-grey
    {
        background-color: #eff2f8;
    }
    .dark-blue-text
    {
        color:#00a2ff !important;
    }
    .fw-600
    {
        font-weight: 600;
    }
    .fsize-1_1
    {
        font-size: 1.2rem;
    }
    #survey
    {
        transform: translate(40px,-120px);
    }
    #prediction
    {
        transform: translate(180px,-180px);
    }
    #advice
    {
        transform: translate(350px,-120px);
    }
    #voice
    {
        transform: translate(180px,-40px);
    }
    .vision-img
    {
        width: 200px;
    }
    .vision-1
    {
        position: relative;top:-50px;left:0;
    }
    .vision-2
    {
        line-height: 15px;position: relative;top:-90px;left:0
    }

    .vision-3
    {
        position: relative;top:-110px;left:-50px;
    }
    .vision-h5
    {
        font-size: 15px;
    }
    .vision-p
    {
        font-size:11px;
    }
    .b15white{
        border:15px solid white;
    }
    .catonimg{
        font-size: 1.1rem;
    }
    .cardheader{
        margin: 18px 0;
        font-size: 2.59rem;
    }
    @media only screen and (max-width: 480px){
        .cardheader {
            font-size: 1.6rem;
            text-align: center;
        }
    }
    @media only screen and (max-width: 767px) {
        .catonimg{
            font-size: 1rem;
        }
        .vision-img{
            width:175px !important;
        }
        .vision-p{
            font-size: 8px !important;
        }
    }
</style>
<div class="content container" id='abtpage'>
    <div class="row z-depth-4 mb-5 px-0" style="margin-top: 5%;">
        <div class="col-12 bg-white" style="padding-right: 0px;padding-left: 0px;">
            <div class="card-panel intro " style="padding: 10px;background-image: url('<?php echo base_url() ?>/images/aboutus/intro.png');background-repeat: no-repeat;background-position: right bottom; position: relative;">
                <div class="row" style="font-size: 16px;">
                    <div class="col-md-12" style=";position: relative;margin-top: 20px;margin-bottom: 60px">
                        <p><strong>Privacy Policy</strong></p>
                        <p>We value the trust you place in us. That's why we insist upon the highest standards for secure transactions and customer information privacy. Please read the following statement to learn about our information gathering and dissemination practices.</p>
                        <p>
                            Note:<br />
                            Our privacy policy is subject to change at any time without notice. To make sure you are aware of any changes, please review this policy periodically.<br /><br />
                            By visiting this Website/App you agree to be bound by the terms and conditions of this Privacy Policy. If you do not agree please do not use or access our Website/App..<br /><br />
                            By mere use of the Website/App, you expressly consent to our use and disclosure of your personal information in accordance with this Privacy Policy. This Privacy Policy is incorporated into and subject to the Terms of Use.<br /><br />
                        </p>
                        <ol>
                            <li><strong>Collection of Personally Identifiable Information and other Information</strong></li>
                        </ol>
                        <p>When you use our Website/App, we collect and store your personal information which is provided by you from time to time. Our primary goal in doing so is to provide you a safe, efficient, smooth and customized experience. This allows us to provide services and features that most likely meet your needs, and to customize our Website/App to make your experience safer and easier. More importantly, while doing so we collect personal information from you that we consider necessary for achieving this purpose.</p>
                        <p>In general, you can browse the Website/App without telling us who you are or revealing any personal information about yourself. Once you give us your personal information, you are not anonymous to us. Where possible, we indicate which fields are required and which fields are optional. You always have the option to not provide information by choosing not to use a particular service or feature on the Website/App. We may automatically track certain information about you based upon your behaviour on our Website/App. We use this information to do internal research on our users' demographics, interests, and behaviour to better understand, protect and serve our users. This information is compiled and analysed on an aggregated basis. This information may include the URL that you just came from (whether this URL is on our Website/App or not), which URL you next go to (whether this URL is on our Website/App or not), your computer browser information, and your IP address.</p>
                        <p>We use data collection devices such as "cookies" on certain pages of the Website/App to help analyse our web page flow, measure promotional effectiveness, and promote trust and safety. "Cookies" are small files placed on your hard drive that assist us in providing our services. We offer certain features that are only available through the use of a "cookie".</p>
                        <p>We also use cookies to allow you to enter your password less frequently during a session. Cookies can also help us provide information that is targeted to your interests. Most cookies are "session cookies," meaning that they are automatically deleted from your hard drive at the end of a session. You are always free to decline our cookies if your browser permits, although in that case you may not be able to use certain features on the Website/App and you may be required to re-enter your password more frequently during a session.</p>
                        <p>Additionally, you may encounter "cookies" or other similar devices on certain pages of the Website/App that are placed by third parties. We do not control the use of cookies by third parties.</p>
                        <p>If you choose to buy on the Website/App, we collect information about your buying behaviour.</p>
                        <p>If you transact with us, we collect some additional information, such as a billing address, a credit / debit card number and a credit / debit card expiration date and/ or other payment instrument details and tracking information from cheques or money orders.</p>
                        <p>If you choose to post messages on our message boards, chat rooms or other message areas or leave feedback, we will collect that information you provide to us. We retain this information as necessary to resolve disputes, provide customer support and troubleshoot problems as permitted by law.</p>
                        <p>If you send us personal correspondence, such as emails or letters, or if other users or third parties send us correspondence about your activities or postings on the Website/App, we may collect such information into a file specific to you.</p>
                        <p>We collect personally identifiable information (email address, name, phone number, credit card / debit card / other payment instrument details, etc.) from you when you set up a free account with us. While you can browse some sections of our Website/App without being a registered member, certain activities (such as placing an order) do require registration. We do use your contact information to send you offers based on your previous orders and your interests.</p>
                        <ol>
                            <li><strong>Use of Demographic / Profile Data / Your Information</strong></li>
                        </ol>
                        <p>We use personal information to provide the services you request. To the extent we use your personal information to market to you, we will provide you the ability to opt-out of such uses. We use your personal information to resolve disputes; troubleshoot problems; help promote a safe service; collect money; measure consumer interest in our products and services, inform you about online and offline offers, products, services, and updates; customize your experience; detect and protect us against error, fraud and other criminal activity; enforce our terms and conditions; and as otherwise described to you at the time of collection.</p>
                        <p>In our efforts to continually improve our product and service offerings, we collect and analyse demographic and profile data about our users' activity on our Website/App.</p>
                        <p>We identify and use your IP address to help diagnose problems with our server, and to administer our Website/App. Your IP address is also used to help identify you and to gather broad demographic information.</p>
                        <p><strong>Cookies</strong></p>
                        <p>A "cookie" is a small piece of information stored by a web server on a web browser so it can be later read back from that browser. Cookies are useful for enabling the browser to remember information specific to a given user. We place both permanent and temporary cookies in your computer's hard drive. The cookies do not contain any of your personally identifiable information.</p>
                        <ol>
                            <li><strong>Sharing of personal information</strong></li>
                        </ol>
                        <p>We do not share personal information with our other corporate entities and affiliates, only our technology partner would have access to some confidential information on account of them running our technology platform.</p>
                        <p>We may disclose personal information if required to do so by law or in the good faith belief that such disclosure is reasonably necessary to respond to subpoenas, court orders, or other legal process. We may disclose personal information to law enforcement offices, third party rights owners, or others in the good faith belief that such disclosure is reasonably necessary to: enforce our Terms or Privacy Policy; respond to claims that an advertisement, posting or other content violates the rights of a third party; or protect the rights, property or personal safety of our users or the general public.</p>
                        <p>We and our affiliates will share / sell some or all of your personal information with another business entity should we (or our assets) plan to merge with, or be acquired by that business entity, or re-organization, amalgamation, restructuring of business. Should such a transaction occur that other business entity (or the new combined entity) will be required to follow this privacy policy with respect to your personal information.</p>
                        <ol>
                            <li><strong>Links to Other Sites</strong></li>
                        </ol>
                        <p>Our Website/App links to other Website/Apps that may collect personally identifiable information about you. Crowdwisdom is not responsible for the privacy practices or the content of those linked Website/Apps.</p>
                        <ol>
                            <li><strong>Security Precautions</strong></li>
                        </ol>
                        <p>Our Website/App has stringent security measures in place to protect the loss, misuse, and alteration of the information under our control. Whenever you change or access your account information, we offer the use of a secure server. Once your information is in our possession we adhere to strict security guidelines, protecting it against unauthorized access.</p>
                        <ol>
                            <li><strong>Advertisements on Crowdwisdom</strong></li>
                        </ol>
                        <p>We use third-party advertising companies to serve ads when you visit our Website/App. These companies may use information (not including your name, address, email address, or telephone number) about your visits to this and other Website/Apps in order to provide advertisements about goods and services of interest to you.</p>
                        <ol>
                            <li><strong>Your Consent</strong></li>
                        </ol>
                        <p>By using the Website/App and/ or by providing your information, you consent to the collection and use of the information you disclose on the Website/App in accordance with this Privacy Policy, including but not limited to Your consent for sharing your information as per this privacy policy.</p>
                        <p>If we decide to change our privacy policy, we will post those changes on this page so that you are always aware of what information we collect, how we use it, and under what circumstances we disclose it.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>