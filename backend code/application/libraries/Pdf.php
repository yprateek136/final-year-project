<!-- Secondary Banner -->
<div id="secondary-banner" style="background-image:url(<?=base_url('assets/imgs/research-banner1.png')?>">
	<div class="container">
		<div class="inner-content">
			<div class="inner">
				<h1>Business Incubation Centre</h1>
				<div class="button-group">
					 <a class="search-box" href="<?=base_url('search')?>">Find Course<i class="fa fa-search"></i></a>
					 <a class="btn button2 btn-lg" href="<?=base_url('apply')?>">Apply Now</a>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /Secondary Banner -->
	<!-- Content -->
	<div id="content">
		<!-- Breadcrumbs -->
					
				<div id="breadcrumbs">
					<div class="container">
						<a href="<?=base_url()?>"><i class="icon-home icons"></i></a>
						<span class="divider"><i class="icon-arrow-right icons"></i></span>
						<a href="<?=base_url('academics')?>">Academics</a>
						<span class="divider"><i class="icon-arrow-right icons"></i></span>
						<a href="<?=base_url('academics/research-overview')?>">Research</a>
						<span class="divider"><i class="icon-arrow-right icons"></i></span>
						<a>Business Incubation Centre</a>
					</div>
				</div>
				<!-- /Breadcrumbs -->
				<div id="business-incubation">
					<div class="container">
							</div>
								<!-- Overview -->
								<section id="overview">
									<div class="container">
										<article class="post">
											<!-- Content Block -->
											<div class="content-block">
												<h4>Business Incubation Centre</h4>
												<h5>Overview</h5>

												<p>Addressing the increase in the potential of startups, Sharda University's Business Incubation Centre (BIC) was established in 2013 under the sponsorship by the Ministry of Micro, Small and Medium Enterprises (MSME), Govt. of India, New Delhi. The objective of the incubation centre is simple - to inspire and work with aspiring entrepreneurs to shape up business ideas into commercial start-up companies.</p>
<p>Under the guidance of diligent and experienced faculty, candidates learn the dynamic process of business development and how to survive in their early stage. In addition, the institutions also provide infrastructural support i.e. office space, meeting room to the candidates. At every step, the individuals are mentored and nurtured for their acquiescent business ideas.</p>
<p>At present, the research work on eight approved ideas is in progress.</p>
				<ul>
				<li>Lab scale development of the piezoelectric transformer.</li>
				<li>Development of light emitting diodes.</li>
				<li>Design and Development of filters.</li>
				<li>Antibacterial nanomaterial embedded fabrics for medical applications.</li>
				<li>Development of photovoltaic modules of dye-sensitized solar cell.</li>
				<li>Prototype development of super-capacitor.</li>
				<li>Development of intelligent system as graphology expert.</li>
				<li>Biodiesel production from waste vegetable and non-edible oils using a nano-particle catalyst for commercial purposes.</li>
				</ul>	
											</div>	
											
				<div class="content-block">
												<div class="row">
									<div class="col-sm-6">
												<h5>Objectives</h5>
								<ul>
									<li>Business and technical mentoring by the in-house-faculty and industry experts.</li>
									<li>Coordinating and providing hands-on training to introduce candidates with industry interface.</li>
									<li>Organizing activities/seminars/events/lectures to promote and support the entrepreneurial spirit of the candidates.</li>
									<li>Providing fundraising assistance.</li>
									<li>Close monitoring and feedback to the candidates on their market research and business planning for successful implementation.</li>
								</ul>
													</div>
													<div class="col-sm-6">
												<h5>Key Highlights</h5>
								<ul>
										<li>The Business Incubator Centre is developed supporting prime minister’s vision for Startup India.</li>
										<li>Candidates are mentored by the industry-leading experts.</li>
										<li>Currently, eight projects are under the supervision of the faculty.</li>
										<li>Regular workshops and events are held to enhance the entrepreneurial spirit of the candidates.</li>
										<li>The selected candidates are offered fundraising assistance and infrastructural facilities.</li>  

														</ul>
													</div>
													</div>
								
							</div>
											<!-- /Content Block -->	
										</article>		
									</div>
								</section>	
								<!-- /Overview -->
								<!-- Quick Facts -->
								<section id="quick-facts">
									<div class="container">
										<ul class="clearfix">
											<li>
												<span>250+</span>
												<p>Total no. of Recruiters</p>					
											</li>
											<li>
												<span>9.6 Lac</span>
												<p>Package Post Graduate</p>					
											</li>
											<li>
												<span>15 Lac</span>
												<p>Package Graduate</p>					
											</li>
											<li>
												<span>30+</span>
												<p>Fortune 500 Companies</p>					
											</li>
										</ul>
									</div>
								</section>
				<!-- /Quick Facts -->
				
				<!-- Dean Msg  -->
				<?php $professorDetails = $researchDetails['Profile'][0] ?>
				<section id="dean-msg">
					<div class="container clearfix">
						<div class="section dean-img">
							<figure>
								<img src="<?=base_url('attachments/research_images/'.$professorDetails->research_image)?>" alt="dean-image">
								<figcaption><p><?=$professorDetails->title?></p></figcaption>
							</figure>
						</div>
						<div class="section dean-data">
							<article class="post">
							<?=html_entity_decode($professorDetails->description)?>
							</article>
						</div>
					</div>
				</section>
				<!-- /Dean Msg  -->
				
				<!-- Patents Publications  -->
				<section id="patents-publications">
					<div class="container">
						<h4 class="text-center">Our Patents</h4>
							<div class="row">
								<?php foreach($researchDetails['Incubation Patents'] as $patentsDetails) { 
									$research_image = $patentsDetails->research_image<>'' ? base_url('attachments/research_images/'.$patentsDetails->research_image) : base_url('assets/imgs/patent-banner1.png');
								?>
									<div class="col-sm-4">
										<!-- Patent Box -->
										<div class="patent-box">
											<!-- Banner -->
											<div class="banner" style="background-image:url(<?=$research_image?>">
											
											</div>
											<!-- /Banner -->
											<!-- Content -->
											<div class="content">
												<div class="inner-content">
											
												<p><?=$patentsDetails->description?></p>
												</div>
											</div>
											<!-- /Content -->
										</div>
										<!-- /Patent Box -->
									</div>
								<?php } ?>
								</div>
					</div>
				</section>
				<!-- /Patents Publications  -->
				<!-- Research Journal -->
				<section id="progress-incubation" class="section">
					<div class="container">
						<h4 class="text-center">Progress at Business Incubation Centre</h4>
						<ul class="list3">
							<?php 
							foreach($researchDetails['Business Incubation'] as $publicationsDetails) 
							{ 
							?>
							<li>
								<p><?=$publicationsDetails->description?></p>
							</li>
							<?php } ?>
						</ul>
						
					</div>
				</section>
				<!-- /Research Journal -->
								
				</div>
				<!-- /Business Incubation -->
				
				<!-- /Awards Listing -->
		</div>	