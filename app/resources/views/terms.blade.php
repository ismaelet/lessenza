<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
	<meta charset="UTF-8">
	<meta
		name="viewport"
		content="width=device-width, initial-scale=1.0"
	>
	<title>{{ __('Termini e Condizioni di Vendita | L\'Essenza S.r.l.s.') }}</title>
	<meta
		name="description"
		content="{{ __('Termini e condizioni generali di vendita del negozio online www.lessenza.net – L\'Essenza S.r.l.s.') }}"
	>
	<style>
		:root {
			--testo: #2b2b2b;
			--accento: #5a7a5a;
			--sfondo: #ffffff;
			--grigio: #f5f5f2;
			--bordo: #e3e3de;
		}

		* {
			box-sizing: border-box;
			margin: 0;
			padding: 0;
		}

		body {
			font-family: Georgia, 'Times New Roman', serif;
			color: var(--testo);
			background: var(--sfondo);
			line-height: 1.7;
			font-size: 17px;
		}

		.tc-container {
			max-width: 860px;
			margin: 0 auto;
			padding: 48px 24px 80px;
		}

		header.tc-header {
			border-bottom: 3px solid var(--accento);
			padding-bottom: 24px;
			margin-bottom: 40px;
		}

		h1 {
			font-size: 2rem;
			font-weight: normal;
			color: var(--accento);
			letter-spacing: .5px;
		}

		.tc-sottotitolo {
			margin-top: 8px;
			font-style: italic;
			color: #666;
		}

		nav.tc-indice {
			background: var(--grigio);
			border: 1px solid var(--bordo);
			border-radius: 8px;
			padding: 24px 28px;
			margin-bottom: 44px;
		}

		nav.tc-indice h2 {
			font-size: 1.05rem;
			margin-bottom: 12px;
			color: var(--accento);
		}

		nav.tc-indice ol {
			padding-left: 22px;
			columns: 2;
			column-gap: 40px;
		}

		nav.tc-indice li {
			margin-bottom: 6px;
			font-size: .95rem;
		}

		nav.tc-indice a {
			color: var(--testo);
			text-decoration: none;
		}

		nav.tc-indice a:hover {
			color: var(--accento);
			text-decoration: underline;
		}

		section {
			margin-bottom: 40px;
		}

		h2.tc-titolo {
			font-size: 1.25rem;
			color: var(--accento);
			margin-bottom: 14px;
			padding-bottom: 6px;
			border-bottom: 1px solid var(--bordo);
		}

		p {
			margin-bottom: 12px;
		}

		ul.tc-lista {
			padding-left: 26px;
			margin-bottom: 12px;
		}

		ul.tc-lista li {
			margin-bottom: 6px;
		}

		.tc-box {
			background: var(--grigio);
			border-left: 4px solid var(--accento);
			padding: 16px 20px;
			margin: 16px 0;
			border-radius: 0 6px 6px 0;
			font-size: .95rem;
		}

		a {
			color: var(--accento);
		}

		footer.tc-footer {
			margin-top: 56px;
			padding-top: 20px;
			border-top: 1px solid var(--bordo);
			font-size: .88rem;
			color: #777;
		}

		@media(max-width:640px) {
			nav.tc-indice ol {
				columns: 1;
			}

			body {
				font-size: 16px;
			}

			h1 {
				font-size: 1.5rem;
			}
		}
	</style>
</head>

