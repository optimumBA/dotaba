 <div class="clear"></div>
    <!-- Gallery Shades Start -->
    <div id="content-sec">
    	<div class="inner">
        	<!-- Columns Section Start -->
            <div class="col4">
            	<div class="gallery-head">
                	<h1 class="colr">Snimci</h1>
                    <nav id="filter"><a class="" href="/">Naslovnica</a><a class="" href="/vods">Vods</a><a class="active" href="#">Snimci</a></nav>
                    <div class="clear"></div>
                </div>
                <section id="gal-container">
                	<ul class="gallery-two-col" id="stage">
                         
               <?php if (count($videos) > 0): ?>
	<?php foreach ($videos as $video): ?>          
                         
                         <li data-tags="Videos">
                        	<a href="/vods/snimci/<?=$video->id.'-'.URL::title($video->name);?>" class="thumb play"><img src="http://i.ytimg.com/vi/<?=$video->vid;?>/0.jpg" alt="" /></a>
                            <div class="gal-caption">
                            	<h3><a href="/vods/snimci/<?=$video->id.'-'.URL::title($video->name);?>" class="colr play"><?=$video->name;?></a></h3>
                                <p>
                                	<?=$video->description;?>
                                </p>
                            </div>
                        </li>
                        <?php endforeach ?>
<?php else: ?>
	Trenutno nema videa.
<?php endif; ?>
                        
					</ul>
                </section>
            </div>
            <div class="clear"></div>
            <!-- Columns Section End -->
        </div>
    </div>
    <!-- Album Shades End -->
    <div class="clear"></div>