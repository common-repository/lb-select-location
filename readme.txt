=== LB Select Location ===
Contributors: Bonny85
Tags: selezione, regioni, province, comuni, italia
Requires at least: 3.6
Tested up to: 3.6
Stable tag: 2.6.2
License: GPLv3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.txt

LB Select Location permette di aggiungere al vostro blog, una select multipla a cascata per la selezione di una regione, provincia, comune d’Italia. 

== Description ==

LB Select Location permette di aggiungere al vostro blog, una select multipla a cascata per la selezione di una regione, provincia, comune d'Italia mediante uno shortcode. Inoltre il plugin mette a disposizione delle API per interagire con la base di dati e per selezionare dei valori predefiniti nelle select.

**Instance:** [lb-sl]

* *form*: (default "1") valore identificativo per le select, utile (consigliato) se ci sono più select nella pagine e per identificare le select dopo un POST o GET di una form contenente le select. 
* *province*: (default "nome") definisce l’attributo delle province da visualizzare nella select province, i valori possibili sono nome e sigla o entrambi separati dal carattere "&" (es: "sigla&nome"), in questo caso gli attributi verranno visualizzati in questo modo "sigla – nome" (es: "TO – Torino" ). 
* *comuni*: (default "nome") definisce l’attributo dei comuni da visualizzare nella select comuni, i valori possibili sono nome e cap  o entrambi separati dal carattere "&" (es: "cap&nome"), anche in questo caso verranno visualizzati in questo modo "cap – nome" (es: "73100 - Lecce") 
* *label_regioni*: (default "Scegli …") definisce il valore di default della select regioni. 
* *label_province*: (default "Scegli …") definisce il valore valore di default della select province. 
* *label_comuni*: (default "Scegli …") definisce il valore valore di default della select comuni. 
* *text_regioni*: (default "Regione") definisce il valore valore per la label affianco alla select regioni. 
* *text_province*: (default "Provincia") definisce il valore valore per la label affianco alla select province. 
* *text_ comuni*: (default "Comune") definisce il valore valore per la label affianco alla select comuni. 

Esempio di shortcode:  [lb-sl  province="sigla&nome"]

**API Reference**

*Select*  Class

Implementa una suite di funzioni per interagire con la basi di dati (aggiornato a fine 2012), in particolare le tabelle regioni, province, comuni.

*Select_Load*   Class

Implementa un metodo *populate()* per selezionare dei valori predefiniti nelle select. Per esempio se si usa il plugin per aggiungere un campo opzionale al profilo utente, “luogo di nascita”, dopo in primo salvataggio di tale informazione negli update successivi l’utente dovrà visualizzare le informazioni che si erano selezionate la volta prima.


[Documentation and example using](http://www.lucabonaldo.it/lb-select-location%EF%BB%BF%EF%BB%BF-plugin/)

[Source doce documentation here](http://lucabonaldo.it/plugin-docs/lb-select-location-doc/)

== Installation ==

1. Upload LB-Select-Location nella directory `/wp-content/plugins/` 
2. Attivare il plugin tramite il menu 'Plugins' in WordPress
3. Posizionere gli shortcode in qualsiasi post o page, ecc.

**Per l'installazione multisito attivare il plugin nella rete.**

== Screenshots ==

1. Descrizione visuale degli attributi opzionali dello shortcode.

2. Esempio d'uso in un custom post type.
