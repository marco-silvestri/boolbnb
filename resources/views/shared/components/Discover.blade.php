<h2 class ="titlem">Lasciati ispirare</h2>
<section id ="section-discover">
    <div class="discover first">
        <div class="discover-left">
            <img class ="img-fluid"src="{{asset('img/milano.jpg')}}" alt="">
            
        </div>
        <div class="discover-right">
            <div class="my-carousel">
                <i class="fas fa-caret-left"></i>
                <form id="milano" class="d-flex" action="{{ route('guest.city') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="container-search-bar d-flex">
                        <input class="submit" type="submit" name='cityName' value="Milano">
                    </div>
                </form> 
                <i class="fas fa-caret-right"></i>
            </div>
            <p><strong>Milano</strong>, capoluogo lombardo che stupisce per le emozioni che sa regalare, è una città colta, moderna, vivace, e ricca di bellezze e opere artistiche. Il Duomo, con la luminosa facciata in marmo di Candoglia e l'architettura tardo-gotica, è il monumento simbolo di questa metropoli dell'Italia settentrionale.</p>
        </div>
    </div>

    <div class="discover-none">
        <div class="discover-left">
            <img class ="img-fluid"src="{{asset('img/Roma.jpg')}}" alt="">
            
        </div>
        <div class="discover-right">
            <div class="my-carousel">
                <i class="fas fa-caret-left"></i>
                <form id="roma" class="d-flex" action="{{ route('guest.city') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="container-search-bar d-flex">
                        <input class="submit" type="submit" name='cityName' value="Roma">
                    </div>
                </form> 
                <i class="fas fa-caret-right"></i>
            </div>
            <p> <strong>Roma</strong> è la capitale politica dell'Italia, ma anche il centro della cristianità e ospita all'interno del suo territorio la città stato del Vaticano.La capitale offre ai suoi visitatori una moltitudine di appuntamenti culturali, dalle mostre permanenti a quelle itineranti che riempiono i tanti musei con opere d'arte.</p>
        </div>
    </div>

    <div class="discover-none">
        <div class="discover-left">
            <img class ="img-fluid"src="{{asset('img/Firenze.jpg')}}" alt="">

        </div>
        <div class="discover-right">
            <div class="my-carousel">
                <i class="fas fa-caret-left"></i>
                <form id="firenze" class="d-flex" action="{{ route('guest.city') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="container-search-bar d-flex">
                        <input class="submit" type="submit" name='cityName' value="Firenze">
                    </div>
                </form> 
                <i class="fas fa-caret-right"></i>
            </div>
            <p><strong>Firenze</strong> viene universalmente riconosciuta come città dell’Arte, per il suo prezioso ed ineguagliabile patrimonio artistico che vanta monumenti di diversi stili, ricchi musei come la galleria degli Uffizi e il Palazzo Pitti, e ville magnifiche in buona parte appartenenti alla storica famiglia dei Medici.</p>
        </div>
    </div>

    <div class="discover-none last">
        <div class="discover-left">
            <img class ="img-fluid"src="{{asset('img/Venezia.jpg')}}" alt="">
            
        </div>
        <div class="discover-right">
            <div class="my-carousel">
                <i class="fas fa-caret-left"></i>
                <form id="venezia" class="d-flex" action="{{ route('guest.city') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="container-search-bar d-flex">
                        <input class="submit" type="submit" name='cityName' value="Venezia">
                    </div>
                </form> 
                <i class="fas fa-caret-right"></i>
            </div>
            <p> <strong>Venezia</strong> è una città incredibile, costituita da un insieme di 118 isole unite da oltre 400 ponti e separate dai canali che fungono da strade, percorsi da barche e gondole. Venezia è una città affascinante per i numerosi tesori d'arte che custodisce: chiese, palazzi, musei, ponti.</p>
        </div>
    </div>
</section>
    

