<?php

$tempList = [
	'Info@hotelgardenia.com',
	'info@sportinghotelravelli.it',
	'info@olympicspahotel.it',
	'info@alpinoalcavalletto.it',
	'info@titapiaz.it',
	'camoscio@marmolada.com',
	'info@hotelcarlone.it',
	'info@dimarohotel.it',
	'info@garnienrosadira.it',
	'hotel@lacacciatora.it',
	'info@activehotelrosat.it',
	'info@hoteloberosler.it',
	'info@lunabiancahotel.it',
	'info@alpenhotelcorona.com',
	'centrobenessere@biafora.it',
	'roberta.viviani@bormioterme.it',
	'info@hotelsavoia.com',
	'info@campingvidor.it',
	'info@hotelcerana.com',
	'desalpes@trentinoresidences.it',
	'info@agriturismopolisena.it',
	'info@ancora.it',
	'info@hotel-cristallo.com',
	'info@hotelresidencedahu.it',
	'info@appartamentieltabia.it',
	'info@hotellaperla.net',
	'info@hoteldiana.net',
	'info@albergoirma.it',
	'info@residencesalvan.com',
	'info@sporthotel.it',
	'info@wellnessfassa.it',
	'info@garnierica.it',
	'info@garnilavigna.it',
	'info@garnimonica.it',
	'garniserena@libero.it',
	'info@hotelmontebondone.it',
	'info@alpholiday.it',
	'info@hotelalpinovarena.it',
	'info@hotelandes.com',
	'info@hotelangelo.com',
	'info@arnika.it',
	'info@hotel-astoria.net',
	'info@hotelbellaria.com',
	'hotel@berlvedere.it',
	'lena.nest@familiamus.com',
	'info@crepesdesela.it',
	'info@orsinghersanmartino.com',
	'info@hotelcristallo.net',
	'info@hotelcrozzon.com',
	'info@hoteldolcecasa.it',
	'info@garnilaurino.it',
	'info@hotel-marilena.it',
	'info@jobhotel.it',
	'info@hoteljolanda.com',
	'info@hoteljolandasport.com',
	'hotel@gioiosa.it',
	'info@hotelladinia.it',
	'info@hotelmalita.it',
	'info@hotelmariasas.it',
	'direttore@hotelmeditteraneealassio.it',
	'info@berghotelmiramonti.it',
	'info@hotel-miramonti.com',
	'info@hotelpaganella.com',
	'info@hotelrenato.it',
	'info@scoiattolo.it',
	'info@hselect.it',
	'info@sharndrani.com',
	'info@trilago.it',
	'info@villajolanda.info',
	'info@hotelmirabello.it',
	'info@hsole.it',
	'info@ciarnadoi.it',
	'info@larocciaandalo.it',
	'centrobenesserechivasom@gmail.com',
	'info@hotelmontana.it',
	'info@hotelmonteginer.com',
	'info@residencetaufer.it',
	'info@nonsolobaite.it',
	'info@novalunaestellis.com',
	'palestradepoeti@gmail.com',
	'hotel@materdaihp.com',
	'info@residencelaste.it',
	'info@hotel-lagorai.com',
	'info@alpiccolohotel.it',
	'info@miralagotrentino.com',
	'info@montebel.it',
	'giulia.tabiadon@canazei.org',
	'info@solehammam.it',
	'a.dradi@sportcitypalestra.it',
	'ale@sportetempolibero.it',
	'info@hotelmajare.com',
	'info@touringpredazzo.com',
	'g.peroni@isolacluab.com',
	'info@hotelalparco.net',
	'info@garnierna.it',
	'info@hotelalpen.it',
	'info@portavescovo.it',
	'info@alpenhotelplaza.it',
	'info@viaverdelessinia.com',
	'info@fanes.net',
	'alberto@belvedereonline.com',
	'info@garniserena.it',
	'info@genziana.it',
	'direttore@hotelmediterraneealassio.it',
	'a.pampana@gvngroup.it',
	'info@hotel-ambassador.it',
	'info@hotelambrosini.it',
	'info@hotelcanadabellamonte.it',
	'info@hotelilma.it',
	'info@hotelladinia.com',
	'hotel@hbelvedere.it',
	'sonja@hotelcastelpietra.it',
	'info@cesa-padon.it',
	'info@hotelnele.com',
	'info@hotelladina.it',
	'info@shandrani.com',
	'info@hsole.it',
	'info@hotelzirmesmoena.it',
	'costanzi.flavio69@gmail.com',
	'amministrazione@hotellacartiera.it',
	'lagruba@gmail.com',
	'info@hotel-lesalpes.com',
	'claudiadegia@yahoo.it',
	'economato@sunshinehotel.it',
	'info@grandhotelrabbi.it',
	'direzione@hotelfloracomano.it',
	'sonia.trulyitaly@gmail.com',
];

foreach ($tempList as $subscriber) {
	if (!DB::exists('newsletter_subscribers WHERE email = ?', [$subscriber])) {
		DB::add('newsletter_subscribers (email)', [$subscriber]);
	}
}

$debug = false;
$sent = false;
$title = "Iscriviti alla newsletter, scopri l'omaggio";

if (isset($_SESSION['sent'])) {
	$sent = true;
	unset($_SESSION['sent']);
}

/* TEMP */
$emailContent = file_get_contents(server_path('/app/templates/assets/template-emails/newsletter.html'));
$emailContent = str_replace('{{link-icon}}', icon_embed('link'), $emailContent);
$emailContent = str_replace('src="', 'src="https://lessenza.net/admin/app/templates/assets/template-emails/', $emailContent);
/* END TEMP */

if (isset($_POST['send']) && !empty($_POST['text'])) {
	$emailData = [
		'debug' => $debug,
		'reply-address' => sys_config('email-username'),
		'reply-name' => sys_config('name'),
		'subject' => $_POST['title'] ?: 'Newsletter ' . sys_config('name'),
		'text' => $_POST['text'],
	];

	$newsletterSubscribers = DB::select('id, email FROM newsletter_subscribers WHERE sent = 0');

	while ($newsletterSubscriber = $newsletterSubscribers->fetch_assoc()) {
		$emailData['to'] = $newsletterSubscriber['email'];

		Email::send($emailData);

		DB::update('newsletter_subscribers SET sent = 1 WHERE id = ?', [$newsletterSubscriber['id']]);
	}

	$_SESSION['sent'] = true;

	redirect();
}
