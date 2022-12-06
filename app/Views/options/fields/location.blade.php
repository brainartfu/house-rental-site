<?php
    $layout = (!empty($layout)) ? $layout : 'col-12';
    if (empty($value)) {
        $value = $std;
    }
    $value = wp_parse_args((array)$value, [
        'address' => '',
        'city' => '',
        'state' => '',
        'postcode' => '',
        'country' => '',
        'lat' => 48.856613,
        'lng' => 2.352222,
        'zoom' => 13
    ]);
    $idName = str_replace(['[', ']'], '_', $id);

    enqueue_style('mapbox-gl-css');
    enqueue_style('mapbox-gl-geocoder-css');
    enqueue_script('mapbox-gl-js');
    enqueue_script('mapbox-gl-geocoder-js');
    $langs = get_languages_field();
?>
<div id="setting-{{ $idName }}" data-condition="{{ $condition }}"
     data-unique="{{ $unique }}"
     data-operator="{{ $operation }}"
     class="form-group mb-3 col {{ $layout }} field-{{ $type }}">
	 	<div class="alert alert-danger" role="alert">
Tutti i campi sottostanti sono obbligatori al fine della corretta indicizzazione lato web e lato ricerca.</div>
    <div class="row">
        <div class="col">
            <div class="form-group">
			<div class="alert alert-primary" role="alert">
 Inserisci l'indirizzo nel box sottostante.Questo passaggio e fondamentale per visualizzare l'indirizzo dell'abitazione sulla scheda.
</div>
                <label for="{{ $idName }}_address_">{{__('Street Address')}}</label>
                @foreach($langs as $key => $item)
                    <input type="text"
                           class="form-control hh-real-address @if (!empty($validation)) has-validation @endif {{get_lang_class($key, $item)}}"
                           name="{{ $id }}[address]{{!empty($item) ? '['. $item .']' : ''}}"
                           id="{{ $idName }}_address{{get_lang_suffix($item)}}"
                           value="{{ get_translate($value['address'], $item) }}"
                           @if(!empty($item)) data-lang="{{$item}}" @endif>
                @endforeach
            </div>
        </div>
        <div class="w-100 mb-3"></div>
    </div>
	<div class="alert alert-primary" role="alert">
 Inserisci l'indirizzo nel box sottostante e seleziona il risultato dal menu a discesa.Questo passaggio e fondamentale per la corretta visualizzazione della mappa.
</div>
    <div class="row">
        <div class="col">
            <div class="mapbox-wrapper">
                <div class="form-group mapbox-text-search">
                    <div class="form-control" data-plugin="mapbox-geocoder" data-value=""
                         data-placeholder="{{__('Add to the map')}}" data-lang="{{get_current_language()}}"></div>
                    <input type="text" class="input-none hh-address"
                           name=""
                           id="{{ $idName }}_search_address" value="">
                </div>

                <div id="{{ $idName }}_mapbox_" class="mapbox-content"
                     data-lat="{{ (float)$value['lat'] }}" data-lng="{{ (float)$value['lng'] }}"
                     data-zoom="{{ $value['zoom'] }}"></div>
                <input type="text" class="input-none hh-zoom" name="{{ $id }}[zoom]"
                       value="{{ $value['zoom'] }}">
            </div>
        </div>
    </div>
			
    <div class="row">
        <div class="col col-sm-6">
            <div class="form-group">
                <label for="{{ $idName }}_city_">{{__('City')}}</label>
                @foreach($langs as $key => $item)
                    <input type="text" class="form-control hh-city {{get_lang_class($key, $item)}}"
                           name="{{ $id }}[city]{{!empty($item) ? '['. $item .']' : ''}}"
                           id="{{ $idName }}_city{{get_lang_suffix($item)}}"
                           value="{{ get_translate($value['city'], $item) }}"
                           @if(!empty($item)) data-lang="{{$item}}" @endif>
                @endforeach
            </div>
        </div>
		
        <!--<div class="col col-sm-6">
            <div class="form-group">
                <label for="{{ $idName }}_state_">{{__('State')}}</label>
                @foreach($langs as $key => $item)
                    <input type="text" class="form-control hh-state {{get_lang_class($key, $item)}}"
                           name="{{ $id }}[state]{{!empty($item) ? '['. $item .']' : ''}}"
                           id="{{ $idName }}_state{{get_lang_suffix($item)}}"
                           value="{{ get_translate($value['state'], $item) }}"
                           @if(!empty($item)) data-lang="{{$item}}" @endif>
                @endforeach
            </div>
        </div>-->
		 <?php
                                                    enqueue_script('nice-select-js');
                                                    enqueue_style('nice-select-css');
                                    
                                                    ?>
		<div class="col col-sm-6">
		<div class="form-group">
                        <label for="{{ $idName }}_state_">{{__('State')}}</label>
						 <select id="{{ $idName }}_state{{get_lang_suffix($item)}}" class="mr-1 min-w-100" data-plugin="customselect"
                                data-validation="required" name="{{ $id }}[state]{{!empty($item) ? '['. $item .']' : ''}}" 
                               data-placeholder="{{ __('Choose ...') }}">
                          
                             <option value="">{{ __('Choose ...') }}</option>
