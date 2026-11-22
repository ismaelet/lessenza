<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    private const PRODUCT_TYPE = 'Oli essenziali Aufguss';

    public function up(): void
    {
        DB::transaction(function () {
            $products = $this->products();

            // Never overwrite an existing product, including soft-deleted records.
            if (DB::table('products')->whereIn('slug', array_column($products, 'slug'))->exists()) {
                throw new RuntimeException('Cannot import Aufguss oils: an imported product slug already exists.');
            }

            $typeId = DB::table('product_types')->where('name', self::PRODUCT_TYPE)->whereNull('deleted_at')->value('id');
            $timestamp = now();

            if ($typeId === null) {
                $typeId = DB::table('product_types')->insertGetId([
                    'name' => self::PRODUCT_TYPE,
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp,
                ]);
            }

            foreach ($products as $product) {
                DB::table('products')->insert($product + [
                    'product_type_id' => $typeId,
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp,
                ]);
            }
        });
    }

    public function down(): void
    {
        DB::transaction(function () {
            DB::table('products')
                ->whereIn('slug', array_column($this->products(), 'slug'))
                ->whereIn('product_type_id', DB::table('product_types')->where('name', self::PRODUCT_TYPE)->select('id'))
                ->delete();

            // Retain the type: it may have existed before this migration or be used by new products.
        });
    }

    private function products(): array
    {
        // Immutable snapshot of the client catalogue; do not depend on application models or editable resources.
        return [
            [
                'name' => 'Anice Aufguss 30 ml',
                'slug' => 'olio-essenziale-anice-30ml',
                'description' => '<p>Note dolci e calde che ricordano la liquirizia. Un profumo insolito in sauna, che sorprende gli ospiti e dà carattere a una gettata invernale.</p><p>Nome botanico: Pimpinella anisum · CAS: 84650-59-9</p><p>Codice prodotto: AANI-30 · Formato: 30 ml</p><p>Attenzione — GHS07 Punto esclamativo, GHS08 Pericolo per la salute</p><p>H351 Sospettato di provocare il cancro. H341 Sospettato di provocare alterazioni genetiche. H317 Può provocare una reazione allergica cutanea. H412 Nocivo per gli organismi acquatici con effetti di lunga durata.</p><p><a href="/oli-essenziali/schede_sicurezza/SDS_Anice.pdf">Scarica la scheda di sicurezza (PDF)</a></p>',
                'description_short' => '<p>Dolce, speziato, avvolgente</p>',
                'ingredients' => 'Pimpinella anisum (CAS 84650-59-9)',
                'uses' => 'Ottimo nelle gettate a tema natalizio, abbinato ad Arancio Dolce o Cannella.',
                'warnings' => 'Attenzione. Consultare etichetta e scheda di sicurezza prima dell’uso. GHS07 Punto esclamativo, GHS08 Pericolo per la salute.',
                'price' => 15.90,
            ],
            [
                'name' => 'Anice Aufguss 100 ml',
                'slug' => 'olio-essenziale-anice-100ml',
                'description' => '<p>Note dolci e calde che ricordano la liquirizia. Un profumo insolito in sauna, che sorprende gli ospiti e dà carattere a una gettata invernale.</p><p>Nome botanico: Pimpinella anisum · CAS: 84650-59-9</p><p>Codice prodotto: AANI-100 · Formato: 100 ml</p><p>Attenzione — GHS07 Punto esclamativo, GHS08 Pericolo per la salute</p><p>H351 Sospettato di provocare il cancro. H341 Sospettato di provocare alterazioni genetiche. H317 Può provocare una reazione allergica cutanea. H412 Nocivo per gli organismi acquatici con effetti di lunga durata.</p><p><a href="/oli-essenziali/schede_sicurezza/SDS_Anice.pdf">Scarica la scheda di sicurezza (PDF)</a></p>',
                'description_short' => '<p>Dolce, speziato, avvolgente</p>',
                'ingredients' => 'Pimpinella anisum (CAS 84650-59-9)',
                'uses' => 'Ottimo nelle gettate a tema natalizio, abbinato ad Arancio Dolce o Cannella.',
                'warnings' => 'Attenzione. Consultare etichetta e scheda di sicurezza prima dell’uso. GHS07 Punto esclamativo, GHS08 Pericolo per la salute.',
                'price' => 35.90,
            ],
            [
                'name' => 'Arancio Dolce Aufguss 30 ml',
                'slug' => 'olio-essenziale-arancio-dolce-30ml',
                'description' => '<p>Il profumo più amato da tutti: fresco, dolce e luminoso. Mette di buon umore e funziona sia da solo che come base per miscele.</p><p>Nome botanico: Citrus sinensis · CAS: 94266-47-4</p><p>Codice prodotto: AARD-30 · Formato: 30 ml</p><p>Pericolo — GHS02 Fiamma, GHS07 Punto esclamativo, GHS08 Pericolo per la salute, GHS09 Ambiente</p><p>H304 Può essere letale in caso di ingestione e di penetrazione nelle vie respiratorie. H317 Può provocare una reazione allergica cutanea.</p><p><a href="/oli-essenziali/schede_sicurezza/SDS_Arancio_Dolce.pdf">Scarica la scheda di sicurezza (PDF)</a></p>',
                'description_short' => '<p>Fruttato, solare, allegro</p>',
                'ingredients' => 'Citrus sinensis (CAS 94266-47-4)',
                'uses' => 'Perfetto per aprire la serata Aufguss o per gettate pomeridiane. Si sposa con Cannella, Anice e Legno di Cedro.',
                'warnings' => 'Pericolo. Consultare etichetta e scheda di sicurezza prima dell’uso. GHS02 Fiamma, GHS07 Punto esclamativo, GHS08 Pericolo per la salute, GHS09 Ambiente.',
                'price' => 13.90,
            ],
            [
                'name' => 'Arancio Dolce Aufguss 100 ml',
                'slug' => 'olio-essenziale-arancio-dolce-100ml',
                'description' => '<p>Il profumo più amato da tutti: fresco, dolce e luminoso. Mette di buon umore e funziona sia da solo che come base per miscele.</p><p>Nome botanico: Citrus sinensis · CAS: 94266-47-4</p><p>Codice prodotto: AARD-100 · Formato: 100 ml</p><p>Pericolo — GHS02 Fiamma, GHS07 Punto esclamativo, GHS08 Pericolo per la salute, GHS09 Ambiente</p><p>H304 Può essere letale in caso di ingestione e di penetrazione nelle vie respiratorie. H317 Può provocare una reazione allergica cutanea.</p><p><a href="/oli-essenziali/schede_sicurezza/SDS_Arancio_Dolce.pdf">Scarica la scheda di sicurezza (PDF)</a></p>',
                'description_short' => '<p>Fruttato, solare, allegro</p>',
                'ingredients' => 'Citrus sinensis (CAS 94266-47-4)',
                'uses' => 'Perfetto per aprire la serata Aufguss o per gettate pomeridiane. Si sposa con Cannella, Anice e Legno di Cedro.',
                'warnings' => 'Pericolo. Consultare etichetta e scheda di sicurezza prima dell’uso. GHS02 Fiamma, GHS07 Punto esclamativo, GHS08 Pericolo per la salute, GHS09 Ambiente.',
                'price' => 32.90,
            ],
            [
                'name' => 'Cannella Aufguss 30 ml',
                'slug' => 'olio-essenziale-cannella-30ml',
                'description' => '<p>Nota calda e decisa che riempie la cabina in pochi istanti. Ideale per creare atmosfere natalizie e invernali.</p><p>Nome botanico: Cinnamomum zeylanicum · CAS: 84649-98-9</p><p>Codice prodotto: ACAN-30 · Formato: 30 ml</p><p>Pericolo — GHS07 Punto esclamativo, GHS08 Pericolo per la salute</p><p>H350 Può provocare il cancro. H341 Sospettato di provocare alterazioni genetiche. H317 Può provocare una reazione allergica cutanea. H412 Nocivo per gli organismi acquatici con effetti di lunga durata.</p><p><a href="/oli-essenziali/schede_sicurezza/SDS_Cannella.pdf">Scarica la scheda di sicurezza (PDF)</a></p>',
                'description_short' => '<p>Caldo, speziato, intenso</p>',
                'ingredients' => 'Cinnamomum zeylanicum (CAS 84649-98-9)',
                'uses' => 'Usare con moderazione: poche gocce bastano. Abbinata ad Arancio Dolce è un classico delle gettate di dicembre.',
                'warnings' => 'Pericolo. Consultare etichetta e scheda di sicurezza prima dell’uso. GHS07 Punto esclamativo, GHS08 Pericolo per la salute.',
                'price' => 14.90,
            ],
            [
                'name' => 'Cannella Aufguss 100 ml',
                'slug' => 'olio-essenziale-cannella-100ml',
                'description' => '<p>Nota calda e decisa che riempie la cabina in pochi istanti. Ideale per creare atmosfere natalizie e invernali.</p><p>Nome botanico: Cinnamomum zeylanicum · CAS: 84649-98-9</p><p>Codice prodotto: ACAN-100 · Formato: 100 ml</p><p>Pericolo — GHS07 Punto esclamativo, GHS08 Pericolo per la salute</p><p>H350 Può provocare il cancro. H341 Sospettato di provocare alterazioni genetiche. H317 Può provocare una reazione allergica cutanea. H412 Nocivo per gli organismi acquatici con effetti di lunga durata.</p><p><a href="/oli-essenziali/schede_sicurezza/SDS_Cannella.pdf">Scarica la scheda di sicurezza (PDF)</a></p>',
                'description_short' => '<p>Caldo, speziato, intenso</p>',
                'ingredients' => 'Cinnamomum zeylanicum (CAS 84649-98-9)',
                'uses' => 'Usare con moderazione: poche gocce bastano. Abbinata ad Arancio Dolce è un classico delle gettate di dicembre.',
                'warnings' => 'Pericolo. Consultare etichetta e scheda di sicurezza prima dell’uso. GHS07 Punto esclamativo, GHS08 Pericolo per la salute.',
                'price' => 34.90,
            ],
            [
                'name' => 'Citronella Aufguss 30 ml',
                'slug' => 'olio-essenziale-citronella-30ml',
                'description' => '<p>Fresca e pungente, con note di limone ed erba. Dà una sensazione di pulito e rinfresca l&#x27;aria della cabina.</p><p>Nome botanico: Cymbopogon winterianus · CAS: 8000-29-1</p><p>Codice prodotto: ACIT-30 · Formato: 30 ml</p><p>Pericolo — GHS05 Corrosione, GHS07 Punto esclamativo, GHS08 Pericolo per la salute, GHS09 Ambiente</p><p>H304 Può essere letale in caso di ingestione e di penetrazione nelle vie respiratorie. H318 Provoca gravi lesioni oculari. H317 Può provocare una reazione allergica cutanea.</p><p><a href="/oli-essenziali/schede_sicurezza/SDS_Citronella.pdf">Scarica la scheda di sicurezza (PDF)</a></p>',
                'description_short' => '<p>Erbaceo, agrumato, pulito</p>',
                'ingredients' => 'Cymbopogon winterianus (CAS 8000-29-1)',
                'uses' => 'Indicata per gettate estive o di metà giornata. Si abbina bene a Limone e Litsea Cubeba.',
                'warnings' => 'Pericolo. Consultare etichetta e scheda di sicurezza prima dell’uso. GHS05 Corrosione, GHS07 Punto esclamativo, GHS08 Pericolo per la salute, GHS09 Ambiente.',
                'price' => 14.90,
            ],
            [
                'name' => 'Citronella Aufguss 100 ml',
                'slug' => 'olio-essenziale-citronella-100ml',
                'description' => '<p>Fresca e pungente, con note di limone ed erba. Dà una sensazione di pulito e rinfresca l&#x27;aria della cabina.</p><p>Nome botanico: Cymbopogon winterianus · CAS: 8000-29-1</p><p>Codice prodotto: ACIT-100 · Formato: 100 ml</p><p>Pericolo — GHS05 Corrosione, GHS07 Punto esclamativo, GHS08 Pericolo per la salute, GHS09 Ambiente</p><p>H304 Può essere letale in caso di ingestione e di penetrazione nelle vie respiratorie. H318 Provoca gravi lesioni oculari. H317 Può provocare una reazione allergica cutanea.</p><p><a href="/oli-essenziali/schede_sicurezza/SDS_Citronella.pdf">Scarica la scheda di sicurezza (PDF)</a></p>',
                'description_short' => '<p>Erbaceo, agrumato, pulito</p>',
                'ingredients' => 'Cymbopogon winterianus (CAS 8000-29-1)',
                'uses' => 'Indicata per gettate estive o di metà giornata. Si abbina bene a Limone e Litsea Cubeba.',
                'warnings' => 'Pericolo. Consultare etichetta e scheda di sicurezza prima dell’uso. GHS05 Corrosione, GHS07 Punto esclamativo, GHS08 Pericolo per la salute, GHS09 Ambiente.',
                'price' => 34.90,
            ],
            [
                'name' => 'Eucalipto Aufguss 30 ml',
                'slug' => 'olio-essenziale-eucalipto-30ml',
                'description' => '<p>Il grande classico della sauna. Fresco e intenso, dà subito la sensazione di respiro profondo che gli ospiti cercano.</p><p>Nome botanico: Eucalyptus globulus · CAS: 84625-32-1</p><p>Codice prodotto: AEUC-30 · Formato: 30 ml</p><p>Pericolo — GHS02 Fiamma, GHS07 Punto esclamativo, GHS08 Pericolo per la salute, GHS09 Ambiente</p><p>H304 Può essere letale in caso di ingestione e di penetrazione nelle vie respiratorie. H317 Può provocare una reazione allergica cutanea.</p><p><a href="/oli-essenziali/schede_sicurezza/SDS_Eucalipto.pdf">Scarica la scheda di sicurezza (PDF)</a></p>',
                'description_short' => '<p>Fresco, balsamico, penetrante</p>',
                'ingredients' => 'Eucalyptus globulus (CAS 84625-32-1)',
                'uses' => 'Adatto a ogni momento della giornata. Con Menta o Pino Silvestre crea gettate fresche e balsamiche.',
                'warnings' => 'Pericolo. Consultare etichetta e scheda di sicurezza prima dell’uso. GHS02 Fiamma, GHS07 Punto esclamativo, GHS08 Pericolo per la salute, GHS09 Ambiente.',
                'price' => 13.90,
            ],
            [
                'name' => 'Eucalipto Aufguss 100 ml',
                'slug' => 'olio-essenziale-eucalipto-100ml',
                'description' => '<p>Il grande classico della sauna. Fresco e intenso, dà subito la sensazione di respiro profondo che gli ospiti cercano.</p><p>Nome botanico: Eucalyptus globulus · CAS: 84625-32-1</p><p>Codice prodotto: AEUC-100 · Formato: 100 ml</p><p>Pericolo — GHS02 Fiamma, GHS07 Punto esclamativo, GHS08 Pericolo per la salute, GHS09 Ambiente</p><p>H304 Può essere letale in caso di ingestione e di penetrazione nelle vie respiratorie. H317 Può provocare una reazione allergica cutanea.</p><p><a href="/oli-essenziali/schede_sicurezza/SDS_Eucalipto.pdf">Scarica la scheda di sicurezza (PDF)</a></p>',
                'description_short' => '<p>Fresco, balsamico, penetrante</p>',
                'ingredients' => 'Eucalyptus globulus (CAS 84625-32-1)',
                'uses' => 'Adatto a ogni momento della giornata. Con Menta o Pino Silvestre crea gettate fresche e balsamiche.',
                'warnings' => 'Pericolo. Consultare etichetta e scheda di sicurezza prima dell’uso. GHS02 Fiamma, GHS07 Punto esclamativo, GHS08 Pericolo per la salute, GHS09 Ambiente.',
                'price' => 32.90,
            ],
            [
                'name' => 'Finocchio Aufguss 30 ml',
                'slug' => 'olio-essenziale-finocchio-30ml',
                'description' => '<p>Profumo dolce e morbido, parente dell&#x27;anice ma più verde ed erbaceo. Una nota originale per chi vuole proporre qualcosa di diverso.</p><p>Nome botanico: Foeniculum vulgare · CAS: 84455-29-8</p><p>Codice prodotto: AFIN-30 · Formato: 30 ml</p><p>Pericolo — GHS07 Punto esclamativo, GHS08 Pericolo per la salute, GHS09 Ambiente</p><p>H304 Può essere letale in caso di ingestione e di penetrazione nelle vie respiratorie. H351 Sospettato di provocare il cancro. H341 Sospettato di provocare alterazioni genetiche. H317 Può provocare una reazione allergica cutanea.</p><p><a href="/oli-essenziali/schede_sicurezza/SDS_Finocchio.pdf">Scarica la scheda di sicurezza (PDF)</a></p>',
                'description_short' => '<p>Dolce, erbaceo, aromatico</p>',
                'ingredients' => 'Foeniculum vulgare (CAS 84455-29-8)',
                'uses' => 'Indicato per gettate rilassanti serali. Si abbina ad Anice e Lavanda.',
                'warnings' => 'Pericolo. Consultare etichetta e scheda di sicurezza prima dell’uso. GHS07 Punto esclamativo, GHS08 Pericolo per la salute, GHS09 Ambiente.',
                'price' => 17.50,
            ],
            [
                'name' => 'Finocchio Aufguss 100 ml',
                'slug' => 'olio-essenziale-finocchio-100ml',
                'description' => '<p>Profumo dolce e morbido, parente dell&#x27;anice ma più verde ed erbaceo. Una nota originale per chi vuole proporre qualcosa di diverso.</p><p>Nome botanico: Foeniculum vulgare · CAS: 84455-29-8</p><p>Codice prodotto: AFIN-100 · Formato: 100 ml</p><p>Pericolo — GHS07 Punto esclamativo, GHS08 Pericolo per la salute, GHS09 Ambiente</p><p>H304 Può essere letale in caso di ingestione e di penetrazione nelle vie respiratorie. H351 Sospettato di provocare il cancro. H341 Sospettato di provocare alterazioni genetiche. H317 Può provocare una reazione allergica cutanea.</p><p><a href="/oli-essenziali/schede_sicurezza/SDS_Finocchio.pdf">Scarica la scheda di sicurezza (PDF)</a></p>',
                'description_short' => '<p>Dolce, erbaceo, aromatico</p>',
                'ingredients' => 'Foeniculum vulgare (CAS 84455-29-8)',
                'uses' => 'Indicato per gettate rilassanti serali. Si abbina ad Anice e Lavanda.',
                'warnings' => 'Pericolo. Consultare etichetta e scheda di sicurezza prima dell’uso. GHS07 Punto esclamativo, GHS08 Pericolo per la salute, GHS09 Ambiente.',
                'price' => 40.90,
            ],
            [
                'name' => 'Lavanda Aufguss 30 ml',
                'slug' => 'olio-essenziale-lavanda-30ml',
                'description' => '<p>Profumo pulito e floreale, sinonimo di relax. Ammorbidisce il vapore e accompagna gli ospiti verso la calma.</p><p>Nome botanico: Lavandula hybrida · CAS: 90063-37-9</p><p>Codice prodotto: ALAV-30 · Formato: 30 ml</p><p>Pericolo — GHS07 Punto esclamativo, GHS08 Pericolo per la salute</p><p>H304 Può essere letale in caso di ingestione e di penetrazione nelle vie respiratorie. H317 Può provocare una reazione allergica cutanea. H412 Nocivo per gli organismi acquatici con effetti di lunga durata.</p><p><a href="/oli-essenziali/schede_sicurezza/SDS_Lavanda.pdf">Scarica la scheda di sicurezza (PDF)</a></p>',
                'description_short' => '<p>Floreale, morbido, rilassante</p>',
                'ingredients' => 'Lavandula hybrida (CAS 90063-37-9)',
                'uses' => 'Ideale per l\'ultima gettata della sera. Si abbina a Legno di Cedro e Palmarosa.',
                'warnings' => 'Pericolo. Consultare etichetta e scheda di sicurezza prima dell’uso. GHS07 Punto esclamativo, GHS08 Pericolo per la salute.',
                'price' => 18.90,
            ],
            [
                'name' => 'Lavanda Aufguss 100 ml',
                'slug' => 'olio-essenziale-lavanda-100ml',
                'description' => '<p>Profumo pulito e floreale, sinonimo di relax. Ammorbidisce il vapore e accompagna gli ospiti verso la calma.</p><p>Nome botanico: Lavandula hybrida · CAS: 90063-37-9</p><p>Codice prodotto: ALAV-100 · Formato: 100 ml</p><p>Pericolo — GHS07 Punto esclamativo, GHS08 Pericolo per la salute</p><p>H304 Può essere letale in caso di ingestione e di penetrazione nelle vie respiratorie. H317 Può provocare una reazione allergica cutanea. H412 Nocivo per gli organismi acquatici con effetti di lunga durata.</p><p><a href="/oli-essenziali/schede_sicurezza/SDS_Lavanda.pdf">Scarica la scheda di sicurezza (PDF)</a></p>',
                'description_short' => '<p>Floreale, morbido, rilassante</p>',
                'ingredients' => 'Lavandula hybrida (CAS 90063-37-9)',
                'uses' => 'Ideale per l\'ultima gettata della sera. Si abbina a Legno di Cedro e Palmarosa.',
                'warnings' => 'Pericolo. Consultare etichetta e scheda di sicurezza prima dell’uso. GHS07 Punto esclamativo, GHS08 Pericolo per la salute.',
                'price' => 43.90,
            ],
            [
                'name' => 'Legno di Cedro Aufguss 30 ml',
                'slug' => 'olio-essenziale-legno-di-cedro-30ml',
                'description' => '<p>Nota legnosa e profonda che si sposa naturalmente con il legno della sauna. Dà calore e struttura a ogni miscela.</p><p>Nome botanico: Cedrus atlantica · CAS: 92201-55-3</p><p>Codice prodotto: ALCE-30 · Formato: 30 ml</p><p>Pericolo — GHS07 Punto esclamativo, GHS08 Pericolo per la salute, GHS09 Ambiente</p><p>H304 Può essere letale in caso di ingestione e di penetrazione nelle vie respiratorie. H317 Può provocare una reazione allergica cutanea.</p><p><a href="/oli-essenziali/schede_sicurezza/SDS_Legno_di_Cedro.pdf">Scarica la scheda di sicurezza (PDF)</a></p>',
                'description_short' => '<p>Legnoso, caldo, avvolgente</p>',
                'ingredients' => 'Cedrus atlantica (CAS 92201-55-3)',
                'uses' => 'Ottimo come base per miscele: con Arancio Dolce, Lavanda o Pino Cembro.',
                'warnings' => 'Pericolo. Consultare etichetta e scheda di sicurezza prima dell’uso. GHS07 Punto esclamativo, GHS08 Pericolo per la salute, GHS09 Ambiente.',
                'price' => 14.90,
            ],
            [
                'name' => 'Legno di Cedro Aufguss 100 ml',
                'slug' => 'olio-essenziale-legno-di-cedro-100ml',
                'description' => '<p>Nota legnosa e profonda che si sposa naturalmente con il legno della sauna. Dà calore e struttura a ogni miscela.</p><p>Nome botanico: Cedrus atlantica · CAS: 92201-55-3</p><p>Codice prodotto: ALCE-100 · Formato: 100 ml</p><p>Pericolo — GHS07 Punto esclamativo, GHS08 Pericolo per la salute, GHS09 Ambiente</p><p>H304 Può essere letale in caso di ingestione e di penetrazione nelle vie respiratorie. H317 Può provocare una reazione allergica cutanea.</p><p><a href="/oli-essenziali/schede_sicurezza/SDS_Legno_di_Cedro.pdf">Scarica la scheda di sicurezza (PDF)</a></p>',
                'description_short' => '<p>Legnoso, caldo, avvolgente</p>',
                'ingredients' => 'Cedrus atlantica (CAS 92201-55-3)',
                'uses' => 'Ottimo come base per miscele: con Arancio Dolce, Lavanda o Pino Cembro.',
                'warnings' => 'Pericolo. Consultare etichetta e scheda di sicurezza prima dell’uso. GHS07 Punto esclamativo, GHS08 Pericolo per la salute, GHS09 Ambiente.',
                'price' => 34.90,
            ],
            [
                'name' => 'Limone Aufguss 30 ml',
                'slug' => 'olio-essenziale-limone-30ml',
                'description' => '<p>Fresco e brillante, porta in cabina una sensazione di energia e pulizia. Uno dei profumi più graditi dagli ospiti.</p><p>Nome botanico: Citrus limon · CAS: 84929-31-7</p><p>Codice prodotto: ALIM-30 · Formato: 30 ml</p><p>Pericolo — GHS02 Fiamma, GHS07 Punto esclamativo, GHS08 Pericolo per la salute, GHS09 Ambiente</p><p>H304 Può essere letale in caso di ingestione e di penetrazione nelle vie respiratorie. H361 Sospettato di nuocere alla fertilità o al feto. H317 Può provocare una reazione allergica cutanea.</p><p><a href="/oli-essenziali/schede_sicurezza/SDS_Limone.pdf">Scarica la scheda di sicurezza (PDF)</a></p>',
                'description_short' => '<p>Agrumato, frizzante, energizzante</p>',
                'ingredients' => 'Citrus limon (CAS 84929-31-7)',
                'uses' => 'Indicato per gettate mattutine o pomeridiane. Si abbina a Menta, Eucalipto e Citronella.',
                'warnings' => 'Pericolo. Consultare etichetta e scheda di sicurezza prima dell’uso. GHS02 Fiamma, GHS07 Punto esclamativo, GHS08 Pericolo per la salute, GHS09 Ambiente.',
                'price' => 14.90,
            ],
            [
                'name' => 'Limone Aufguss 100 ml',
                'slug' => 'olio-essenziale-limone-100ml',
                'description' => '<p>Fresco e brillante, porta in cabina una sensazione di energia e pulizia. Uno dei profumi più graditi dagli ospiti.</p><p>Nome botanico: Citrus limon · CAS: 84929-31-7</p><p>Codice prodotto: ALIM-100 · Formato: 100 ml</p><p>Pericolo — GHS02 Fiamma, GHS07 Punto esclamativo, GHS08 Pericolo per la salute, GHS09 Ambiente</p><p>H304 Può essere letale in caso di ingestione e di penetrazione nelle vie respiratorie. H361 Sospettato di nuocere alla fertilità o al feto. H317 Può provocare una reazione allergica cutanea.</p><p><a href="/oli-essenziali/schede_sicurezza/SDS_Limone.pdf">Scarica la scheda di sicurezza (PDF)</a></p>',
                'description_short' => '<p>Agrumato, frizzante, energizzante</p>',
                'ingredients' => 'Citrus limon (CAS 84929-31-7)',
                'uses' => 'Indicato per gettate mattutine o pomeridiane. Si abbina a Menta, Eucalipto e Citronella.',
                'warnings' => 'Pericolo. Consultare etichetta e scheda di sicurezza prima dell’uso. GHS02 Fiamma, GHS07 Punto esclamativo, GHS08 Pericolo per la salute, GHS09 Ambiente.',
                'price' => 34.90,
            ],
            [
                'name' => 'Litsea Cubeba Aufguss 30 ml',
                'slug' => 'olio-essenziale-litsea-cubeba-30ml',
                'description' => '<p>Ricorda la citronella e il limone, ma più dolce e rotondo. Una nota agrumata originale a un prezzo accessibile.</p><p>Nome botanico: Litsea cubeba · CAS: 90063-59-5</p><p>Codice prodotto: ALIT-30 · Formato: 30 ml</p><p>Pericolo — GHS07 Punto esclamativo, GHS08 Pericolo per la salute</p><p>H304 Può essere letale in caso di ingestione e di penetrazione nelle vie respiratorie. H317 Può provocare una reazione allergica cutanea. H412 Nocivo per gli organismi acquatici con effetti di lunga durata.</p><p><a href="/oli-essenziali/schede_sicurezza/SDS_Litsea_Cubeba.pdf">Scarica la scheda di sicurezza (PDF)</a></p>',
                'description_short' => '<p>Agrumato, dolce, vivace</p>',
                'ingredients' => 'Litsea cubeba (CAS 90063-59-5)',
                'uses' => 'Ottima nelle miscele fresche con Limone o Menta.',
                'warnings' => 'Pericolo. Consultare etichetta e scheda di sicurezza prima dell’uso. GHS07 Punto esclamativo, GHS08 Pericolo per la salute.',
                'price' => 10.50,
            ],
            [
                'name' => 'Litsea Cubeba Aufguss 100 ml',
                'slug' => 'olio-essenziale-litsea-cubeba-100ml',
                'description' => '<p>Ricorda la citronella e il limone, ma più dolce e rotondo. Una nota agrumata originale a un prezzo accessibile.</p><p>Nome botanico: Litsea cubeba · CAS: 90063-59-5</p><p>Codice prodotto: ALIT-100 · Formato: 100 ml</p><p>Pericolo — GHS07 Punto esclamativo, GHS08 Pericolo per la salute</p><p>H304 Può essere letale in caso di ingestione e di penetrazione nelle vie respiratorie. H317 Può provocare una reazione allergica cutanea. H412 Nocivo per gli organismi acquatici con effetti di lunga durata.</p><p><a href="/oli-essenziali/schede_sicurezza/SDS_Litsea_Cubeba.pdf">Scarica la scheda di sicurezza (PDF)</a></p>',
                'description_short' => '<p>Agrumato, dolce, vivace</p>',
                'ingredients' => 'Litsea cubeba (CAS 90063-59-5)',
                'uses' => 'Ottima nelle miscele fresche con Limone o Menta.',
                'warnings' => 'Pericolo. Consultare etichetta e scheda di sicurezza prima dell’uso. GHS07 Punto esclamativo, GHS08 Pericolo per la salute.',
                'price' => 25.90,
            ],
            [
                'name' => 'Menta Aufguss 30 ml',
                'slug' => 'olio-essenziale-menta-30ml',
                'description' => '<p>Freschezza immediata: la menta dà una sensazione di aria pulita e di respiro libero, anche nel caldo della sauna.</p><p>Nome botanico: Mentha arvensis · CAS: 90063-97-1</p><p>Codice prodotto: AMEN-30 · Formato: 30 ml</p><p>Attenzione — GHS07 Punto esclamativo, GHS09 Ambiente</p><p>H317 Può provocare una reazione allergica cutanea.</p><p><a href="/oli-essenziali/schede_sicurezza/SDS_Menta.pdf">Scarica la scheda di sicurezza (PDF)</a></p>',
                'description_short' => '<p>Fresco, mentolato, rinfrescante</p>',
                'ingredients' => 'Mentha arvensis (CAS 90063-97-1)',
                'uses' => 'Perfetta nelle gettate rinfrescanti. Con Eucalipto è la combinazione più richiesta.',
                'warnings' => 'Attenzione. Consultare etichetta e scheda di sicurezza prima dell’uso. GHS07 Punto esclamativo, GHS09 Ambiente.',
                'price' => 14.90,
            ],
            [
                'name' => 'Menta Aufguss 100 ml',
                'slug' => 'olio-essenziale-menta-100ml',
                'description' => '<p>Freschezza immediata: la menta dà una sensazione di aria pulita e di respiro libero, anche nel caldo della sauna.</p><p>Nome botanico: Mentha arvensis · CAS: 90063-97-1</p><p>Codice prodotto: AMEN-100 · Formato: 100 ml</p><p>Attenzione — GHS07 Punto esclamativo, GHS09 Ambiente</p><p>H317 Può provocare una reazione allergica cutanea.</p><p><a href="/oli-essenziali/schede_sicurezza/SDS_Menta.pdf">Scarica la scheda di sicurezza (PDF)</a></p>',
                'description_short' => '<p>Fresco, mentolato, rinfrescante</p>',
                'ingredients' => 'Mentha arvensis (CAS 90063-97-1)',
                'uses' => 'Perfetta nelle gettate rinfrescanti. Con Eucalipto è la combinazione più richiesta.',
                'warnings' => 'Attenzione. Consultare etichetta e scheda di sicurezza prima dell’uso. GHS07 Punto esclamativo, GHS09 Ambiente.',
                'price' => 34.90,
            ],
            [
                'name' => 'Palmarosa Aufguss 30 ml',
                'slug' => 'olio-essenziale-palmarosa-30ml',
                'description' => '<p>Profumo delicato con note di rosa e geranio. Porta in sauna una nota floreale elegante e morbida.</p><p>Nome botanico: Cymbopogon martinii · CAS: 84649-81-0</p><p>Codice prodotto: APAL-30 · Formato: 30 ml</p><p>Pericolo — GHS05 Corrosione, GHS07 Punto esclamativo</p><p>H318 Provoca gravi lesioni oculari. H317 Può provocare una reazione allergica cutanea. H412 Nocivo per gli organismi acquatici con effetti di lunga durata.</p><p><a href="/oli-essenziali/schede_sicurezza/SDS_Palmarosa.pdf">Scarica la scheda di sicurezza (PDF)</a></p>',
                'description_short' => '<p>Floreale, rosato, delicato</p>',
                'ingredients' => 'Cymbopogon martinii (CAS 84649-81-0)',
                'uses' => 'Ideale per gettate rilassanti. Si abbina a Lavanda e Legno di Cedro.',
                'warnings' => 'Pericolo. Consultare etichetta e scheda di sicurezza prima dell’uso. GHS05 Corrosione, GHS07 Punto esclamativo.',
                'price' => 10.50,
            ],
            [
                'name' => 'Palmarosa Aufguss 100 ml',
                'slug' => 'olio-essenziale-palmarosa-100ml',
                'description' => '<p>Profumo delicato con note di rosa e geranio. Porta in sauna una nota floreale elegante e morbida.</p><p>Nome botanico: Cymbopogon martinii · CAS: 84649-81-0</p><p>Codice prodotto: APAL-100 · Formato: 100 ml</p><p>Pericolo — GHS05 Corrosione, GHS07 Punto esclamativo</p><p>H318 Provoca gravi lesioni oculari. H317 Può provocare una reazione allergica cutanea. H412 Nocivo per gli organismi acquatici con effetti di lunga durata.</p><p><a href="/oli-essenziali/schede_sicurezza/SDS_Palmarosa.pdf">Scarica la scheda di sicurezza (PDF)</a></p>',
                'description_short' => '<p>Floreale, rosato, delicato</p>',
                'ingredients' => 'Cymbopogon martinii (CAS 84649-81-0)',
                'uses' => 'Ideale per gettate rilassanti. Si abbina a Lavanda e Legno di Cedro.',
                'warnings' => 'Pericolo. Consultare etichetta e scheda di sicurezza prima dell’uso. GHS05 Corrosione, GHS07 Punto esclamativo.',
                'price' => 25.90,
            ],
            [
                'name' => 'Patchouli Aufguss 30 ml',
                'slug' => 'olio-essenziale-patchouli-30ml',
                'description' => '<p>Nota intensa e terrosa, molto persistente. Per chi vuole proporre gettate dal carattere orientale e avvolgente.</p><p>Nome botanico: Pogostemon cablin · CAS: 84238-39-1</p><p>Codice prodotto: APAT-30 · Formato: 30 ml</p><p>Pericolo — GHS07 Punto esclamativo, GHS08 Pericolo per la salute</p><p>H304 Può essere letale in caso di ingestione e di penetrazione nelle vie respiratorie. EUH208 Contiene cariofillene. Può provocare una reazione allergica.</p><p><a href="/oli-essenziali/schede_sicurezza/SDS_Patchouli.pdf">Scarica la scheda di sicurezza (PDF)</a></p>',
                'description_short' => '<p>Terroso, legnoso, profondo</p>',
                'ingredients' => 'Pogostemon cablin (CAS 84238-39-1)',
                'uses' => 'Pochissime gocce bastano. Ottimo in miscela con Arancio Dolce o Legno di Cedro.',
                'warnings' => 'Pericolo. Consultare etichetta e scheda di sicurezza prima dell’uso. GHS07 Punto esclamativo, GHS08 Pericolo per la salute.',
                'price' => 24.90,
            ],
            [
                'name' => 'Patchouli Aufguss 100 ml',
                'slug' => 'olio-essenziale-patchouli-100ml',
                'description' => '<p>Nota intensa e terrosa, molto persistente. Per chi vuole proporre gettate dal carattere orientale e avvolgente.</p><p>Nome botanico: Pogostemon cablin · CAS: 84238-39-1</p><p>Codice prodotto: APAT-100 · Formato: 100 ml</p><p>Pericolo — GHS07 Punto esclamativo, GHS08 Pericolo per la salute</p><p>H304 Può essere letale in caso di ingestione e di penetrazione nelle vie respiratorie. EUH208 Contiene cariofillene. Può provocare una reazione allergica.</p><p><a href="/oli-essenziali/schede_sicurezza/SDS_Patchouli.pdf">Scarica la scheda di sicurezza (PDF)</a></p>',
                'description_short' => '<p>Terroso, legnoso, profondo</p>',
                'ingredients' => 'Pogostemon cablin (CAS 84238-39-1)',
                'uses' => 'Pochissime gocce bastano. Ottimo in miscela con Arancio Dolce o Legno di Cedro.',
                'warnings' => 'Pericolo. Consultare etichetta e scheda di sicurezza prima dell’uso. GHS07 Punto esclamativo, GHS08 Pericolo per la salute.',
                'price' => 49.90,
            ],
            [
                'name' => 'Pino Cembro (Cirmolo) Aufguss 30 ml',
                'slug' => 'olio-essenziale-pino-cembro-30ml',
                'description' => '<p>Il profumo delle nostre montagne: resinoso, caldo e balsamico. Porta in sauna l&#x27;atmosfera di una baita di legno.</p><p>Nome botanico: Pinus sibirica · CAS: 91697-89-1</p><p>Codice prodotto: ACIR-30 · Formato: 30 ml</p><p>Pericolo — GHS02 Fiamma, GHS07 Punto esclamativo, GHS08 Pericolo per la salute, GHS09 Ambiente</p><p>H304 Può essere letale in caso di ingestione e di penetrazione nelle vie respiratorie. H317 Può provocare una reazione allergica cutanea.</p><p><a href="/oli-essenziali/schede_sicurezza/SDS_Pino_Cembro.pdf">Scarica la scheda di sicurezza (PDF)</a></p>',
                'description_short' => '<p>Resinoso, balsamico, alpino</p>',
                'ingredients' => 'Pinus sibirica (CAS 91697-89-1)',
                'uses' => 'Ideale per gettate serali rilassanti. Si abbina a Legno di Cedro e Pino Silvestre.',
                'warnings' => 'Pericolo. Consultare etichetta e scheda di sicurezza prima dell’uso. GHS02 Fiamma, GHS07 Punto esclamativo, GHS08 Pericolo per la salute, GHS09 Ambiente.',
                'price' => 19.90,
            ],
            [
                'name' => 'Pino Cembro (Cirmolo) Aufguss 100 ml',
                'slug' => 'olio-essenziale-pino-cembro-100ml',
                'description' => '<p>Il profumo delle nostre montagne: resinoso, caldo e balsamico. Porta in sauna l&#x27;atmosfera di una baita di legno.</p><p>Nome botanico: Pinus sibirica · CAS: 91697-89-1</p><p>Codice prodotto: ACIR-100 · Formato: 100 ml</p><p>Pericolo — GHS02 Fiamma, GHS07 Punto esclamativo, GHS08 Pericolo per la salute, GHS09 Ambiente</p><p>H304 Può essere letale in caso di ingestione e di penetrazione nelle vie respiratorie. H317 Può provocare una reazione allergica cutanea.</p><p><a href="/oli-essenziali/schede_sicurezza/SDS_Pino_Cembro.pdf">Scarica la scheda di sicurezza (PDF)</a></p>',
                'description_short' => '<p>Resinoso, balsamico, alpino</p>',
                'ingredients' => 'Pinus sibirica (CAS 91697-89-1)',
                'uses' => 'Ideale per gettate serali rilassanti. Si abbina a Legno di Cedro e Pino Silvestre.',
                'warnings' => 'Pericolo. Consultare etichetta e scheda di sicurezza prima dell’uso. GHS02 Fiamma, GHS07 Punto esclamativo, GHS08 Pericolo per la salute, GHS09 Ambiente.',
                'price' => 46.90,
            ],
            [
                'name' => 'Pino Silvestre Aufguss 30 ml',
                'slug' => 'olio-essenziale-pino-silvestre-30ml',
                'description' => '<p>Profumo di bosco fresco e resinoso. Dà una sensazione di aria aperta e respiro profondo.</p><p>Nome botanico: Pinus sylvestris · CAS: 84012-35-1</p><p>Codice prodotto: APSI-30 · Formato: 30 ml</p><p>Pericolo — GHS02 Fiamma, GHS07 Punto esclamativo, GHS08 Pericolo per la salute, GHS09 Ambiente</p><p>H304 Può essere letale in caso di ingestione e di penetrazione nelle vie respiratorie. H317 Può provocare una reazione allergica cutanea.</p><p><a href="/oli-essenziali/schede_sicurezza/SDS_Pino_Silvestre.pdf">Scarica la scheda di sicurezza (PDF)</a></p>',
                'description_short' => '<p>Fresco, resinoso, boschivo</p>',
                'ingredients' => 'Pinus sylvestris (CAS 84012-35-1)',
                'uses' => 'Adatto a ogni momento. Con Eucalipto o Menta crea gettate fresche e balsamiche.',
                'warnings' => 'Pericolo. Consultare etichetta e scheda di sicurezza prima dell’uso. GHS02 Fiamma, GHS07 Punto esclamativo, GHS08 Pericolo per la salute, GHS09 Ambiente.',
                'price' => 16.90,
            ],
            [
                'name' => 'Pino Silvestre Aufguss 100 ml',
                'slug' => 'olio-essenziale-pino-silvestre-100ml',
                'description' => '<p>Profumo di bosco fresco e resinoso. Dà una sensazione di aria aperta e respiro profondo.</p><p>Nome botanico: Pinus sylvestris · CAS: 84012-35-1</p><p>Codice prodotto: APSI-100 · Formato: 100 ml</p><p>Pericolo — GHS02 Fiamma, GHS07 Punto esclamativo, GHS08 Pericolo per la salute, GHS09 Ambiente</p><p>H304 Può essere letale in caso di ingestione e di penetrazione nelle vie respiratorie. H317 Può provocare una reazione allergica cutanea.</p><p><a href="/oli-essenziali/schede_sicurezza/SDS_Pino_Silvestre.pdf">Scarica la scheda di sicurezza (PDF)</a></p>',
                'description_short' => '<p>Fresco, resinoso, boschivo</p>',
                'ingredients' => 'Pinus sylvestris (CAS 84012-35-1)',
                'uses' => 'Adatto a ogni momento. Con Eucalipto o Menta crea gettate fresche e balsamiche.',
                'warnings' => 'Pericolo. Consultare etichetta e scheda di sicurezza prima dell’uso. GHS02 Fiamma, GHS07 Punto esclamativo, GHS08 Pericolo per la salute, GHS09 Ambiente.',
                'price' => 39.90,
            ],
            [
                'name' => 'Rosmarino Aufguss 30 ml',
                'slug' => 'olio-essenziale-rosmarino-30ml',
                'description' => '<p>Profumo mediterraneo, fresco e canforato. Tonico e deciso, è perfetto per svegliare i sensi.</p><p>Nome botanico: Rosmarinus officinalis · CAS: 84604-14-8</p><p>Codice prodotto: AROS-30 · Formato: 30 ml</p><p>Pericolo — GHS02 Fiamma, GHS07 Punto esclamativo, GHS08 Pericolo per la salute, GHS09 Ambiente</p><p>H304 Può essere letale in caso di ingestione e di penetrazione nelle vie respiratorie. H317 Può provocare una reazione allergica cutanea.</p><p><a href="/oli-essenziali/schede_sicurezza/SDS_Rosmarino.pdf">Scarica la scheda di sicurezza (PDF)</a></p>',
                'description_short' => '<p>Erbaceo, canforato, deciso</p>',
                'ingredients' => 'Rosmarinus officinalis (CAS 84604-14-8)',
                'uses' => 'Indicato per gettate mattutine o energizzanti. Si abbina a Limone ed Eucalipto.',
                'warnings' => 'Pericolo. Consultare etichetta e scheda di sicurezza prima dell’uso. GHS02 Fiamma, GHS07 Punto esclamativo, GHS08 Pericolo per la salute, GHS09 Ambiente.',
                'price' => 18.90,
            ],
            [
                'name' => 'Rosmarino Aufguss 100 ml',
                'slug' => 'olio-essenziale-rosmarino-100ml',
                'description' => '<p>Profumo mediterraneo, fresco e canforato. Tonico e deciso, è perfetto per svegliare i sensi.</p><p>Nome botanico: Rosmarinus officinalis · CAS: 84604-14-8</p><p>Codice prodotto: AROS-100 · Formato: 100 ml</p><p>Pericolo — GHS02 Fiamma, GHS07 Punto esclamativo, GHS08 Pericolo per la salute, GHS09 Ambiente</p><p>H304 Può essere letale in caso di ingestione e di penetrazione nelle vie respiratorie. H317 Può provocare una reazione allergica cutanea.</p><p><a href="/oli-essenziali/schede_sicurezza/SDS_Rosmarino.pdf">Scarica la scheda di sicurezza (PDF)</a></p>',
                'description_short' => '<p>Erbaceo, canforato, deciso</p>',
                'ingredients' => 'Rosmarinus officinalis (CAS 84604-14-8)',
                'uses' => 'Indicato per gettate mattutine o energizzanti. Si abbina a Limone ed Eucalipto.',
                'warnings' => 'Pericolo. Consultare etichetta e scheda di sicurezza prima dell’uso. GHS02 Fiamma, GHS07 Punto esclamativo, GHS08 Pericolo per la salute, GHS09 Ambiente.',
                'price' => 43.90,
            ],
        ];
    }
};
