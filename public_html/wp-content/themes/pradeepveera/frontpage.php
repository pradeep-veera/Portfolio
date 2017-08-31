<?php
/*

	Template Name: Frontpage

*/	

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php while ( have_posts() ) : the_post(); ?>
			<?php 
				$pages = get_pages( array(
						'sort_column' => 'menu_order', // allows you to order pages using menu order under page attributes
						#'exclude' => 2342 ,
						) ); 
				foreach ($pages as $page):
					if($page->ID == 6){ #Home
			?>
						<div class="banner">	
							<div class="pages" id="frontpage">
								 <!--h1 class="title"><?php echo $page->post_title ?></h1-->
								 <div class="content">
				<?php		    	if(has_post_thumbnail()):
										 $image = get_the_post_thumbnail($page->ID, 'myphoto');
									endif;
				?>					
									<div class="image"><?php echo $image ?></div>
									<div class="page_content"><ul>
										<li style="margin-left:-20px">Pradeep Veera</li>
										<li><span class="glyphicon glyphicon-home"></span>Endel strasse 22b,</br>39106 Magdeburg</li>
										<li><span class="glyphicon glyphicon-phone"></span>+49 17672854632</li>
										<li><span class="glyphicon glyphicon-envelope"></span><a href="mailto:pradeep.veera@outlook.com">pradeep.veera@outlook.com</a></li>
									</ul></div>			
								 </div>
							</div>	
				<?php		
						}elseif($page->ID == 8){	#ABout me
				?>
							<div class="pages" id="page_aboutme">
								 <h1 class="title"><a name="<?php echo $page->post_title ?>"><?php echo $page->post_title ?></a></h1>
								 <div class="content">
									<p>
										<?php echo $page->post_content ?>
										<h2> Hobbies </h2>	
										<ul class="hobbies">
											<li>bicycling</li>
											<li>codding</li>
											<li>movies</li>
										</ul>
										<br>
										<h2>Currently Looking for</h2>
										<p>Full time employment as Full stack developer</p>
									</p>				
								 </div>
							</div>
						</div>	
			<?php
						}elseif($page->ID == 15){	#education
			?>
						<div class="banner" style="width:110%; margin-left:-30px;">	
							<div class="pages" id="page_education">
								 <h1 class="title"><a name="<?php echo $page->post_title ?>"><?php echo $page->post_title ?></a></h1>
								 <div class="content"><?php echo do_shortcode('[education]'); ?></div>
							</div>
						</div>	
			<?php
						}elseif($page->ID == 10){	#skills
			?>
						<div class="banner">	
							<div class="pages" id="page_skills">
								 <h1 class="title"><a name="<?php echo $page->post_title ?>"><?php echo $page->post_title ?></a></h1>
								 <div class="content"><?php echo do_shortcode('[skill]'); ?></div>
							</div>
						</div>		
				<?php
						}elseif($page->ID == 13){	#experience
				?>
						<div class="banner" style="width:110%">	
							<div class="pages" id="page_experience">
								 <h1 class="title"><a name="<?php echo $page->post_title ?>"><?php echo $page->post_title ?></a></h1>
								 <div class="content"><?php echo do_shortcode('[experience]'); ?></div>
							</div>
						</div>	
			<?php
						}elseif($page->ID == 17){	#education
			?>
						<div class="banner" style="width:110%; margin-left:-30px;">	
							<div class="pages" id="page_portfolio">
								 <h1 class="title"><a name="<?php echo $page->post_title ?>"><?php echo $page->post_title ?></a></h1>
								 <div class="content"><?php echo do_shortcode('[portfolio]'); ?></div>
							</div>
						</div>	
			<?php				
						}elseif($page->ID == 19){	#contact
			?>	
						<div class="banner">	
							<div class="pages" id="page_contact">
								 <h1 class="title"><a name="<?php echo $page->post_title ?>"><?php echo $page->post_title ?></a></h1>
								 <div class="content"><?php echo do_shortcode('[kontakt-formular]'); ?></div>
							</div>
						</div>
			<?php
					}


				endforeach #foreach
			?>	
			<?php endwhile; // end of the loop. ?>

		</main>
	</div>

<?php //get_sidebar(); ?>
<?php get_footer(); ?>
