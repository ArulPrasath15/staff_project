<?php
if(file_exists("./assets/Notiflix/Minified/notiflix-2.1.2.min.js"))
{
   echo '<script src="./assets/Notiflix/Minified/notiflix-2.1.2.min.js"></script>';
   echo '<link rel="stylesheet" href="./assets/Notiflix/Minified/notiflix-2.1.2.min.css">';
}
else if(file_exists("../assets/Notiflix/Minified/notiflix-2.1.2.min.js"))
{
   echo '<script src="../assets/Notiflix/Minified/notiflix-2.1.2.min.js"></script>';
   echo '<link rel="stylesheet" href="../assets/Notiflix/Minified/notiflix-2.1.2.min.css">';
}
else{
   echo '<script src="../../assets/Notiflix/Minified/notiflix-2.1.2.min.js"></script>';
   echo '<link rel="stylesheet" href="../../assets/Notiflix/Minified/notiflix-2.1.2.min.css">';
}
?>
<script type="text/javascript">
   Notiflix.Notify.Init({ distance:"20px",timeout:"5000",position:"right-bottom",fontSize:"20px",borderRadius:"10px",width:"300px", });
   Notiflix.Report.Init({ width:"360px",titleFontSize:"25px",messageFontSize:"20px",buttonFontSize:"20px", });
</script>
