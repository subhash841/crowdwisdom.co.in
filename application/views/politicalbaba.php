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

    .table-font-bold{
        font-weight: bold;
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
        top: 26vh;
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
        <div class="btn btn-primary link"><a href="<?= base_url() ?>Karnataka/Home">Prediction Karnataka</a></div>
        <div class="row" style="padding: 20px 0;">
            <h5 class="blogsubject" style="">Politics</h5> 
            <h4 class="blogtitle" style="">What Matters in Karnataka? A blog by PoliticalBaba</h4>
            <div class="bloglinks" style=""><!--By <a>Subhash Chabra</a> & <a>Amitabh Tiwari</a>--></div>
            <div class="blogtext">
                <div style="text-align: center;"><img style="max-width: 100%;" src="<?= base_url('images/blogs/Picture51.png'); ?>" alt="Crowd Prediction"></div>
                <h5 class="blogdate" style="">11 March 2018</h5>
                <p style="text-align: center;" class="table-font-bold">Key Things to Know About Karnataka Elections</p>
                <ul>
                    <li>The population of the state is 6.1 crores, 61.33% rural and 38.67% urban.</li>
                    <li>Karnataka has 224 seats. 51 seats are reserved – 36 for SC and 15 for ST.</li>
                    <li>State is divided into six regions – Old Mysuru, Bengaluru city, Hyderabad Karnataka, Bombay Karnataka, Karavali and Central Karnataka.</li>
                    <li>Old Mysuru has the highest number of seats followed by Bombay Karnataka and Hyderabad Karnataka.</li>
                    <table class="table table-striped">
                        <thead>
                            <tr class="table-font-bold">
                                <td style="width: 25%;">Region</td>
                                <td>Districts</td>
                                <td>No. of Seats</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Old Mysuru</td>
                                <td>Hassan, Mandya, Mysore, Tumkur, Kolar, Chamranjnagar</td>
                                <td>64</td>
                            </tr>
                            <tr>
                                <td>Bengaluru City</td>
                                <td>Bangalore, Bangalore Rural</td>
                                <td>28</td>
                            </tr>
                            <tr>
                                <td>Hyderabad Karnataka</td>
                                <td>Gulbarga, Bidar, Bellary, Raichur, Koppal</td>
                                <td>40</td>
                            </tr>
                            <tr>
                                <td>Bombay Karnataka</td>
                                <td>Bijapur, Bagalkot, Belgaum, Dharwad, Gadag, Uttar Kannad, Haveri</td>
                                <td>50</td>
                            </tr>
                            <tr>
                                <td>Karavali (Coastal & Hills)</td>
                                <td>Udupi, Dakshin Kannad, Kodagu (Mangalore)</td>
                                <td>19</td>
                            </tr>
                            <tr>
                                <td>Central Karnataka</td>
                                <td>Devangere, Shimoga, Chikmangalur, Chitradurga</td>
                                <td>23</td>
                            </tr>
                            <tr class="table-font-bold">
                                <td>Total</td>
                                <td></td>
                                <td>224</td>
                            </tr>
                        </tbody>
                    </table>
                    <li>In 2013, Congress and BJP got highest number of seats from Bombay Karnataka while JDS from Old Mysuru region.</li>
                    <li>Old Mysuru witnessed a tough fight between Congress and JDS as both Siddaramaiah and Deve Gowda belong to this region.</li>
                    <li>Bengaluru City witnessed a tough contest between Congress and BJP. BJP normally does better in urban areas across India.</li>
                    <table class="table table-striped">
                        <thead>
                            <tr class="table-font-bold">
                                <td style="width:35%;">Region</td>
                                <td>Seats</td>
                                <td>INC</td>
                                <td>BJP</td>
                                <td>JDS</td>
                                <td>OTH</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Old Mysuru</td>
                                <td>64</td>
                                <td>30</td>
                                <td>4</td>
                                <td>25</td>
                                <td>5</td>
                            </tr>
                            <tr>
                                <td>Bengaluru City</td>
                                <td>28</td>
                                <td>13</td>
                                <td>12</td>
                                <td>3</td>
                                <td>0</td>
                            </tr>
                            <tr>
                                <td>Hyderabad Karnataka</td>
                                <td>40</td>
                                <td>23</td>
                                <td>5</td>
                                <td>5</td>
                                <td>7</td>
                            </tr>
                            <tr>
                                <td>Bombay Karnataka</td>
                                <td>50</td>
                                <td>31</td>
                                <td>13</td>
                                <td>1</td>
                                <td>5</td>
                            </tr>
                            <tr>
                                <td>Karavali (Coastal & Hills)</td>
                                <td>19</td>
                                <td>13</td>
                                <td>3</td>
                                <td>0</td>
                                <td>3</td>
                            </tr>
                            <tr>
                                <td>Central Karnataka</td>
                                <td>23</td>
                                <td>12</td>
                                <td>3</td>
                                <td>6</td>
                                <td>2</td>
                            </tr>
                        </tbody>
                    </table>
                </ul>

                <p style="text-align: center;" class="table-font-bold">History of State Elections in Karnataka</p>
                <ul>
                    <li>The state has been a fiefdom of Congress party since its inception in 1957.</li>
                    <li>Even in 1978, after Janata Party assault nationally, Karnataka was one of the few states which Congress managed to retain.</li>
                    <li>In 1983, the first non-Congress government was installed in the state, under the leadership of Janata Party’s Ramkrishna Hegde.</li>
                    <li>He was the last Chief Minister to have returned to power in the state.</li>
                    <i class="table-font-bold">Seat Share of Parties since 1985</i>
                    <table class="table table-striped">
                        <thead>
                            <tr class="table-font-bold">
                                <td style="width: 25%;">Party</td>
                                <td>1985</td>
                                <td>1989</td>
                                <td>1994</td>
                                <td>1999</td>
                                <td>2004</td>
                                <td>2008</td>
                                <td>2013</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>INC</td>
                                <td>65</td>
                                <td>178</td>
                                <td>34</td>
                                <td>132</td>
                                <td>65</td>
                                <td>80</td>
                                <td>122</td>
                            </tr>
                            <tr>
                                <td>Janata Party / Janata Dal / JDS</td>
                                <td>139</td>
                                <td>24</td>
                                <td>115</td>
                                <td>10</td>
                                <td>58</td>
                                <td>28</td>
                                <td>40</td>
                            </tr>
                            <tr>
                                <td>BJP+</td>
                                <td>2</td>
                                <td>4</td>
                                <td>40</td>
                                <td>62</td>
                                <td>84</td>
                                <td>110</td>
                                <td>40</td>
                            </tr>
                            <tr>
                                <td>KCP</td>
                                <td></td>
                                <td></td>
                                <td>10</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>KJP</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>6</td>
                            </tr>
                            <tr>
                                <td>BSRCP</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>4</td>
                            </tr>
                            <tr>
                                <td  class="table-font-bold">IND</td>
                                <td>13</td>
                                <td>12</td>
                                <td>18</td>
                                <td>19</td>
                                <td>13</td>
                                <td>6</td>
                                <td>9</td>
                            </tr>
                            <tr>
                                <td  class="table-font-bold">OTHERS</td>
                                <td>5</td>
                                <td>6</td>
                                <td>7</td>
                                <td>1</td>
                                <td>4</td>
                                <td>0</td>
                                <td>3</td>
                            </tr>
                            <tr class="table-font-bold">
                                <td>TOTAL</td>
                                <td>224</td>
                                <td>224</td>
                                <td>224</td>
                                <td>224</td>
                                <td>224</td>
                                <td>224</td>
                                <td>224</td>
                            </tr>
                        </tbody>
                    </table>

                    <p>Source: Election Commission of India</p>
                    <li>In last 3 elections INC has recorded an avg. vote share of 36%, BJP: 32% & JD(S) 20%.</li>
                    <li>Congress vote share shows a cyclical pattern, it fell from 43.6% in 1985 to 34.3% in 1994. Then it increased to 40.8% in 1999 before falling to 34.8% in 2008 when BJP won. It has been on increasing trend since then.</li>
                    <li>JDS vote share plunged to 10.4% in 1999 from a high of 43.8% in 1989. This is also due to split of the various Janata Dal constituents. A section of JD named JDU became a part of BJP led NDA.</li>
                    <li>JDS vote share has stabilized since then and has been in the range of 19%-21%.</li>
                    <li>BJP’s vote share plunged to sub 20% levels in 2013 when Yeddyurappa and Reddy brothers contested independently bagging 9.8% and 2.7% vote share. Both have since then returned. BJP’s vote share has been in the range of 30%-34%.</li>
                    <li><i>Vote share of Parties since 1985</i></li>
                    <div style="text-align: center;"><img style="max-width: 100%;" src="<?= base_url('images/blogs/Picture52.png'); ?>" alt="Crowd Prediction"></div>
                    <li>Source: <a href="http://www.indiavotes.com" target="_blank">www.indiavotes.com</a>, <a href="http://www.politicalbaba.com" target="_blank">http://www.politicalbaba.com</a></li>
                </ul>
                <p>Notes:</p>
                <ul>
                    <li>Vote shares have been adjusted to arrive at the true strength of the three parties.</li>
                    <li>JDS was formed in 1999. 1985 vote share is of Janata Party, and 1994 of Janata Dal respectively.</li>
                    <li>BJP vote share includes Janata Dal United vote share in 1999 and 2004. 2013 vote share of BJP includes vote share of Karnataka Janata Party formed by Yeddyurappa and BSRCP formed by Reddy brothers, as both have merged with BJP.</li>
                    <li>1994 Congress vote share includes Karnataka Congress Party votes as well.</li>
                </ul>

                <p style="text-align: center;" class="table-font-bold">Caste plays an important role in Karnataka politics</p>
                <ul>
                    <li>Caste plays an important factor in Karnataka as in most parts of the country.</li>
                    <li>Lingayats and Vokkaligas accounting for 29% of the population are the most dominant & influential groups of the state.</li>
                    <li>The SC/ST account for 24% of the total population, the Kurubas comprise 8% and Muslims comprise 13%.</li>
                    <li>Karnataka has till date had five chief ministers from the Vokkaliga community, and seven have been Lingayats.</li>
                </ul>
                <div style="text-align: center;"><img style="max-width: 100%;" src="<?= base_url('images/blogs/Picture53.png'); ?>" alt="Crowd Prediction"></div>
                <p>Source: <a href="http://www.Politicalbaba.com" target="_blank">www.Politicalbaba.com</a></p>
                <ul>
                    <li>There were four CMs from the backward classes while Brahmins managed to hold the top spot in Karnataka twice.</li>
                    <li>Though Lingayats and Vokkaligas belong to OBC group, they are like the forward caste of OBCs (something like Kurmis of Bihar).</li>
                    <li>The present Assembly has 103 MLAs (almost half of total strength) from the two communities, 53 Vokkaligas and 50 Lingayats which is almost 2x of their population size.</li>
                    <li>Acronyms like LIBRA and AHINDA are commonly used terms in Karnataka politics.</li>
                    <li>LIBRA which is Lingayat plus Brahmins are anchor voting segments of BJP (18%).</li>
                    <li>AHINDA which is Alpasankhyataru, Hindulidavaru Mattu Dalitaru (Dalits, Backward Classes & Muslims) have traditionally supported the Congress (56% of population).</li>
                    <li>With Siddaramaiah’s entry in Congress, AHINDA backed the party in 2013 resulting in resounding victory.</li>
                    <li>The Vokkaligas (12%) have backed Deve Gowda’s JD(S).</li>
                    <li>While BJP CM candidate Yeddyurappa is a Lingayat, Deve Gowda and S.M. Krishna are Vokkaligas.</li>
                    <li>CM Siddaramaiah is a Kuruba. All belong to the OBC community.</li>
                    <li>Lingayats dominate in North Karnataka, Hyderabad Karnataka and Old Mumbai region.</li>
                    <li>Vokkaligas are the dominant peasant caste of Old Mysuru.</li>
                    <li>The Lingayats and Upper caste have traditionally voted for the BJP, OBCs, Dalits, Adivasis and Muslims for Congress and Vokkaligas for the JDS.</li>
                </ul>
                <div style="text-align: center;"><img style="max-width: 100%;" src="<?= base_url('images/blogs/Picture54.png'); ?>" alt="Crowd Prediction"></div>
                <p style="text-align: center;" class="table-font-bold">Karnataka exhibits a strong trend of throwing out incumbent governments</p>
                <ul>
                    <li>Since 1985, the state has never re-elected the incumbent party.</li>
                </ul>
                <table class="table table-striped">
                    <thead>
                        <tr class="table-font-bold">
                            <td style="width: 25%;">Year</td>
                            <td>1985</td>
                            <td>1989</td>
                            <td>1994</td>
                            <td>1999</td>
                            <td style="width: 15%">2004</td>
                            <td>2008</td>
                            <td>2013</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Chief Minister</td>
                            <td>Janata Party</td>
                            <td>INC</td>
                            <td>Janata Dal (Secular)</td>
                            <td>INC</td>
                            <td>Hung<br /><br />a. INC (1yr 245 days)<br /><br />b. JD(S) (1yr 253 days)<br /><br />c. BJP (7 days)</td>
                            <td>BJP</td>
                            <td>INC</td>
                        </tr>
                    </tbody>
                </table>
                <p>(Source: <a href="http://www.wikipedia.com" target="_blank">http://www.wikipedia.com</a>)</p>
                <ul>
                    <li>Power changes hands at the end of every five years in Karnataka.</li>
                    <li>No chief minister has returned to power in Karnataka since Ramakrishna Hegde in 1985.</li>
                    <li>From 1985 to 1999 the power oscillated between Janata Dal constituents and Congress party.</li>
                    <li>The trend was broken in 2004 when people gave a hung verdict. Congress managed to retain Chief Minister’s chair with support of JD(S).</li>
                    <li>2004-2008 was a period of instability and the state witnessed 3 Chief Ministerial tenures, one from each party.</li>
                    <li>In 2008, BJP won the state largely on the sympathy wave created due to JDS decision of not honuoring its commitment to coalition and pulling down Yeddyurappa as CM within a week.</li>
                    <li>The Lingayats and upper caste solidly backed BJP (33.86%) which emerged victorious despite getting lesser votes than Congress (34.76%).</li>
                    <li>The state returned to its trend of throwing out incumbent party in 2013 when Congress made a comeback due to split within BJP as Yeddyurappa and Reddy brothers contested independently.</li>
                    <li>Will this trend continue in 2018? If it continues, who will be the beneficiary – BJP or JD(S)?</li>
                    <li>Or will there be a hung assembly situation like in 2004?</li>
                </ul>
                
                <h5 class="blogdate" style="">12 March 2018</h5>
                <p style="text-align: center;" class="table-font-bold">Karnataka Elections will set the tone for state elections in 2018 & Lok Sabha elections in 2019</p>
                <ul>
                    <li>The election season for big states in 2018 starts with a fascinating triangular contest in Karnataka.</li>
                    <li>These elections are crucial for all key players – BJP, Congress and Janata Dal (Secular).</li>
                    <li>For Congress, because this is the only big state, sending more than 15 MPs to Parliament, where the party is in power. A loss here would hasten the process of a ‘Congress-mukt-Bharat.</li>
                    <li>The elections is crucial for BJP as Karnataka was the first state in South India where the party stormed to power in 2008.</li>
                    
                    <li>In many ways this acts as party’s gateway to southern part of India. Former Prime Minister Deve Gowda’s regional party JDS is the third player, which is going full throttle to scuttle the plans of both the national parties and emerge as the kingmaker in a hung assembly.</li>
                    <li>These elections will set the tone for elections to three states – Madhya Pradesh (MP), Rajasthan and Chhattisgarh (CG) – slated to be held at the end of the year and the Lok Sabha elections to be held in Q1-Q2 2019.</li>
                    <li>The 3 states are all ruled by BJP. Rajasthan has a history of throwing out incumbent governments every five years, recent by-poll results indicate the public mood.</li>
                    <li>In both MP and CG, BJP has been in power for c.15 years, a long enough period, to develop natural anti-incumbency. The popularity of the two leaders Shivraj Singh Chouhan and Raman Singh provides a cushion against this anti-incumbency.</li>
                    <li>If Congress is able to retain Karnataka then it would provide a fillip to its claim in the three states and central elections of next year.</li>
                    <li>If BJP manages to win / form government in Karnataka, it will provide it with significant momentum to neutralize the anti-incumbency in the three states of MP, Raj and CG.</li>
                    <li>It will also strengthen its claim to win maximum seats in Parliament in 2019 and neutralize some of the negative news about agri-distress, unemployment, NPAs,  Nirav Modi scam etc.</li>
                    <li>So, this election is very important and has larger implications.....</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.banner').css('display', 'none');
        $('#aboutus').css('display', 'none');
    })
</script>