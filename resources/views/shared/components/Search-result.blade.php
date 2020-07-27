{{-- Handlebars will be printed here --}}
<div class="container search-apt">
    <div id="context">

    </div>
</div>

{{-- Templating --}}
<script id="card-template" type="text/x-handlebars-template">
    <div class="u-card-apt">
        <div class="apt">
            @{{{ alert }}}
            
            <div class="img">
                @{{{  imgConstructor  }}}
                @{{{  routeConstructor  }}}
            </div>

            <div class="info-options">
                <div class="info">
                    <h3> @{{ cardName }}</@> </h3>
                    <p>@{{ cardDescription }}</p>
                </div>
    
                <div class="options">
                    @{{#each cardOptions}}
                    <p>@{{this}} </p>
                    @{{/each}}
                </div>
            </div>
            
            
            
        </div>
        
    </div>
    
</script>