<body>
	<div class="tc-container">

		<header class="tc-header">
			<h1>{{ __('Termini e Condizioni Generali di Vendita') }}</h1>
			<p class="tc-sottotitolo">www.lessenza.net &mdash; L'Essenza S.r.l.s.</p>
		</header>

		<nav
			class="tc-indice"
			aria-label="{{ __('Indice dei contenuti') }}"
		>
			<h2>{{ __('Indice') }}</h2>
			<ol>
				<li><a href="#art1">{{ __('Ambito di applicazione') }}</a></li>
				<li><a href="#art2">{{ __('Dati del venditore') }}</a></li>
				<li><a href="#art3">{{ __('Prodotti e destinazione d\'uso') }}</a></li>
				<li><a href="#art4">{{ __('Conclusione del contratto') }}</a></li>
				<li><a href="#art5">{{ __('Prezzi e IVA') }}</a></li>
				<li><a href="#art6">{{ __('Metodi di pagamento') }}</a></li>
				<li><a href="#art7">{{ __('Spedizioni e consegna') }}</a></li>
				<li><a href="#art8">{{ __('Riserva di proprietà') }}</a></li>
				<li><a href="#art9">{{ __('Verifica della merce e danni da trasporto') }}</a></li>
				<li><a href="#art10">{{ __('Garanzia') }}</a></li>
				<li><a href="#art11">{{ __('Limitazione di responsabilità') }}</a></li>
				<li><a href="#art12">{{ __('Protezione dei dati personali (GDPR)') }}</a></li>
				<li><a href="#art13">{{ __('Proprietà intellettuale') }}</a></li>
				<li><a href="#art14">{{ __('Forza maggiore') }}</a></li>
				<li><a href="#art15">{{ __('Legge applicabile e foro competente') }}</a></li>
				<li><a href="#art16">{{ __('Disposizioni finali') }}</a></li>
			</ol>
		</nav>

		<section id="art1">
			<h2 class="tc-titolo">{{ __('1. Ambito di applicazione') }}</h2>
			<p>{{ __('Le presenti Condizioni Generali di Vendita (di seguito "Condizioni") disciplinano tutti gli ordini effettuati tramite il negozio online') }} <strong>www.lessenza.net</strong> {{ __('(di seguito il "Sito").') }}</p>
			<p>{{ __('Le vendite effettuate tramite il Sito sono riservate esclusivamente a') }} <strong>{{ __('operatori professionali') }}</strong> {{ __('(di seguito "Clienti"): imprese, professionisti, enti e in generale soggetti dotati di partita IVA che acquistano nell\'esercizio della propria attività imprenditoriale, commerciale, artigianale o professionale (rapporti "B2B").') }}
			</p>
			<p>{{ __('Effettuando un ordine, il Cliente dichiara di agire per finalità riconducibili alla propria attività professionale. Non trovano pertanto applicazione le disposizioni a tutela dei consumatori previste dal D.Lgs. 206/2005 (Codice del Consumo), incluso il diritto di recesso di cui agli artt. 52 e ss.') }}</p>
			<p>{{ __('Eventuali condizioni generali del Cliente difformi o aggiuntive non trovano applicazione, salvo nostra espressa accettazione scritta. Le presenti Condizioni si applicano anche a tutti i futuri rapporti commerciali con il medesimo Cliente, senza necessità di ulteriore richiamo.') }}</p>
		</section>

		<section id="art2">
			<h2 class="tc-titolo">{{ __('2. Dati del venditore') }}</h2>
			<div class="tc-box">
				<p><strong>L'Essenza S.r.l.s.</strong><br>
					{{ __('Sede legale: Via di Poz, 11') }} &ndash; 38037 Predazzo (TN) &ndash; {{ __('Italia') }}<br>
					{{ __('Partita IVA / Codice Fiscale: 02555660228') }}<br>
					REA: TN &ndash; 233292<br>
					E-mail: <a href="mailto:commerciale@lessenza.net">commerciale@lessenza.net</a><br>
					PEC: <a href="mailto:lessenza-srls@pec.it">lessenza-srls@pec.it</a><br>
					{{ __('Telefono: +39 327 305 7850') }}</p>
			</div>
			<p>{{ __('Il contratto di vendita si intende concluso con L\'Essenza S.r.l.s. (di seguito il "Venditore").') }}</p>
		</section>

		<section id="art3">
			<h2 class="tc-titolo">{{ __('3. Prodotti e destinazione d\'uso') }}</h2>
			<p>{{ __('Il Sito offre essenze e concentrati aromatici professionali per ambienti wellness (spa, saune, bagni turchi, docce emozionali) e relativi accessori e tecnologie.') }}</p>
			<p>{{ __('Le immagini e le descrizioni dei prodotti presenti sul Sito hanno finalità illustrative. Il Venditore si impegna a mantenerle quanto più possibile accurate e aggiornate; eventuali lievi differenze cromatiche o di confezione non costituiscono difetto del prodotto.') }}</p>
			<p>{{ __('Il Cliente è tenuto a utilizzare i prodotti conformemente alle istruzioni d\'uso, alle schede tecniche e di sicurezza fornite dal Venditore e alla normativa applicabile alla propria attività.') }}</p>
		</section>

		<section id="art4">
			<h2 class="tc-titolo">{{ __('4. Conclusione del contratto') }}</h2>
			<p>{{ __('La presentazione dei prodotti sul Sito non costituisce offerta vincolante, ma un catalogo online senza impegno. Il Cliente può aggiungere i prodotti al carrello e modificare in ogni momento i dati dell\'ordine prima dell\'invio, utilizzando gli strumenti messi a disposizione durante la procedura d\'acquisto.') }}</p>
			<p>{{ __('Cliccando sul pulsante di conferma dell\'ordine, il Cliente formula una proposta d\'acquisto vincolante per i prodotti presenti nel carrello.') }}</p>
			<p><strong>{{ __('Conferma di ricezione (1ª e-mail):') }}</strong> {{ __('subito dopo l\'invio dell\'ordine, il Cliente riceve una e-mail generata automaticamente che attesta la sola ricezione dell\'ordine e non costituisce accettazione da parte del Venditore.') }}</p>
			<p><strong>{{ __('Accettazione dell\'ordine (2ª e-mail):') }}</strong> {{ __('il contratto si perfeziona soltanto con l\'invio della conferma di accettazione dell\'ordine da parte del Venditore, di regola entro 1-2 giorni lavorativi, contenente il riepilogo dell\'ordine e le indicazioni sulla consegna.') }}</p>
			<p>{{ __('Il Venditore si riserva la facoltà di non accettare ordini anomali, incompleti, provenienti da soggetti privi dei requisiti di cui all\'art. 1 o in caso di indisponibilità dei prodotti; in tal caso eventuali somme già versate saranno prontamente rimborsate.') }}</p>
			<p><strong>{{ __('Lingua e archiviazione del contratto:') }}</strong> {{ __('la lingua disponibile per la conclusione del contratto è l\'italiano. Il testo dell\'ordine e le presenti Condizioni vengono trasmessi al Cliente via e-mail e archiviati dal Venditore; il Cliente può consultare i propri ordini tramite l\'area riservata del Sito.') }}</p>
		</section>

		<section id="art5">
			<h2 class="tc-titolo">{{ __('5. Prezzi e IVA') }}</h2>
			<p>{{ __('I prezzi indicati sul Sito sono espressi in Euro (') }}&euro;{{ __('). L\'applicazione dell\'IVA è indicata durante la procedura d\'ordine e in fattura.') }}</p>
			<p><strong>{{ __('Clienti UE con partita IVA (cessioni intracomunitarie):') }}</strong> {{ __('per i Clienti stabiliti in altri Paesi dell\'Unione Europea, in possesso di numero di identificazione IVA valido e verificabile tramite il sistema VIES, la cessione può avvenire in regime di non imponibilità IVA ai sensi dell\'art. 41 del D.L. 331/93. Il Venditore si riserva di effettuare le verifiche sul numero identificativo IVA comunicato; qualora la verifica non vada a buon fine o non vengano fornite le informazioni richieste, la fattura sarà emessa con applicazione dell\'IVA italiana.') }}</p>
			<p>{{ __('I costi di spedizione non sono inclusi nel prezzo dei prodotti e vengono indicati separatamente nel carrello prima dell\'invio dell\'ordine (v. art. 7).') }}</p>
			<p>{{ __('In caso di errore evidente di prezzo dovuto a malfunzionamenti tecnici o refusi, il Venditore potrà annullare l\'ordine dandone comunicazione al Cliente e rimborsando quanto eventualmente già pagato.') }}</p>
		</section>

		<section id="art6">
			<h2 class="tc-titolo">{{ __('6. Metodi di pagamento') }}</h2>
			<p>{{ __('Sul Sito sono disponibili i seguenti metodi di pagamento:') }}</p>
			<ul class="tc-lista">
				<li><strong>{{ __('Bonifico bancario anticipato:') }}</strong> {{ __('scegliendo questa modalità, il Cliente riceve le coordinate bancarie via e-mail. La merce viene spedita dopo l\'accredito dell\'importo. L\'ordine si intende annullabile dal Venditore se il pagamento non perviene entro 7 giorni lavorativi dalla conferma.') }}</li>
				<li><strong>{{ __('Carta di credito / debito:') }}</strong> {{ __('il pagamento avviene tramite gateway sicuro con protocollo di autenticazione forte (SCA/3D Secure) ai sensi della direttiva PSD2. I dati della carta sono trattati esclusivamente dal prestatore di servizi di pagamento e non vengono memorizzati dal Venditore.') }}</li>
				<li><strong>PayPal:</strong> {{ __('il Cliente viene reindirizzato al sito PayPal dove, previo accesso al proprio account, autorizza il pagamento. La transazione è gestita direttamente da PayPal secondo le relative condizioni d\'uso.') }}</li>
			</ul>
			<p>{{ __('La fattura elettronica viene emessa ai sensi della normativa vigente e trasmessa tramite Sistema di Interscambio (SdI) ai Clienti italiani; ai Clienti esteri viene trasmessa copia in formato PDF via e-mail.') }}</p>
		</section>

		<section id="art7">
			<h2 class="tc-titolo">{{ __('7. Spedizioni e consegna') }}</h2>
			<p>{{ __('Le spedizioni vengono effettuate in') }} <strong>{{ __('Italia e nei Paesi dell\'Unione Europea') }}</strong>.</p>
			<p>{{ __('I costi di spedizione sono calcolati in base al peso complessivo dei prodotti nel carrello e alla destinazione, e sono sempre visualizzati nel carrello prima della conferma dell\'ordine.') }}</p>
			<p>{{ __('Salvo diversa indicazione nella scheda prodotto o nella conferma di accettazione dell\'ordine, la spedizione avviene entro i seguenti termini, decorrenti dal perfezionamento del contratto (e, in caso di bonifico anticipato, dall\'accredito del pagamento):') }}</p>
			<ul class="tc-lista">
				<li><strong>{{ __('Essenze e concentrati aromatici:') }}</strong> {{ __('entro 3 giorni lavorativi;') }}</li>
				<li><strong>{{ __('Attrezzature e impianti') }}</strong> {{ __('(docce emozionali, impianti automatici di dosaggio e simili): entro 45 giorni lavorativi, trattandosi di prodotti realizzati o approvvigionati su ordinazione.') }}</li>
			</ul>
			<p>{{ __('I termini di consegna sono indicativi e non essenziali; eventuali ritardi non imputabili a dolo o colpa grave del Venditore non danno diritto a risarcimenti o risoluzione del contratto.') }}</p>
			<p>{{ __('Trattandosi di vendita tra professionisti, ai sensi dell\'art. 1510 c.c. il rischio di perimento o deterioramento della merce si trasferisce al Cliente con la consegna dei prodotti al vettore, salvo diverso accordo scritto.') }}</p>
		</section>

		<section id="art8">
			<h2 class="tc-titolo">{{ __('8. Riserva di proprietà') }}</h2>
			<p>{{ __('La merce resta di proprietà del Venditore fino al completo pagamento del prezzo (art. 1523 c.c.).') }}</p>
			<p>{{ __('Il Cliente può rivendere la merce soggetta a riserva nell\'ambito della propria ordinaria attività; in caso di mancato pagamento, il Venditore potrà esigere direttamente i crediti derivanti dalla rivendita fino a concorrenza dell\'importo fatturato.') }}</p>
		</section>

		<section id="art9">
			<h2 class="tc-titolo">{{ __('9. Verifica della merce e danni da trasporto') }}</h2>
			<p>{{ __('Al ricevimento, il Cliente è tenuto a verificare l\'integrità dei colli e la corrispondenza quantitativa e qualitativa con quanto indicato nel documento di trasporto.') }}</p>
			<p>{{ __('In caso di danni evidenti all\'imballo o di ammanchi, il Cliente deve accettare la merce') }} <strong>{{ __('con riserva specifica scritta') }}</strong> {{ __('sul documento del vettore e darne comunicazione al Venditore entro 8 giorni all\'indirizzo') }} <a href="mailto:commerciale@lessenza.net">commerciale@lessenza.net</a>{{ __(', allegando documentazione fotografica.') }}</p>
			<p>{{ __('Ai sensi dell\'art. 1495 c.c., eventuali vizi non riconoscibili al momento della consegna devono essere denunciati al Venditore entro 8 giorni dalla scoperta, a pena di decadenza.') }}</p>
		</section>

		<section id="art10">
			<h2 class="tc-titolo">{{ __('10. Garanzia') }}</h2>
			<p>{{ __('Ai rapporti tra Venditore e Cliente si applica la garanzia per vizi di cui agli artt. 1490 e ss. del Codice Civile. L\'azione si prescrive in un anno dalla consegna, ferma la decadenza per mancata denuncia entro 8 giorni dalla scoperta del vizio.') }}</p>
			<p>{{ __('In caso di vizi accertati, il Venditore provvederà, a propria scelta, alla sostituzione dei prodotti difettosi o all\'emissione di nota di credito. Sono escluse ulteriori pretese, salvo quanto previsto dall\'art. 11.') }}</p>
			<p>{{ __('La garanzia non copre difetti derivanti da uso improprio, errata conservazione, diluizione o miscelazione non conforme alle istruzioni, o dal normale deterioramento dei prodotti oltre il termine minimo di conservazione indicato.') }}</p>
			<p>{{ __('Fanno fede, quanto alle caratteristiche dei prodotti, esclusivamente le descrizioni del Venditore e le schede tecniche incluse nel contratto.') }}</p>
		</section>

		<section id="art11">
			<h2 class="tc-titolo">{{ __('11. Limitazione di responsabilità') }}</h2>
			<p>{{ __('Il Venditore risponde senza limitazioni per i danni causati con dolo o colpa grave, per i danni alla vita, all\'integrità fisica o alla salute delle persone, nonché nei casi previsti dalla normativa sulla responsabilità da prodotto difettoso (D.Lgs. 206/2005, Parte IV, e normativa UE applicabile).') }}</p>
			<p>{{ __('Negli altri casi, la responsabilità del Venditore per colpa lieve è limitata ai danni prevedibili e tipici del contratto al momento della sua conclusione e, comunque, a un importo non superiore al valore dell\'ordine cui la contestazione si riferisce. È esclusa, nei limiti consentiti dalla legge, la responsabilità per danni indiretti, perdita di profitto o interruzione di attività.') }}</p>
		</section>

		<section id="art12">
			<h2 class="tc-titolo">{{ __('12. Protezione dei dati personali (GDPR)') }}</h2>
			<p>{{ __('Il trattamento dei dati personali del Cliente e dei suoi referenti avviene in conformità al Regolamento (UE) 2016/679 ("GDPR") e al D.Lgs. 196/2003 come modificato dal D.Lgs. 101/2018.') }}</p>
			<p>{{ __('I dati sono trattati per l\'esecuzione del contratto, per gli adempimenti fiscali e contabili obbligatori e, previo consenso ove necessario, per finalità di comunicazione commerciale.') }}</p>
			<p>{{ __('L\'informativa completa ai sensi degli artt. 13 e 14 GDPR, comprensiva dei diritti dell\'interessato (accesso, rettifica, cancellazione, limitazione, portabilità, opposizione) e delle informazioni sui cookie, è disponibile alle pagine:') }}</p>
			<ul class="tc-lista">
				<li><a href="/privacy-policy">Privacy Policy</a></li>
				<li><a href="/cookie-policy">Cookie Policy</a></li>
			</ul>
		</section>

		<section id="art13">
			<h2 class="tc-titolo">{{ __('13. Proprietà intellettuale') }}</h2>
			<p>{{ __('Tutti i contenuti del Sito (testi, immagini, loghi, marchi, grafiche) sono di proprietà del Venditore o dei rispettivi titolari e sono protetti dalla normativa sulla proprietà intellettuale e industriale. Ne è vietata la riproduzione, anche parziale, senza autorizzazione scritta.') }}</p>
		</section>

		<section id="art14">
			<h2 class="tc-titolo">{{ __('14. Forza maggiore') }}</h2>
			<p>{{ __('Il Venditore non è responsabile per inadempimenti o ritardi dovuti a cause di forza maggiore o comunque a eventi al di fuori del proprio ragionevole controllo (a titolo esemplificativo: scioperi, interruzioni dei trasporti, indisponibilità di materie prime, provvedimenti dell\'autorità, epidemie, eventi naturali). In tali casi i termini di consegna si intendono prorogati per la durata dell\'evento; qualora l\'impedimento si protragga oltre 60 giorni, ciascuna parte potrà recedere dal contratto senza oneri, con restituzione di quanto eventualmente già pagato.') }}</p>
		</section>

		<section id="art15">
			<h2 class="tc-titolo">{{ __('15. Legge applicabile e foro competente') }}</h2>
			<p>{{ __('Le presenti Condizioni e i contratti conclusi tramite il Sito sono regolati dalla') }} <strong>{{ __('legge italiana') }}</strong>{{ __(', con esclusione della Convenzione delle Nazioni Unite sui contratti di vendita internazionale di beni mobili (CISG).') }}
			</p>
			<p>{{ __('Per qualsiasi controversia derivante dalle presenti Condizioni o dai contratti conclusi tramite il Sito è esclusivamente competente il') }} <strong>{{ __('Foro di Trento') }}</strong>.</p>
		</section>

		<section id="art16">
			<h2 class="tc-titolo">{{ __('16. Disposizioni finali') }}</h2>
			<p>{{ __('L\'eventuale invalidità o inefficacia di singole clausole non pregiudica la validità delle restanti disposizioni, che rimarranno pienamente efficaci.') }}</p>
			<p>{{ __('Il Venditore si riserva il diritto di modificare le presenti Condizioni in qualsiasi momento; agli ordini si applicano le Condizioni pubblicate sul Sito al momento dell\'invio dell\'ordine.') }}</p>
			<p>{{ __('Per ogni comunicazione relativa alle presenti Condizioni:') }} <a
					href="mailto:commerciale@lessenza.net">commerciale@lessenza.net</a>.</p>
		</section>

		<footer class="tc-footer">
			<p>{{ __('Ultimo aggiornamento: luglio 2026') }} &mdash; L'Essenza S.r.l.s. &mdash; {{ __('P.IVA 02555660228') }} &mdash; www.lessenza.net
			</p>
		</footer>

	</div>
</body>

</html>
