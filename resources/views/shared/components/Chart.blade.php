
<div class="display-flex flex-direction-column my-5">
    <h1 class="text-center pt-4">Statistiche dell'Appartamento</h1>
    <h2 class="font-bold text-center text-2xl px-24 pt-8">Descrizione:</h2>
    <p class="text-center pt-3">Il primo grafico rappresenta le statistiche dei messaggi, 
        che l' appartamento riceve in un anno. 
    </p>
    <p class="text-center pt-3">Il secondo grafico rappresenta le statistiche delle visualizzazioni 
            del proprio appartamento confrontate con quelle di tutti gli appartamenti presenti 
            sul sito.
    </p>
                
    <div class="w1/2 pt-2">
        {!! $statisticChart->container() !!}   
    </div>

    <div class="w1/2 pt-2">
        {!! $statisticView->container() !!}    
    </div> 
</div>

		       
{!! $statisticChart->script() !!}
{!! $statisticView->script() !!}