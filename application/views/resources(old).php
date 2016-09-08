<?php
$links = array(
    'Cru Press Green' => array(
        'href' => 'http://www.crupressgreen.com',
        'desc' => 'Get resources for Bible studies, discipleship, new believers, and more.'
    ),
    'National Cru Resources' => array(
        'href' => 'http://www.cru.org/training-and-growth/index.htm',
        'desc' => 'Resources for training & growth from the main cru site.'
    ),
    'MeetTheProf' => array(
        'href' => 'http://meettheprof.com/university/california-polytechnic-state-university-san-luis-obispo/',
        'desc' => 'Find professors who are following Christ.'
    ),
    'Podcasts' => array(
        'href' => 'https://itunes.apple.com/us/podcast/slo-crusade/id337947386?mt=2',
        'desc' => 'Listen to recordings of past meetings.'
    ),
    'Livestream' => array(
        'href' => 'https://www.livestream.com/slocrusade',
        'desc' => 'Watch the weekly meeting live.'
    )
);

$pdf_path = '../assets/resources/pdf/';
$downloads = array(
    'Articles' => array(
        'Annotated Send Model' => $pdf_path . 'Annotated_Send_Model.pdf',
        'Biblical Career Principals' => $pdf_path . 'Biblical_Career_Principals_By_Navigator.pdf',
        'Discerning God\'s Will' => $pdf_path . 'Discerning_Gods_Will_by_Youth_Specialties.pdf',
        'Discipleship "How To"' => $pdf_path . 'Discipleship_Howto.pdf',
        'Keith Davy\'s Guidance Letter' => $pdf_path . 'Keith_Davy_Guidance_Letter.pdf',
        'Live Life on a Mission: The 5 Things' => $pdf_path . '5_Things_College.pdf',
        'Practical Steps to Guidance' => $pdf_path . 'Practical_Steps_to_Guidance.pdf'
    ),
    'Studies' => array(
        'Discerning God\'s Will' => $pdf_path . 'Discerning_Gods_Will_Bible_Study.pdf',
        'Prayer' => $pdf_path . 'Bible_Study_On_Prayer.pdf'
    )
);

$prayer = array(
    'Lectio Divina' => $pdf_path . 'Lectio_Divina.pdf',
    'Prayer of Examen' => $pdf_path . 'Prayer_of_Examen.pdf',
    '6 Vital Questions about Prayer' => 'http://www.cru.org/training-and-growth/devotional-life/7-steps-to-fasting/07-six-vital-questions-prayer.htm',
    'The Purpose of Prayer' => 'http://www.cru.org/training-and-growth/classics/10-basic-steps/4-prayer/index.htm'
);
$fasting = array(
    'Abiding Through Fasting' => $pdf_path . 'Abiding_Through_Fasting.pdf',
    'Prayer and Fasting' => $pdf_path . 'Prayer_and_Fasting.pdf',
    'Your Guide to Fasting and Prayer' => 'http://www.cru.org/training-and-growth/devotional-life/7-steps-to-fasting/01-personal-guide.htm',
    '7 Basic Steps to Fasting and Prayer' => 'http://www.cru.org/training-and-growth/devotional-life/personal-guide-to-fasting/01-message-from-bill-bright.htm',
    'What is the Purpose of Fasting?' => 'http://www.desiringgod.org/interviews/what-is-the-purpose-of-fasting',
    'Hunger for God' => 'http://www.desiringgod.org/seminars/hunger-for-god-session-3',
    'Book: Celebration of Discipline by Richard J Foster' => 'http://www.amazon.com/Celebration-Discipline-Path-Spiritual-Growth/dp/0060628391'
)
?>

<div class="container" style="box-shadow: 0px 1px 10px #888888;
     border-radius: 0px 0px 10px 10px;
     background-color: #fff;
     padding: 0 100px 80px 100px">

    <br/>
    <div class="col-md-12 text-center" style="font-size: 36pt; font-weight: 300; padding: 10px 25px">
        Resources
    </div>
    <br/>

    <img src="../assets/img/dropshadowup2.png" style="width:100%; height:25px;"/>
    <br/><br/><br/>    

    <div class="container" style="margin: 10px 0 10px 0">
        <div class="container col-md-6" style="border-right: 1px dashed #CCC; padding-bottom: 20px">
            <div class="text-center" style="font-size: 24pt; font-weight: 300;">
                Links
            </div>
            <br/>
            <ul class="list-unstyled" style="font-size: 16pt; font-weight: 300;">
                <?php
                foreach ($links as $name => $parts) {
                    echo '<div style="margin-bottom: 1em;">';
                    echo '<li><a href="' . $parts['href'] . '">' . $name . '</a></li>';
                    echo '<li style="padding: .1em 0 0 1em">';
                    echo $parts['desc'];
                    echo '</li></div>';
                }
                ?>
            </ul>
        </div>

        <div class="container col-md-6">
            <div class="text-center" style="font-size: 24pt; font-weight: 300;">
                Downloads
            </div>
            <br/>
            <ul class="list-unstyled" style="margin-left: 10%; font-size: 16pt; font-weight: 300;">
                <?php
                foreach ($downloads as $title => $files) {
                    echo '<div style="margin-bottom: 1em;">';
                    echo '<li>' . $title . '</li>';
                    foreach ($files as $name => $path) {
                        echo '<li style="margin: .2em 0 0 1em">';
                        echo '<a href="' . $path . '">' . $name . '</a>';
                        echo '</li>';
                    }
                    echo '</div>';
                }
                ?>
            </ul>
        </div>
    </div>
    <hr/>
    <div class="container" style="margin: 10px 0 10px 0">
        <div class="container col-md-6">
            <div class="text-center" style="font-size: 24pt; font-weight: 300;">
                Prayer
            </div>
            <br/>
            <ul class="list-unstyled" style="font-size: 16pt; font-weight: 300;">
                <?php
                foreach ($prayer as $title => $files) {
                    echo '<div style="margin-bottom: 1em;">';
                    echo '<li><a href="' . $files . '">' . $title . '</a></li>';
                    echo '</div>';
                }
                ?>
            </ul>
        </div>
        <div class="container col-md-6" style="border-left: 1px dashed #CCC; padding-bottom: 20px">
            <div class="text-center" style="font-size: 24pt; font-weight: 300;">
                Fasting
            </div>
            <br/>
            <ul class="list-unstyled" style="font-size: 16pt; font-weight: 300;">
                <?php
                foreach ($fasting as $title => $files) {
                    echo '<div style="margin-bottom: 1em;">';
                    echo '<li><a href="' . $files . '">' . $title . '</a></li>';
                    echo '</div>';
                }
                ?>
            </ul>
        </div>
    </div>
</div>
<?php $this->load->view('javascript'); ?>