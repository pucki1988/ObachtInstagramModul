<?php 
// No direct access
defined('_JEXEC') or die; ?>


<style>
.i-post{
        overflow:hidden;
}
.i-post span{
    width: 100%;
    position: absolute;
    color:#ffc11e;
    bottom: 0;
    background:rgba(0,0,0,.6);
    z-index: 1;
}

.i-caption{
    position: absolute;
    width: 100%;
    height: 100%;
    top: -1000%;
    background:#ffc11e;
    font-weight:400;
    z-index: 0;
}

.i-post:hover > .i-caption{
    top:0;
    -webkit-transition: all .3s ease;
-moz-transition: all .3s ease;
-ms-transition: all .3s ease;
-o-transition: all .3s ease;
transition: all .3s ease;
}


</style>

    <div class="row">
        
<?php 
foreach($instagram_posts as $post)
{ ?>
    <div class="col-md-4 col-12 my-3 i-posts">

        <?php 
            echo '<div class="w-100 h-100 i-post" style="position:relative">';
            echo '<a href="'.$post->permalink.'" class="h-100 w-100">';
            echo '<span class="icon d-flex align-items-center justify-content-end">'.$post->username.'<i class="fab fa-instagram fa-2x p-2"></i></span>';
            echo '<img class="w-100" src="'.$post->media_url.'" />';
            echo '</a>';
            echo '<div class="i-caption p-2">'.$post->caption.'</div>';
            echo '</div>';
            
        ?>
    </div>
<?php  
}

?>
</div>