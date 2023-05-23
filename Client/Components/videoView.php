<?php

if (isset($_GET['video_id'])) {
   $videoId = $_GET['video_id'];
   include_once('./php/conn.php');

   $select_query = "SELECT * FROM video
                    WHERE id = $videoId";
   $select_query_run = mysqli_query($conn, $select_query);
   $row = mysqli_fetch_assoc($select_query_run);
} else {
   header("Location: video.php");
   exit(0);
}


?>
<section class="watch-video">

   <div class="video-container">
      <div class="video">
         <video width="100%" id="video" src="../<?= $row['video_path'] ?>" autoplay controls></video>

      </div>
      <h3 class="title">
         <?= $row['video'] ?>
      </h3><br>


   </div>

   <br>
   <h4>Description :</h4>
   <p class="description">
      <?= $row['description'] ?>
   </p>
   </div>

</section>

<script>
   const video = document.getElementById("video")
   window.addEventListener("load", function () {
      video.play();
   });

</script>