<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder {

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        DB::table('users')->insert([
            ['id' => 1, 'nome' => 'andrea', 'cognome' => 'andreotti', 'email' => 'ciaociao@gmail.com', 'username' => 'andri187', 'password' => Hash::make('andri187'), 'data_nascita' => '1999-04-03', 'telefono' => '3387747111', 'sitoweb' => '', 'role' => 'user',],
            ['id' => 2, 'nome' => 'Acompany_SPA', 'cognome' => '', 'email' => 'Acompany_SPA@gmail.com', 'username' => 'Acompany_SPA', 'password' => Hash::make('Acompany_SPA'), 'data_nascita' => '1999-05-03', 'telefono' => '3386747112', 'sitoweb' => 'Acompany_SPA.it', 'role' => 'company',],
            ['id' => 3, 'nome' => 'giulio', 'cognome' => 'giulietti', 'email' => 'giuliogiulietti@gmail.com', 'username' => 'giulio26', 'password' => Hash::make('giulio26'), 'data_nascita' => '1999-05-03', 'telefono' => '3386747113', 'sitoweb' => '', 'role' => 'user',],
            ['id' => 4, 'nome' => 'Bcompany_SPA', 'cognome' => '', 'email' => 'Bcompany_SPA@gmail.com', 'username' => 'Bcompany_SPA', 'password' => Hash::make('Bcompany_SPA'), 'data_nascita' => '1999-05-03', 'telefono' => '3386747114', 'sitoweb' => 'Bcompany_SPA.it', 'role' => 'company',],
            ['id' => 5, 'nome' => 'Ccompany_SPA', 'cognome' => '', 'email' => 'Ccompany_SPA@gmail.com', 'username' => 'Ccompany_SPA', 'password' => Hash::make('Ccompany_SPA'), 'data_nascita' => '1999-05-03', 'telefono' => '3386747115', 'sitoweb' => 'Ccompany_SPA.it', 'role' => 'company',],
            ['id' => 6, 'nome' => 'lucio', 'cognome' => 'lucetti', 'email' => 'luciolucetti@gmail.com', 'username' => 'lucio199', 'password' => Hash::make('lucio199'), 'data_nascita' => '1999-05-03', 'telefono' => '3386747116', 'sitoweb' => '', 'role' => 'user',],
            ['id' => 7, 'nome' => 'riccardo', 'cognome' => 'ricchetti', 'email' => 'riccardoricchetti@gmail.com', 'username' => 'riccardo', 'password' => Hash::make('riccardo'), 'data_nascita' => '1999-05-03', 'telefono' => '3386747117', 'sitoweb' => '', 'role' => 'user',],
            ['id' => 8, 'nome' => 'tweb4', 'cognome' => 'tweb4', 'email' => 'admin@gmail.com', 'username' => 'adminadmin', 'password' => Hash::make('vXSVvBIc'), 'data_nascita' => '1998-05-03', 'telefono' => '3386747118', 'sitoweb' => '', 'role' => 'admin',],
            ['id' => 9, 'nome' => 'tweb2', 'cognome' => 'tweb2', 'email' => 'tweb2@gmail.com', 'username' => 'clieclie', 'password' => Hash::make('vXSVvBIc'), 'data_nascita' => '1999-04-03', 'telefono' => '3387747211', 'sitoweb' => '', 'role' => 'user',],
            ['id' => 10, 'nome' => 'tweb3', 'cognome' => 'tweb3', 'email' => 'tweb3@gmail.com', 'username' => 'orgaorga', 'password' => Hash::make('vXSVvBIc'), 'data_nascita' => '1999-04-03', 'telefono' => '3387747211', 'sitoweb' => 'www.orgaorga.it', 'role' => 'company',]
            
        ]);

 DB::table('event')->insert([
           ['EventId' => 1, 'descrizione' => 'l evento sara tenuto dalla compagnia Acompany_spa e si terra nel pieno di sirolo...',
                'programma' => 'il programma e....', 'societaid' => 2, 'luogo' => 'Marche', 'data' => '2021-06-23', 'orario' => '13:00', 'nome' => 'Siroloinfesta', 'bigl_tot' => 50, 'bigl_acquis' => 30, 'Xcord' => 43.52326767058058, 'Ycord' => 13.61859637087946, 'prezzo' => 5.5, 'image' => 'id1.jpg', 'categoria' => 'fiera','scontoPerc' =>'15','sconto' =>'1','incassoTotale'=>165,'nGiorniAttSconto'=>'10'],
            ['EventId' => 2, 'descrizione' => 'l evento sara tenuto dalla compagnia Acompany_spa e si terra nel pieno di numana......',
                'programma' => 'il programma el....', 'societaid' => 2, 'luogo' => 'Marche', 'data' => '2021-06-30', 'orario' => '14:00', 'nome' => 'Numanainfesta', 'bigl_tot' => 60, 'bigl_acquis' => 20, 'Xcord' => 43.51377802112318, 'Ycord' => 13.621389640095025, 'prezzo' => 3, 'image' => 'id2.jpg', 'categoria' => 'concerto','scontoPerc' =>'0','sconto' =>'0','incassoTotale'=>60,'nGiorniAttSconto'=>'0'],
            ['EventId' => 3, 'descrizione' => 'l evento sara tenuto dalla compagnia Acompany_spa e si terra nel pieno di marcelli......',
                'programma' => 'il programma e....', 'societaid' => 2, 'luogo' => 'Marche', 'data' => '2021-07-03', 'orario' => '16:00', 'nome' => 'Marcelliinfesta', 'bigl_tot' => 50, 'bigl_acquis' => 40, 'Xcord' => 43.49270264554944, 'Ycord' => 13.627656476192364, 'prezzo' => 5.5, 'image' => 'id3.jpg', 'categoria' => 'fiera','scontoPerc' =>'50','sconto' =>'1','incassoTotale'=>110,'nGiorniAttSconto'=>'100'],
            ['EventId' => 4, 'descrizione' => 'l evento sara tenuto dalla compagnia Acompany_spa e si terra nel pieno di ancona......',
                'programma' => 'il programma e....', 'societaid' => 2, 'luogo' => 'Marche', 'data' => '2021-06-03', 'orario' => '11:00', 'nome' => 'Anconainfesta', 'bigl_tot' => 50, 'bigl_acquis' => 30, 'Xcord' => 43.61684042232536, 'Ycord' => 13.517164188104534, 'prezzo' => 5.5, 'image' => 'id4.jpg', 'categoria' => 'fiera','scontoPerc' =>'15','sconto' =>'1','incassoTotale'=>165,'nGiorniAttSconto'=>'3'],
            ['EventId' => 5, 'descrizione' => 'l evento sara tenuto dalla compagnia Acompany_spa e si terra nel pieno di recanati......',
                'programma' => 'il programma e....', 'societaid' => 2, 'luogo' => 'Marche', 'data' => '2021-06-15', 'orario' => '12:00', 'nome' => 'Recanatiinfesta', 'bigl_tot' => 50, 'bigl_acquis' => 10, 'Xcord' => 43.401981976197696, 'Ycord' => 13.550544369408698, 'prezzo' => 5.5, 'image' => 'id5.jpg', 'categoria' => 'opera','scontoPerc' =>'15','sconto' =>'0','incassoTotale'=>55,'nGiorniAttSconto'=>'0'],
            ['EventId' => 6, 'descrizione' => 'l evento sara tenuto dalla compagnia Bcompany_spa e si terra nel pieno di bologna......',
                'programma' => 'il programma e....', 'societaid' => 4, 'luogo' => 'Emilia Romagna', 'data' => '2021-06-13', 'orario' => '12:00', 'nome' => 'Bolognainfesta', 'bigl_tot' => 50, 'bigl_acquis' => 10, 'Xcord' => 44.4912593790442, 'Ycord' => 11.341633881953609, 'prezzo' => 5.5, 'image' => 'id6.jpg', 'categoria' => 'opera','scontoPerc' =>'15','sconto' =>'0','incassoTotale'=>55,'nGiorniAttSconto'=>'0'],
            ['EventId' => 7, 'descrizione' => 'l evento sara tenuto dalla compagnia Bcompany_spa e si terra nel pieno di pisa......',
                'programma' => 'il programma e....', 'societaid' => 4, 'luogo' => 'Toscana', 'data' => '2021-04-07', 'orario' => '17:00', 'nome' => 'Pisainfesta', 'bigl_tot' => 50, 'bigl_acquis' => 0, 'Xcord' => 43.71574430158182, 'Ycord' => 10.395286094714342, 'prezzo' => 5.5, 'image' => 'id7.jpg', 'categoria' => 'musica dal vivo','scontoPerc' =>'15','sconto' =>'0','incassoTotale'=>0,'nGiorniAttSconto'=>'10'],
            ['EventId' => 8, 'descrizione' => 'l evento sara tenuto dalla compagnia Bcompany_spa e si terra nel pieno di fermo.........',
                'programma' => 'il programma e....', 'societaid' => 4, 'luogo' => 'Marche', 'data' => '2021-08-10', 'orario' => '18:00', 'nome' => 'Fermoinfesta', 'bigl_tot' => 50, 'bigl_acquis' => 10, 'Xcord' => 43.16100567679694, 'Ycord' => 13.715903917768545, 'prezzo' => 5.5, 'image' => 'id8.jpg', 'categoria' => 'musica dal vivo','scontoPerc' =>'50','sconto' =>'1','incassoTotale'=>27.5,'nGiorniAttSconto'=>'20'],
            ['EventId' => 9, 'descrizione' => 'l evento sara tenuto dalla compagnia Bcompany_spa e si terra nel pieno di Roma.........',
                'programma' => 'il programma e....', 'societaid' => 4, 'luogo' => 'Lazio', 'data' => '2021-10-03', 'orario' => '19:00', 'nome' => 'Romainfesta', 'bigl_tot' => 50, 'bigl_acquis' => 10, 'Xcord' => 41.90185246953253, 'Ycord' => 12.461605832526827, 'prezzo' => 5.5, 'image' => 'id9.jpg', 'categoria' => 'concerto','scontoPerc' =>'100','sconto' =>'0','incassoTotale'=>55,'nGiorniAttSconto'=>'10'],
            ['EventId' => 10, 'descrizione' => 'l evento sara tenuto dalla compagnia Ccompany_spa e si terra nel pieno di Milano.........',
                'programma' => 'il programma e....', 'societaid' => 5, 'luogo' => 'Lombardia', 'data' => '2021-08-03', 'orario' => '12:00', 'nome' => 'Milanoinfesta', 'bigl_tot' => 50, 'bigl_acquis' => 10, 'Xcord' => 45.46783847345808, 'Ycord' => 9.182281474315426, 'prezzo' => 5.5, 'image' => 'id10.jpg', 'categoria' => 'concerto','scontoPerc' =>'0','sconto' =>'0','incassoTotale'=>55,'nGiorniAttSconto'=>'0'],
            ['EventId' => 11, 'descrizione' => 'l evento sara tenuto dalla compagnia Ccompany_spa e si terra nel pieno di castelfidardo............',
                'programma' => 'il programma e....', 'societaid' => 5, 'luogo' => 'Marche', 'data' => '2021-09-03', 'orario' => '20:00', 'nome' => 'Castelfidardoinfesta', 'bigl_tot' => 50, 'bigl_acquis' => 10, 'Xcord' => 43.46366342840654, 'Ycord' => 13.549512050402843, 'prezzo' => 5.5, 'image' => 'id11.jpg', 'categoria' => 'teatro','scontoPerc' =>'15','sconto' =>'0','incassoTotale'=>55,'nGiorniAttSconto'=>'0'],
            ['EventId' => 12, 'descrizione' => 'l evento sara tenuto dalla compagnia Ccompany_spa e si terra nel pieno di Sirolo............',
                'programma' => 'il programma e....', 'societaid' => 5, 'luogo' => 'Marche', 'data' => '2021-04-03', 'orario' => '21:00', 'nome' => 'Siroloinfesta2', 'bigl_tot' => 50, 'bigl_acquis' => 10, 'Xcord' => 43.52326767058058, 'Ycord' => 13.61859637087946, 'prezzo' => 5.5, 'image' => 'id12.jpg', 'categoria' => 'teatro','scontoPerc' =>'15','sconto' =>'0','incassoTotale'=>55,'nGiorniAttSconto'=>'10'],
            ['EventId' => 13, 'descrizione' => 'l evento sara tenuto dalla compagnia Ccompany_spa e si terra nel pieno di Ancona............',
                'programma' => 'il programma e....', 'societaid' => 5, 'luogo' => 'Marche', 'data' => '2021-12-03', 'orario' => '22:00', 'nome' => 'Anconainfesta2', 'bigl_tot' => 50, 'bigl_acquis' => 10, 'Xcord' => 43.61684042232536, 'Ycord' => 13.517164188104534, 'prezzo' => 5.5, 'image' => 'id13.jpg', 'categoria' => 'fiera','scontoPerc' =>'15','sconto' =>'0','incassoTotale'=>55,'nGiorniAttSconto'=>'5'],
            ['EventId' => 14, 'descrizione' => 'l evento sara tenuto dalla compagnia Acompany_spa e si terra nel pieno di recanati......',
                'programma' => 'il programma e....', 'societaid' => 2, 'luogo' => 'Marche', 'data' => '2021-06-05', 'orario' => '12:00', 'nome' => 'Recanatiinfesta2', 'bigl_tot' => 50, 'bigl_acquis' => 10, 'Xcord' => 43.401981976197696, 'Ycord' => 13.550544369408698, 'prezzo' => 5.5, 'image' => 'id5.jpg', 'categoria' => 'opera','scontoPerc' =>'50','sconto' =>'1','incassoTotale'=>10,'nGiorniAttSconto'=>'10'],
            ['EventId' => 15, 'descrizione' => 'l evento sara tenuto dalla compagnia Acompany_spa e si terra nel pieno di recanati......',
                'programma' => 'il programma e....', 'societaid' => 4, 'luogo' => 'Marche', 'data' => '2021-07-01', 'orario' => '12:00', 'nome' => 'Montefanoinfesta', 'bigl_tot' => 50, 'bigl_acquis' => 50, 'Xcord' => 43.401981976197696, 'Ycord' => 13.550544369408698, 'prezzo' => 5.5, 'image' => 'id5.jpg', 'categoria' => 'opera','scontoPerc' =>'15','sconto' =>'0','incassoTotale'=>165,'nGiorniAttSconto'=>'0']
        ]);

        DB::table('ticket')->insert([
            ['TransId' => 1, 'data_acquisto' => '2020-05-12', 'prezzo' => 5.5, 'quantita' => 2, 'user_id' => 1, 'eventid' => 1],
            ['TransId' => 2, 'data_acquisto' => '2021-06-13', 'prezzo' => 50, 'quantita' => 6, 'user_id' => 1, 'eventid' => 4],
            ['TransId' => 3, 'data_acquisto' => '2021-03-29', 'prezzo' => 45, 'quantita' => 1, 'user_id' => 1, 'eventid' => 8]
        ]);
        DB::table('faqs')->insert([
            ['faqId' => 1, 'Domanda' => 'Come visualizzo il catalogo?', 'Risposta' => 'Per visualizzare il catalogo accedi ad esso tramite il pulsante Catalogo sulla navbar',],
            ['faqId' => 2, 'Domanda' => 'Come Accedere?', 'Risposta' => 'Dalla pagina principale recati su Accedi e inserisci le tue credenziali nella form dedicata. Se ancora non ti sei registrato procedi alla creazione di un account',],
            ['faqId' => 3, 'Domanda' => 'Come acquistare un biglietto?', 'Risposta' => 'Per acquistare un biglietto è necessario effettuare il login, o registrarsi, e poi selezionare un evento e fare Acquista biglietto ',],
            ['faqId' => 4, 'Domanda' => 'Un evento che ho prenotato è saltato / è stato rimandato come posso ottenere il rimborso?', 'Risposta' => 'Non è possibile ricevere rimborsi',],
            ['faqId' => 5, 'Domanda' => 'Vorrei accorpare più ordini, è possibile?', 'Risposta' => 'Purtroppo non è possibile accorpare più ordino',],
            ['faqId' => 6, 'Domanda' => 'Come inserisco un evento?', 'Risposta' => 'Per inserire un evento devi essere registrato come Organizzazione, ed inserirlo nella sezione dedicata',],
           
        ]);
    }

}
