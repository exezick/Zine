<?php
//error_reporting(0);

$movies     = "";
$anime      = "";
$cartoons   = "";
$others     = "";
$trAactive  = "";
$trid       = "";

$countAni   = 1;
$countMov   = 1;
$countCart  = 1;
$countOth   = 1;

$activenav1 = "false";
$activevid1 = "";
$active1    = "";

$activenav2 = "false";
$activevid2 = "";
$active2    = "";

$activenav3 = "false";
$activevid3 = "";
$active3    = "";

$activenav4 = "false";
$activevid4 = "";
$active4    = "";

if($video_category == 1)
{
     $activenav1 = "true";
     $activevid1 = "show active";
     $active1 = "active";
}
else if($video_category == 2)
{
     $activenav2 = "true";
     $activevid2 = "show active";
     $active2 = "active";
}
else if($video_category == 3)
{
     $activenav3 = "true";
     $activevid3 = "show active";
     $active3 = "active";
}
else if($video_category == 4)
{
     $activenav4 = "true";
     $activevid4 = "show active";
     $active4 = "active";
}

foreach ($video_default as $videos){
    $trid =  $videos['vid_id'];
}


foreach ($video_list as $video)
{
    if($trid == $video['vid_id'])
    {
        $trAactive = "bg-danger txt-white";
    }
    else
    {
        $trAactive = "";
    }

    if($video['cat_id'] == 1)
    {
        $movies .= '
            <tr class="'. $trAactive.'">
                <td class="shrink"><i class="fa fa-film"></i></td>
                <td class="shrink">'.$countMov++.'.</td>
                <td><a href="'.site_url('videos/'.$video['vid_id']).'">'.ucfirst($video['title']).'</a></td>
            </tr>';
    }
    else if($video['cat_id'] == 2)
    {
        $anime .= '
            <tr class="'. $trAactive.'">
                <td class="shrink"><i class="fa fa-film"></i></td>
                <td class="shrink">'.$countAni++.'.</td>
                <td><a href="'.site_url('videos/'.$video['vid_id']).'">'.ucfirst($video['title']).'</a></td>
            </tr>';
    }
    else if($video['cat_id'] == 3)
    {
        $cartoons .= '
            <tr class="'. $trAactive.'">
                <td class="shrink"><i class="fa fa-film"></i></td>
                <td class="shrink">'.$countCart++.'.</td>
                <td><a href="'.site_url('videos/'.$video['vid_id']).'">'.ucfirst($video['title']).'</a></td>
            </tr>';
    }
    else if($video['cat_id'] == 4)
    {
        $others .= '
            <tr class="'. $trAactive.'">
                <td class="shrink"><i class="fa fa-film"></i></td>
                <td class="shrink">'.$countOth++.'.</td>
                <td><a href="'.site_url('videos/'.$video['vid_id']).'">'.ucfirst($video['title']).'</a></td>
            </tr>';
    }

}//end of loop
    
?>

<div class="card-body content-dark">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link <?=$active1?>" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="<?=$activenav1?>">
                Movies
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?=$active2?>" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="<?=$activenav2?>">
                Animes
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?=$active3?>" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="<?=$activenav3?>">
                Cartoons
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?=$active4?>" id="others-tab" data-toggle="tab" href="#others" role="tab" aria-controls="others" aria-selected="<?=$activenav4?>">
                Others
            </a>
        </li>
    </ul>
    <div class="tab-content tbl-width overflow-auto" id="myTabContent">
            <div class="tab-pane fade <?=$activevid1?>" id="home" role="tabpanel" aria-labelledby="home-tab">
                <table class="table table-striped table-dark table-hover ">
                    <tbody>
                        <?=$movies?>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade <?=$activevid2?>" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <table class="table table-striped table-dark table-hover ">
                    <tbody>
                        <?=$anime?>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade <?=$activevid3?>" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <table class="table table-striped table-dark table-hover ">
                    <tbody>
                        <?=$cartoons?>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade <?=$activevid4?>" id="others" role="tabpanel" aria-labelledby="others-tab">
                <table class="table table-striped table-dark table-hover ">
                    <tbody>
                        <?=$others?>
                    </tbody>
                </table>
            </div>
    </div>

</div>