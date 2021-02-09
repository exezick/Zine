<?php 
$video_title = '';
?>
<video id="the_video" class="bd-placeholder-img card-img-top rounded-0 black video animated fadeIn" autoplay controls>
    <?php foreach ($video_default as $videos): ?>
        <?php 
            $catid = $videos['cat_id'];
            $video_title = $videos['title'];
        ?>
        <source src="<?php echo base_url().'uploads/'.$videos['categoryname'].'/'.$videos['title']; ?>" id="video_source">
    <?php endforeach; ?>
</video>
<div class="card-body content-dark">
    <h5 class="card-title video-title">
        <i class="fa fa-play-circle-o animated pulse infinite red font-lg"></i> 
        <?=ucfirst($video_title)?>
        <button onclick="videos.scan()" class="btn btn-sm btn-dark border-dark float-right ml-3 mt-1 hide">
            <i class="fa fa-search-plus"></i> 
            Scan Videos
        </button>
    </h5>
</div>
<div class="hr"></div>