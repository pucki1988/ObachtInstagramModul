<?php 
// No direct access
defined('_JEXEC') or die; ?>

<div class="container">
    <div class="row">
        
<?php 
foreach($instagram_posts as $post)
{ ?>
    <div class="col-lg-4 col-sm-6 my-3">
        <?php echo '<img class="w-100" src="'.$post->media_url.'" />';?>
    </div>
<?php  
}

?>
</div>
</div>