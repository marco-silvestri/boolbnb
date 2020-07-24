<h1 class="text-center text-5xl font-bold">Apartment Statistics</h1>
		<div class="display-flex flex-direction-column">
            <div class="w1/2 pt-8">
                {!! $statisticChart->container() !!}  
               
            </div>
            <div class="w1/2 pt-8">
                {!! $statisticView->container() !!}    
               
            </div>
            
            <div class="w1/2">
                <h2 class="font-bold text-2xl px-24 pt-12">Graphic of the Apartment</h2>
                    <p class="px-24">
                        the graph represents the statistics of the visualizations and messages that the apartment received </p> 
                </div>
                
            </div>
        </div>
		
    
        
            {!! $statisticChart->script() !!}
            {!! $statisticView->script() !!}