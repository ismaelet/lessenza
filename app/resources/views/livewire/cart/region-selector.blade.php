<select
	name="region"
	class="rounded-sm px-2 py-2 outline outline-neutral-200 transition-colors focus:outline-neutral-300 md:col-span-2"
	required
	wire:model.live="region"
>
	<option
		value=""
		selected
	>Seleziona la provincia</option>
	<option
		value="AG"
		@selected($address?->region == 'AG')
	>Agrigento</option>
	<option
		value="AL"
		@selected($address?->region == 'AL')
	>Alessandria</option>
	<option
		value="AN"
		@selected($address?->region == 'AN')
	>Ancona</option>
	<option
		value="AO"
		@selected($address?->region == 'AO')
	>Aosta</option>
	<option
		value="AR"
		@selected($address?->region == 'AR')
	>Arezzo</option>
	<option
		value="AP"
		@selected($address?->region == 'AP')
	>Ascoli Piceno</option>
	<option
		value="AT"
		@selected($address?->region == 'AT')
	>Asti</option>
	<option
		value="AV"
		@selected($address?->region == 'AV')
	>Avellino</option>
	<option
		value="BA"
		@selected($address?->region == 'BA')
	>Bari</option>
	<option
		value="BT"
		@selected($address?->region == 'BT')
	>Barletta-Andria-Trani</option>
	<option
		value="BL"
		@selected($address?->region == 'BL')
	>Belluno</option>
	<option
		value="BN"
		@selected($address?->region == 'BN')
	>Benevento</option>
	<option
		value="BG"
		@selected($address?->region == 'BG')
	>Bergamo</option>
	<option
		value="BI"
		@selected($address?->region == 'BI')
	>Biella</option>
	<option
		value="BO"
		@selected($address?->region == 'BO')
	>Bologna</option>
	<option
		value="BZ"
		@selected($address?->region == 'BZ')
	>Bolzano</option>
	<option
		value="BS"
		@selected($address?->region == 'BS')
	>Brescia</option>
	<option
		value="BR"
		@selected($address?->region == 'BR')
	>Brindisi</option>
	<option
		value="CA"
		@selected($address?->region == 'CA')
	>Cagliari</option>
	<option
		value="CL"
		@selected($address?->region == 'CL')
	>Caltanissetta</option>
	<option
		value="CB"
		@selected($address?->region == 'CB')
	>Campobasso</option>
	<option
		value="CI"
		@selected($address?->region == 'CI')
	>Carbonia-Iglesias</option>
	<option
		value="CE"
		@selected($address?->region == 'CE')
	>Caserta</option>
	<option
		value="CT"
		@selected($address?->region == 'CT')
	>Catania</option>
	<option
		value="CZ"
		@selected($address?->region == 'CZ')
	>Catanzaro</option>
	<option
		value="CH"
		@selected($address?->region == 'CH')
	>Chieti</option>
	<option
		value="CO"
		@selected($address?->region == 'CO')
	>Como</option>
	<option
		value="CS"
		@selected($address?->region == 'CS')
	>Cosenza</option>
	<option
		value="CR"
		@selected($address?->region == 'CR')
	>Cremona</option>
	<option
		value="KR"
		@selected($address?->region == 'KR')
	>Crotone</option>
	<option
		value="CN"
		@selected($address?->region == 'CN')
	>Cuneo</option>
	<option
		value="EN"
		@selected($address?->region == 'EN')
	>Enna</option>
	<option
		value="FM"
		@selected($address?->region == 'FM')
	>Fermo</option>
	<option
		value="FE"
		@selected($address?->region == 'FE')
	>Ferrara</option>
	<option
		value="FI"
		@selected($address?->region == 'FI')
	>Firenze</option>
	<option
		value="FG"
		@selected($address?->region == 'FG')
	>Foggia</option>
	<option
		value="FC"
		@selected($address?->region == 'FC')
	>Forlì-Cesena</option>
	<option
		value="FR"
		@selected($address?->region == 'FR')
	>Frosinone</option>
	<option
		value="GE"
		@selected($address?->region == 'GE')
	>Genova</option>
	<option
		value="GO"
		@selected($address?->region == 'GO')
	>Gorizia</option>
	<option
		value="GR"
		@selected($address?->region == 'GR')
	>Grosseto</option>
	<option
		value="IM"
		@selected($address?->region == 'IM')
	>Imperia</option>
	<option
		value="IS"
		@selected($address?->region == 'IS')
	>Isernia</option>
	<option
		value="AQ"
		@selected($address?->region == 'AQ')
	>L'Aquila</option>
	<option
		value="SP"
		@selected($address?->region == 'SP')
	>La Spezia</option>
	<option
		value="LT"
		@selected($address?->region == 'LT')
	>Latina</option>
	<option
		value="LE"
		@selected($address?->region == 'LE')
	>Lecce</option>
	<option
		value="LC"
		@selected($address?->region == 'LC')
	>Lecco</option>
	<option
		value="LI"
		@selected($address?->region == 'LI')
	>Livorno</option>
	<option
		value="LO"
		@selected($address?->region == 'LO')
	>Lodi</option>
	<option
		value="LU"
		@selected($address?->region == 'LU')
	>Lucca</option>
	<option
		value="MC"
		@selected($address?->region == 'MC')
	>Macerata</option>
	<option
		value="MN"
		@selected($address?->region == 'MN')
	>Mantova</option>
	<option
		value="MS"
		@selected($address?->region == 'MS')
	>Massa-Carrara</option>
	<option
		value="MT"
		@selected($address?->region == 'MT')
	>Matera</option>
	<option
		value="VS"
		@selected($address?->region == 'VS')
	>Medio Campidano</option>
	<option
		value="ME"
		@selected($address?->region == 'ME')
	>Messina</option>
	<option
		value="MI"
		@selected($address?->region == 'MI')
	>Milano</option>
	<option
		value="MO"
		@selected($address?->region == 'MO')
	>Modena</option>
	<option
		value="MB"
		@selected($address?->region == 'MB')
	>Monza e della Brianza</option>
	<option
		value="NA"
		@selected($address?->region == 'NA')
	>Napoli</option>
	<option
		value="NO"
		@selected($address?->region == 'NO')
	>Novara</option>
	<option
		value="NU"
		@selected($address?->region == 'NU')
	>Nuoro</option>
	<option
		value="OG"
		@selected($address?->region == 'OG')
	>Ogliastra</option>
	<option
		value="OT"
		@selected($address?->region == 'OT')
	>Olbia-Tempio</option>
	<option
		value="OR"
		@selected($address?->region == 'OR')
	>Oristano</option>
	<option
		value="PD"
		@selected($address?->region == 'PD')
	>Padova</option>
	<option
		value="PA"
		@selected($address?->region == 'PA')
	>Palermo</option>
	<option
		value="PR"
		@selected($address?->region == 'PR')
	>Parma</option>
	<option
		value="PV"
		@selected($address?->region == 'PV')
	>Pavia</option>
	<option
		value="PG"
		@selected($address?->region == 'PG')
	>Perugia</option>
	<option
		value="PU"
		@selected($address?->region == 'PU')
	>Pesaro e Urbino</option>
	<option
		value="PE"
		@selected($address?->region == 'PE')
	>Pescara</option>
	<option
		value="PC"
		@selected($address?->region == 'PC')
	>Piacenza</option>
	<option
		value="PI"
		@selected($address?->region == 'PI')
	>Pisa</option>
	<option
		value="PT"
		@selected($address?->region == 'PT')
	>Pistoia</option>
	<option
		value="PN"
		@selected($address?->region == 'PN')
	>Pordenone</option>
	<option
		value="PZ"
		@selected($address?->region == 'PZ')
	>Potenza</option>
	<option
		value="PO"
		@selected($address?->region == 'PO')
	>Prato</option>
	<option
		value="RG"
		@selected($address?->region == 'RG')
	>Ragusa</option>
	<option
		value="RA"
		@selected($address?->region == 'RA')
	>Ravenna</option>
	<option
		value="RC"
		@selected($address?->region == 'RC')
	>Reggio Calabria</option>
	<option
		value="RE"
		@selected($address?->region == 'RE')
	>Reggio Emilia</option>
	<option
		value="RI"
		@selected($address?->region == 'RI')
	>Rieti</option>
	<option
		value="RN"
		@selected($address?->region == 'RN')
	>Rimini</option>
	<option
		value="RM"
		@selected($address?->region == 'RM')
	>Roma</option>
	<option
		value="RO"
		@selected($address?->region == 'RO')
	>Rovigo</option>
	<option
		value="SA"
		@selected($address?->region == 'SA')
	>Salerno</option>
	<option
		value="SS"
		@selected($address?->region == 'SS')
	>Sassari</option>
	<option
		value="SV"
		@selected($address?->region == 'SV')
	>Savona</option>
	<option
		value="SI"
		@selected($address?->region == 'SI')
	>Siena</option>
	<option
		value="SR"
		@selected($address?->region == 'SR')
	>Siracusa</option>
	<option
		value="SO"
		@selected($address?->region == 'SO')
	>Sondrio</option>
	<option
		value="TA"
		@selected($address?->region == 'TA')
	>Taranto</option>
	<option
		value="TE"
		@selected($address?->region == 'TE')
	>Teramo</option>
	<option
		value="TR"
		@selected($address?->region == 'TR')
	>Terni</option>
	<option
		value="TO"
		@selected($address?->region == 'TO')
	>Torino</option>
	<option
		value="TP"
		@selected($address?->region == 'TP')
	>Trapani</option>
	<option
		value="TN"
		@selected($address?->region == 'TN')
	>Trento</option>
	<option
		value="TV"
		@selected($address?->region == 'TV')
	>Treviso</option>
	<option
		value="TS"
		@selected($address?->region == 'TS')
	>Trieste</option>
	<option
		value="UD"
		@selected($address?->region == 'UD')
	>Udine</option>
	<option
		value="VA"
		@selected($address?->region == 'VA')
	>Varese</option>
	<option
		value="VE"
		@selected($address?->region == 'VE')
	>Venezia</option>
	<option
		value="VB"
		@selected($address?->region == 'VB')
	>Verbano-Cusio-Ossola</option>
	<option
		value="VC"
		@selected($address?->region == 'VC')
	>Vercelli</option>
	<option
		value="VR"
		@selected($address?->region == 'VR')
	>Verona</option>
	<option
		value="VV"
		@selected($address?->region == 'VV')
	>Vibo Valentia</option>
	<option
		value="VI"
		@selected($address?->region == 'VI')
	>Vicenza</option>
	<option
		value="VT"
		@selected($address?->region == 'VT')
	>Viterbo</option>
</select>