<option value="Agrigento">Agrigento</option>
<option value="Alessandria">Alessandria</option>
<option value="Ancona">Ancona</option>
<option value="Aosta">Aosta</option>
<option value="Arezzo">Arezzo</option>
<option value="Ascoli Piceno">Ascoli Piceno</option>
<option value="Asti">Asti</option>
<option value="Avellino">Avellino</option>
<option value="Bari">Bari</option>
<option value="Bat">Bat</option>
<option value="Belluno">Belluno</option>
<option value="Benevento">Benevento</option>
<option value="Bergamo">Bergamo</option>
<option value="Biella">Biella</option>
<option value="Bologna">Bologna</option>
<option value="Bolzano">Bolzano</option>
<option value="Brescia">Brescia</option>
<option value="Brindisi">Brindisi</option>
<option value="Cagliari">Cagliari</option>
<option value="Caltanissetta">Caltanissetta</option>
<option value="Campobasso">Campobasso</option>
<option value="Carbonia-Iglesias">Carbonia-Iglesias</option>
<option value="Caserta">Caserta</option>
<option value="Catania">Catania</option>
<option value="Catanzaro">Catanzaro</option>
<option value="Chieti">Chieti</option>
<option value="Como">Como</option>
<option value="Cosenza">Cosenza</option>
<option value="Cremona">Cremona</option>
<option value="Crotone">Crotone</option>
<option value="Cuneo">Cuneo</option>
<option value="Enna">Enna</option>
<option value="Fermo">Fermo</option>
<option value="Ferrara">Ferrara</option>
<option value="Firenze">Firenze</option>
<option value="Foggia">Foggia</option>
<option value="Forli-Cesena">Forli-Cesena</option>
<option value="Frosinone">Frosinone</option>
<option value="Genova">Genova</option>
<option value="Gorizia">Gorizia</option>
<option value="Grosseto">Grosseto</option>
<option value="Imperia">Imperia</option>
<option value="Isernia">Isernia</option>
<option value="L'Aquila">L'Aquila</option>
<option value="La Spezia">La Spezia</option>
<option value="Latina">Latina</option>
<option value="Lecce">Lecce</option>
<option value="Lecco">Lecco</option>
<option value="Livorno">Livorno</option>
<option value="Lodi">Lodi</option>
<option value="Lucca">Lucca</option>
<option value="Macerata">Macerata</option>
<option value="Mantova">Mantova</option>
<option value="Massa-Carrara">Massa-Carrara</option>
<option value="Matera">Matera</option>
<option value="Medio Campidano">Medio Campidano</option>
<option value="Messina">Messina</option>
<option value="Milano">Milano</option>
<option value="Modena">Modena</option>
<option value="Monza e Brianza">Monza e Brianza</option>
<option value="Napoli">Napoli</option>
<option value="Novara">Novara</option>
<option value="Nuoro">Nuoro</option>
<option value="Ogliastra">Ogliastra</option>
<option value="Olbia-Tempio">Olbia-Tempio</option>
<option value="Oristano">Oristano</option>
<option value="Padova">Padova</option>
<option value="Palermo">Palermo</option>
<option value="Parma">Parma</option>
<option value="Pavia">Pavia</option>
<option value="Perugia">Perugia</option>
<option value="Pesaro e Urbino">Pesaro e Urbino</option>
<option value="Pescara">Pescara</option>
<option value="Piacenza">Piacenza</option>
<option value="Pisa">Pisa</option>
<option value="Pistoia">Pistoia</option>
<option value="Pordenone">Pordenone</option>
<option value="Potenza">Potenza</option>
<option value="Prato">Prato</option>
<option value="Ragusa">Ragusa</option>
<option value="Ravenna">Ravenna</option>
<option value="Reggio Calabria">Reggio Calabria</option>
<option value="Reggio Emilia">Reggio Emilia</option>
<option value="Rieti">Rieti</option>
<option value="Rimini">Rimini</option>
<option value="Roma">Roma</option>
<option value="Rovigo">Rovigo</option>
<option value="Salerno">Salerno</option>
<option value="Sassari">Sassari</option>
<option value="Savona">Savona</option>
<option value="Siena">Siena</option>
<option value="Siracusa">Siracusa</option>
<option value="Sondrio">Sondrio</option>
<option value="Taranto">Taranto</option>
<option value="Teramo">Teramo</option>
<option value="Terni">Terni</option>
<option value="Torino">Torino</option>
<option value="Trapani">Trapani</option>
<option value="Trento">Trento</option>
<option value="Treviso">Treviso</option>
<option value="Trieste">Trieste</option>
<option value="Udine">Udine</option>
<option value="Varese">Varese</option>
<option value="Venezia">Venezia</option>
<option value="Verbano-Cusio-Ossola">Verbano-Cusio-Ossola</option>
<option value="Vercelli">Vercelli</option>
<option value="Verona">Verona</option>
<option value="Vibo Valentia">Vibo Valentia</option>
<option value="Vicenza">Vicenza</option>
<option value="Viterbo">Viterbo</option>
                           
                        </select>
                    </div></div>
        <div class="col col-sm-6">
            <div class="form-group">
                <label for="{{ $idName }}_postcode_">{{__('PostCode')}}</label>
                <input type="text" class="form-control hh-postcode" name="{{ $id }}[postcode]"
                       id="{{ $idName }}_postcode_"
                       value="{{ $value['postcode'] }}">
            </div>
        </div>
        <div class="col col-sm-6">
            <div class="form-group">
                <label for="{{ $idName }}_country_">{{__('Country')}}</label>
                @foreach($langs as $key => $item)
                    <input type="text" class="form-control hh-country {{get_lang_class($key, $item)}}"
                           name="{{ $id }}[country]{{!empty($item) ? '['. $item .']' : ''}}"
                           id="{{ $idName }}_country{{get_lang_suffix($item)}}"
                           value="{{ get_translate($value['country'], $item) }}"
                           @if(!empty($item)) data-lang="{{$item}}" @endif>
                @endforeach
            </div>
        </div>
        <div class="col col-sm-6">
            <div class="form-group">
                <label for="{{ $idName }}_lat_">{{__('Latitude')}}</label>
                <input type="text" class="form-control hh-lat" name="{{ $id }}[lat]"
                       id="{{ $idName }}_lat_" value="{{ $value['lat'] }}">
            </div>
        </div>
        <div class="col col-sm-6">
            <div class="form-group">
                <label for="{{ $idName }}_lng_">{{__('Longtitude')}}</label>
                <input type="text" class="form-control hh-lng" name="{{ $id }}[lng]"
                       id="{{ $idName }}_lng_" value="{{ $value['lng'] }}">
            </div>
        </div>
    </div>
</div>
@if($break)
    <div class="w-100"></div> @endif
