{{-- Handlebars will be printed here --}}
<div class="card">
    <div id="context"></div>

</div>

{{-- Templating --}}
<script id="card-template" type="text/x-handlebars-template">
    <div class="container">
            <h3>@{{ alert }}</h3>
            <h3> @{{ cardName }}</h3>
            <p> @{{ cardDescription }}</p>
            @{{{  imgConstructor  }}}
            @{{{  routeConstructor  }}}
    </div>
</script>