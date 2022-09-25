<?php 
// No direct access
defined('_JEXEC') or die; ?>


<style>
.i-post{
        overflow:hidden;
        max-height:350px;
}

.i-post img{
    -webkit-transition: all 0.4s ease;
    -moz-transition: all 0.4s ease;
    -ms-transition: all 0.4s ease;
    -o-transition: all 0.4s ease;
    transition: all 0.4s ease;
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

.scrolldown-icon{
    position: absolute;
    color: #ffc11e;
    bottom: 0;
    text-align: center;
    z-index: 5;
    left: 5px;
    width: 50px;
    height: 3rem;
    line-height: 3rem;
}

.i-post .scrolldown-icon:hover + .i-caption{
    top:0;
    cursor:pointer;
    -webkit-transition: all .3s ease;
-moz-transition: all .3s ease;
-ms-transition: all .3s ease;
-o-transition: all .3s ease;
transition: all .3s ease;
}



.i-post .link-insta img:hover{
    -moz-transform: scale(1.1);
-webkit-transform: scale(1.1);
-o-transform: scale(1.1);
-ms-transform: scale(1.1);
transform: scale(1.1);
}

.scrolldown-icon:hover{
    color:#000;
}
@media(max-width:581px){
    .i-post span{
        font-size:.8rem;
    }

    .i-caption{
    font-size:.7rem;
    }

    .scrolldown-icon{
        line-height:3.5rem;
        left: 0;
        width: 40px;
    }
}
@media(max-width:1200px){
    .i-post{
        max-height:300px
    }
}

@media(max-width:992px){
    .i-post{
        max-height:230px
    }
}

@media(max-width:768px){
    .i-post{
        max-height:200px
    }
}

@media(max-width:581px){
    .i-post{
        max-height:150px
    }
}


</style>

    <div class="row no-gutters">
        
<?php 

foreach($instagram_posts as $post)
{ 
    $bildklasse="";
    if($post->media_type=="VIDEO"){
        list($width, $height) = getimagesize($post->thumbnail_url);
    }
    else{
        list($width, $height) = getimagesize($post->media_url);
    }
    
    if ($width > $height) {
        $bildklasse="h-100";
    } else {
        $bildklasse="w-100";
    }

    ?>
    <div class="col-md-4 col-6 mt-2 i-posts px-1">

        <?php 
            echo '<div class="w-100 h-100 i-post" style="position:relative">';
            echo '<a class="scrolldown-icon" href="#section7"><i class="fas fa-ellipsis-v"></i></a>';
            echo '<div class="i-caption p-2">'.$post->caption.'</div>';
            echo '<a class="link-insta" href="'.$post->permalink.'" class="h-100 w-100">';
            echo '<span class="icon d-flex align-items-center justify-content-end">'.$post->username.'<i class="fab fa-instagram fa-2x p-2"></i></span>';
            if($post->media_type=="VIDEO"){
                echo '<img class="w-100" src="'.$post->thumbnail_url.'" />';
            }else{
                echo '<img class="'.$bildklasse.'" src="'.$post->media_url.'" />';
            }
            
            echo '</a>';
            echo '</div>';
            
        ?>
    </div>
<?php  
}

?>
</div>