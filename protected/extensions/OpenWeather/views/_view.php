<div class="weather-wrapper ">
    <span class="weather-place"></span>
    <img src="" class="weather-icon" alt="Weather Icon" />
    <span class="weather-temperature"></span>
    <!--<span class="weather-description"></span>-->
</div>

<script>
	
		$(function() {
                        var options={
                                success: function() {
					//show weather
                                        $("<?php echo $this->cssClass; ?>").show();
					
				},
				error: function(message) {
					console.log(message);
				
				}};
                        
                        options = $.extend({}, options, <?php echo $this->json_options ; ?>);
                        console.log(options);
			$('.weather-temperature').openWeather(options);
			
		});
	
</script>