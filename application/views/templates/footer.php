
<footer class="text-muted text-center">
  <div class="container">
    <br>
    <p>
      <a class="btn btn-sm btn-danger border-dark" href="<?php echo base_url(); ?>">
        <i class="fa fa-youtube-play animated heartBeat infinite"></i> ZINE
      </a> 
      © Copyright 2020 | Created By: Exezick
    </p>
    <br>
  </div>
</footer>

<?php 
foreach ($defaultfootercontents as $footercont):
    echo $footercont . "\n";
endforeach;

foreach ($somefootercontents as $somefootercont):
  echo $somefootercont . "\n";
endforeach;

?>

</body>
</html>