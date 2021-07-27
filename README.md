# CLAS Website Templates
This plugin provides the CLAS home website with the new template and functionality

## Layout
- ### Slider
  - Uses Bootstrap Slider that is being used in the UFCLAS Theme
- ### Links to other Pages
  - This gets typed in through the dashboard when the page is created
- ### Spotlight
  - This is a widget area. Can be edited through the customizer
  - Code example
  ```html
    <div class="row">
  	<h3 class="mobile">Spotlight</h3>
  	<div class="col-md-6 spotlight-image">
  		<img src="https://test.clas.ufl.edu/new-clas-layout/files/2021/06/jack-davis.jpg" alt="Jack Davis" />
  	</div>

  	<div class="col-md-6 text-content">
  		<h3 class="desktop">Spotlight</h3>
  		<h4>Dr. Jack E. Davis selected as recipient of
  2019 Andrew Carnegie fellowship</h4>

  		<p>
  			“Academics don’t usually publish books that get national attention — you hope, but don’t dare expect it,” says Jack Emerson Davis, UF professor of environmental history and sustainability studies. “I hoped for book reviews in The New York Times.”
  		</p>

  		<p>
  			The Gulf — The Making of an American Sea, Davis’ latest book, exceeded his expectations. Not only did it get reviewed in The New York Times, but it also made the cover of The New York Times Book Review, saying, “In Davis’s hands, the story reads like a watery version of the history of the American West. Both places saw Spanish incursions from the south, mutual incomprehension in the meeting of Europeans and aboriginals, waves of disease that devastated the natives and a relentless quest by the newcomers for the raw materials of empire. There were scoundrels and hucksters, booms and busts, senseless killing in sublime landscapes and a tragic belief in the inexhaustible bounty of nature.”
  		</p>
  	</div>
  </div>
   ```
- ### In the News
  - Shortcode is used that pulls in news from site specified
    - Code example - ```[clas-news-feed site_id="223" tag='clas-home' eventtotal="3"] ```
    - ***site_id*** has to be equal to the Site ID where you want to retrieve the posts from
    - ***tag*** equal to the tag you would like to pull in
    - ***eventtotal*** how many posts you would like to pull in from another website
- ### Upcoming events
  - Widget area that can be edited through customizer. "Event List" widget has to be selected
- ### Bottom 3 Blocks
  - Widget area that can use custom HTML.
  - Code example
  ```html
  <div class="row">
	<div class="col-md-7">
		<a href="https://clas.ufl.edu/clas-connected/" title="CLAS Connected"><img src="https://test.clas.ufl.edu/new-clas-layout/files/2021/06/clas-connected.jpg" alt="Student Walking with mask on" /></a>
	</div>

	<div class="col-md-5">
		<div class="container">
			<h3>
			CLAS Connected
		</h3>

		<p>
			Though we can’t all be on campus, it’s important that we come together to support each other in these challenging times. As we embark on the Spring 2021 semester, this digital hub is here to make life a bit easier by collecting all of your need-to-know resources, programs, services and events in one place.
		</p>

		<p>
			By staying connected, we can ensure that journeys still begin here.
		</p>

		<p>
			<a href="https://clas.ufl.edu/clas-connected/" title="CLAS Connected">Read More <em class="fas fa-chevron-double-right"></em></a>
		</p>
		</div>
	</div>
</div> ```

## Templates
- CLAS Website Home Page
  - public/templates/ufclas-main-website-home.php
- CLAS Website Interior Pages
  - public/templates/ufclas-main-website-home.php

## Things to do
- Create the interior page templates for the website. This can be coded in the file templates/ufclas-main-website-interior.php
